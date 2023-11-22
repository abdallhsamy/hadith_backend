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

}
