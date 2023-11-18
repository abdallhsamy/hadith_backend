<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Hadith;
use App\Models\HadithKey;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FetchDataController extends Controller
{
    public function __invoke()
    {
        $this->getLangs();

        $this->getHadiths();
        $this->translateAllHadiths();
        return 'ok';
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
        $categoriesUrl = "https://hadeethenc.com/api/v1/categories/list/?language=" . $savedLang->code;

        $response = Http::get($categoriesUrl);

        foreach ($response->json() as $cat) {
            $category =  Category::firstWhere('id',$cat['id']);

            if (!$category) {
                $data = $cat;
                $data['title'] = [];
                $category = Category::create($data);
            }

            $category->title = [...$category->title , $savedLang->code => $cat['title']];

            $category->save();
        }
    }

    private function getHadiths(string $language = 'ar')
    {
        $id = 1;

        while (true) {
            if(!  $this->getOneHadith($id , $language)) {
                break;
            }

            $id++;

            if ($id > 999999) {
                break;
            }
        }
    }

    public function getOneHadith($id , $language)
    {
        $url = "https://hadeethenc.com/api/v1/hadeeths/one/";

        $response = Http::get($url, compact('language', 'id'));

        if ($response->notFound() || $response->failed()) {
            return null;
        }

        $hadith = Hadith::firstOrCreate(['id' => $response->json('id')]);

        $data = $response->json();

//        dd($data);
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

            if (!in_array($key, $arrayKeys, true)) {
                $hadith->$key = $val;
            }
        }
        foreach ($arrayKeys as $arrayKey) {
            if (! array_key_exists($arrayKey, $data)) {
                continue;
            }
            if ($hadith->$arrayKey) {
                $hadith->$arrayKey = [...$hadith->$arrayKey , $language => $data[$arrayKey]];
            } else {
                $hadith->$arrayKey = [$language => $data[$arrayKey]];
            }
        }


        $hadith->save();

        foreach ($response->json() as $name => $value) {
            HadithKey::firstOrCreate(compact('name'));
        }

        return $hadith;
    }

    public function translateAllHadiths()
    {
        $allArabic = Hadith::select('id', 'translations')->get();
        foreach ($allArabic as $hadith) {
            foreach ($hadith->translations as $language) {
                $this->getOneHadith($hadith->id,$language);
            }
        }
    }
}
