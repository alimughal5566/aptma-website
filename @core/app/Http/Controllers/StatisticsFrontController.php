<?php

namespace App\Http\Controllers;

use App\ExcelSheet;
use App\StatisticsCategory;
use App\StatisticsSubCategory;
use Illuminate\Http\Request;

class StatisticsFrontController extends Controller
{

    public function getStatisticsCategoryData($slug)
    {
        $all_stats_categoties = StatisticsCategory::with('subCategories')->get();
        $all_stats_sub_categoties = StatisticsSubCategory::all();
        $category_data = ExcelSheet::where('cat_slug', $slug)->with('getCategory')->get();

        return view('frontend.pages.statistics.index-category-data', compact('category_data', 'all_stats_categoties', 'all_stats_sub_categoties'));
    }

    public function getStatisticsSubCategoryData($slug)
    {
        $all_stats_categoties = StatisticsCategory::with('subCategories')->get();
        $all_stats_sub_categoties = StatisticsSubCategory::all();
        $category_data = ExcelSheet::where('sub_cat_slug', $slug)->with('getSubCategory')->get();
        return view('frontend.pages.statistics.index-sub-category-data', compact('category_data', 'all_stats_categoties', 'all_stats_sub_categoties'));
    }

    public function getCatData($slug, $id)
    {
        $all_stats_categoties = StatisticsCategory::with('subCategories')->get();
        $all_stats_sub_categoties = StatisticsSubCategory::all();
        $category_data = ExcelSheet::find($id);
        return view('frontend.pages.statistics.table-data', compact('category_data', 'all_stats_categoties', 'all_stats_sub_categoties'));
    }

    public function getSubCatData($slug, $id)
    {
        $all_stats_categoties = StatisticsCategory::with('subCategories')->get();
        $all_stats_sub_categoties = StatisticsSubCategory::all();
        $category_data = ExcelSheet::find($id);
        return view('frontend.pages.statistics.table-data', compact('category_data', 'all_stats_categoties', 'all_stats_sub_categoties'));
    }

}
