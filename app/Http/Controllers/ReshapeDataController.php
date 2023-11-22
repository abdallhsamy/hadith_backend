<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\GrabbedCatHadith;
use App\Models\Hadith;
use App\Models\HadithKey;
use App\Models\Language;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReshapeDataController extends Controller
{
    public function __invoke()
    {
        set_time_limit(-1);
        $this->setPrentCategories();
        $this->setCategoryLanguage();
        $this->setHadithLanguage();
        $this->setHadithCategory();
        return 'ok';
    }

    private function setPrentCategories(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            if (!$category->parent_id) {
                $category->unset('parent_id');
            } else {
                $parent = Category::where('id', $category->parent_id)->first();
                $category->unset('parent_id');
                $category->save();
                $category->parentCategory()->associate($parent);
            }
            $category->save();
        }
    }

    private function setCategoryLanguage(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            if ($category->title && count($category->title) > 0) {
                $languages = Language::whereIn('code', array_keys($category->title))->get();

                $category->languages()->attach($languages);
                $category->save();
            }
        }
    }

    private function setHadithLanguage(): void
    {
        $hadiths = Hadith::all();

        foreach ($hadiths as $hadith) {
            if ($hadith->hadeeth && count($hadith->hadeeth) > 0) {
                $languages = Language::whereIn('code', array_keys($hadith->hadeeth))->get();

                $hadith->languages()->attach($languages);
                $hadith->save();
            }
        }
    }

    private function setHadithCategory(): void
    {
        $hadiths = Hadith::all();

        foreach ($hadiths as $hadith) {

            if ($hadith->categories && count($hadith->categories) > 0) {

                $categories = Category::whereIn('id', $hadith->categories)->get();
                $hadith->categoriesRel()->attach($categories);
                $hadith->save();
            }
        }
    }

}
