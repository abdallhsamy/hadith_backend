<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\GrabbedCatHadith;
use App\Models\Hadith;
use App\Models\HadithKey;
use App\Models\Language;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchDataController extends Controller
{
    public function __invoke()
    {
        //        $this->getLangs();
        //
        //        $this->getHadiths();
        //        $this->translateAllHadiths();
        //        $this->getCatHadiths();
        return $this->getHadiths();

        return 'ok';

    }

    private function getWithRateLimit(string $url, ?array $params = [])
    {
        try {
            $res = Http::get($url, $params);

            if ($res->notFound()) {
                return null;
            }

            return $res;
        } catch (ConnectionException $e) {
            Log::channel('fetch')->debug($e->getMessage());
            sleep(120);

            return $this->getWithRateLimit($url, $params);
        } catch (\Illuminate\Http\Client\RequestException $e) {

            $qp = '';
            foreach ($params as $key => $val) {
                $qp .= "$key=$val";

            }
            Log::channel('exception')->debug($url.$qp !== '' ? "?$url" : '');

            Log::channel('exception')->debug($e->getMessage());
            sleep(120);

            return $this->getWithRateLimit($url, $params);

            // Handle request exceptions

            if ($e->getCode() === 35) {
                // Handle cURL error 35: unexpected eof while reading
                // Log the error, display a message, or take appropriate action
                Log::error('cURL error 35: '.$e->getMessage());
                // You can also throw a custom exception if needed
                throw new \Exception('Custom error message for cURL error 35');
            } else {
                // Handle other request exceptions
                // Log the error, display a message, or take appropriate action
                Log::error('Request exception: '.$e->getMessage());
            }
        } catch (\Exception $e) {
            $qp = '';
            foreach ($params as $key => $val) {
                $qp .= "$key=$val";

            }
            Log::channel('exception')->debug($url.$qp !== '' ? "?{$url}" : '');

            Log::channel('exception')->debug($e->getMessage());
            sleep(120);

            return $this->getWithRateLimit($url, $params);

            // Handle other generic exceptions
            // Log the error, display a message, or take appropriate action
            Log::error('Exception: '.$e->getMessage());
        } finally {
        }
    }

    public function getCatHadiths()
    {
        $loop = 0;
        foreach (Category::all() as $category) {

            Log::channel('fetch')->info($loop.' : start : category :'.$category->id);

            $response = $this->getWithRateLimit('https://hadeethenc.com/api/v1/hadeeths/list/', [
                'language' => 'ar',
                'category_id' => $category->id,
                'page' => 1,
                'per_page' => 2000000000000000,
            ]);

            Log::channel('fetch')->info($loop.' : get response  : category :'.$category->id);

            if ($response) {
                foreach ($response->json('data') as $item) {

                    GrabbedCatHadith::firstOrCreate(['id' => $item['id']], ['translations' => $item['translations']]);

                }
            }

            Log::channel('fetch')->info($loop.' : end : category :'.$category->id);

            $loop++;
        }
    }

    public function getLangs()
    {
        $langUrls = 'https://hadeethenc.com/api/v1/languages';

        $response = Http::get($langUrls);

        foreach ($response->json() as $lang) {
            $savedLang = Language::firstOrCreate($lang);

            $this->getCategories($savedLang);
        }
    }

    private function getCategories(Language $savedLang)
    {
        $categoriesUrl = 'https://hadeethenc.com/api/v1/categories/list/?language='.$savedLang->code;

        $response = Http::get($categoriesUrl);

        foreach ($response->json() as $cat) {
            $category = Category::firstWhere('id', $cat['id']);

            if (! $category) {
                $data = $cat;
                $data['title'] = [];
                $category = Category::create($data);
            }

            $category->title = [...$category->title, $savedLang->code => $cat['title']];

            $category->save();
        }
    }

    private function getHadiths()
    {
        //        GrabbedCatHadith::query()->update(['is_grabbed' => false]);
        //        return false;
        $grabbed = GrabbedCatHadith::query()
            ->get();

        $loop = 1;
        foreach ($grabbed as $item) {

            Log::channel('fetch')->info($loop.' : start : grabbed hadith :'.$item->id);
            $this->getOneHadith($item);
            Log::channel('fetch')->info($loop.' : end : grabbed hadith :'.$item->id);

            $loop++;
        }
    }

    public function getOneHadith(GrabbedCatHadith $item)
    {
        if (! $item->is_grabbed) {
            foreach ($item->translations as $language) {

                if (! $language || $language == "") {
                    continue;
                }

                $response = $this->getWithRateLimit('https://hadeethenc.com/api/v1/hadeeths/one/', [
                    'language' => $language,
                    'id' => $item->id,
                ]);

                if (! $response || $response->notFound() || $response->failed()) {
                    return null;
                }

                $hadith = Hadith::firstOrCreate(['id' => $response->json('id')]);

                $data = $response->json();

                $arrayKeys = [
                    'title',
                    'hadeeth',
                    'attribution',
                    'grade',
                    'explanation',
                    'hints',
                    'words_meanings',
                    'reference',
                ];

                foreach ($data as $key => $val) {

                    Log::channel('exception')->debug($key);


                    if (! in_array($key, $arrayKeys, true)) {

                        $hadith->$key = $val;
                    }
                }

                foreach ($arrayKeys as $arrayKey) {
                    if (! array_key_exists($arrayKey, $data)) {
                        continue;
                    }
                    if ($hadith->$arrayKey) {
                        $hadith->$arrayKey = [...$hadith->$arrayKey, $language => $data[$arrayKey]];
                    } else {
                        $hadith->$arrayKey = [$language => $data[$arrayKey]];
                    }
                }

                $hadith->save();

                foreach ($response->json() as $name => $value) {
                    HadithKey::firstOrCreate(compact('name'));
                }

//                dd('here');
                //            return $hadith;
            }

            $item->update(['is_grabbed' => true]);
        }
    }

    public function translateAllHadiths()
    {
        $allArabic = Hadith::select('id', 'translations')->get();
        foreach ($allArabic as $hadith) {
            foreach ($hadith->translations as $language) {
                $this->getOneHadith($hadith->id, $language);
            }
        }
    }
}
