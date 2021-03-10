<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\ExcelSheet;
use App\ExchangeRates;
use App\ExchangeRatesCategories;
use App\Imports\ExcelSheetImports;
use App\Language;
use App\StatisticsCategory;
use App\StatisticsSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function categoriesIndex()
    {
        $all_languages = Language::all();
        $all_category = StatisticsCategory::all();
        return view('backend.statistics.category', compact('all_languages', 'all_category'));
    }

    public function categoriesStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'status' => 'required',
            'lang' => 'required',
        ]);
        StatisticsCategory::create([
            'status' => $request->status,
            'title' => $request->name,
            'lang' => $request->lang,
            'slug' => Str::slug($request->name . '-' . Str::random(2))
        ]);
        return redirect()->back()->with(['msg' => __('New Category added...'), 'type' => 'success']);

    }

    public function categoriesUpdate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'status' => 'required',
            'lang' => 'required',
        ]);

        $data = StatisticsCategory::find($request->id);
        $data->status = $request->status;
        $data->title = $request->title;
        $data->lang = $request->lang;
        $data->slug = Str::slug($request->title);
        $data->save();
        return redirect()->back()->with(['msg' => __('Data Updated...'), 'type' => 'success']);
    }

    public function subCategoriesIndex()
    {
        $all_languages = Language::all();
        $all_category = StatisticsSubCategory::all();
        $all_main_categories = StatisticsCategory::all();
        return view('backend.statistics.sub-category', compact('all_languages', 'all_category', 'all_main_categories'));
    }

    public function subCategoriesStore(Request $request)
    {
//dd($request->all());
        $this->validate($request, [
            'name' => 'required|string',
            'status' => 'required',
            'lang' => 'required',
            'category' => 'integer',
        ]);
        $sub_cat = new StatisticsSubCategory();
        $sub_cat->title = $request->name;
        $sub_cat->cat_id = $request->category;
        $sub_cat->status = $request->status;
        $sub_cat->lang = $request->lang;
        $sub_cat->slug = Str::slug($request->title);
        $sub_cat->save();
        return redirect()->back()->with(['msg' => __('New Sub Category added...'), 'type' => 'success']);

    }

    public function index()
    {
        $all_languages = Language::all();
        $all_categories = StatisticsCategory::all();
        $all_sub_categories = StatisticsSubCategory::all();
        return view('backend.statistics.index')->with(['all_sub_categories' => $all_sub_categories, 'all_languages' => $all_languages, 'all_categories' => $all_categories]);
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            "file" => "required|mimes:csv,xlsx,xls",
            "category" => "required",
            "sub_category" => "required",
        ]);
        if ($request->file) {
            $file = $request->file('file');
            \Excel::import(new ExcelSheetImports($request->category, $request->sub_category), $file);
            return redirect()->back()->with(['msg' => __('Sheet Imported Successfully'),'type' => 'success']);
        }else{
            return redirect()->back()->with(['msg' => __('Something went wrong'),'type' => 'danger']);
        }
    }

    public function getStatisticsCategoryData($slug){
        $all_stats_categoties = StatisticsCategory::with('subCategories')->get();
        $all_stats_sub_categoties = StatisticsSubCategory::all();
        $category_data = ExcelSheet::where('cat_slug',$slug)->with('getCategory')->get();

        return view('frontend.pages.statistics.index-category-data',compact('category_data','all_stats_categoties','all_stats_sub_categoties'));
    }
    public function getStatisticsSubCategoryData($slug){

        $all_stats_categoties = StatisticsCategory::with('subCategories')->get();
        $all_stats_sub_categoties = StatisticsSubCategory::all();
        $category_data = ExcelSheet::where('sub_cat_slug',$slug)->with('getSubCategory')->get();
        return view('frontend.pages.statistics.index-sub-category-data',compact('category_data','all_stats_categoties','all_stats_sub_categoties'));
    }

    public function getCatData($slug,$id){
        $all_stats_categoties = StatisticsCategory::with('subCategories')->get();
        $all_stats_sub_categoties = StatisticsSubCategory::all();
        $category_data = ExcelSheet::find($id);
        return view('frontend.pages.statistics.table-data',compact('category_data','all_stats_categoties','all_stats_sub_categoties'));
    }
    public function getSubCatData($slug,$id){
        $all_stats_categoties = StatisticsCategory::with('subCategories')->get();
        $all_stats_sub_categoties = StatisticsSubCategory::all();
        $category_data = ExcelSheet::find($id);
        return view('frontend.pages.statistics.table-data',compact('category_data','all_stats_categoties','all_stats_sub_categoties'));
    }


}
