<?php

namespace App\Http\Controllers;
use App\Advertisement;
use App\Language;
use App\StatisticsCategory;
use App\StatisticsSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function categoriesIndex(){

        $all_languages = Language::all();
        $all_category = StatisticsCategory::all();
        return view('backend.statistics.category',compact('all_languages','all_category'));
    }
    public function categoriesStore(Request $request){

        $this->validate($request,[
            'name' => 'required|string',
            'status' => 'required',
            'lang' => 'required',
        ]);
        StatisticsCategory::create([
            'status' => $request->status,
            'title' => $request->name,
            'lang' => $request->lang,
            'slug'=>Str::slug($request->name.'-'.Str::random(2))
        ]);
        return redirect()->back()->with(['msg' => __('New Category added...'),'type' => 'success']);

    }
    public function categoriesUpdate(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'status' => 'required',
            'lang' => 'required',
        ]);

        $data= StatisticsCategory::find($request->id);
        $data->status= $request->status;
        $data->title=$request->title;
        $data->lang=$request->lang;
        $data->slug=Str::slug($request->title.'-'.Str::random(2));
        $data->save();
        return redirect()->back()->with(['msg' => __('Data Updated...'),'type' => 'success']);
    }

    public function subCategoriesIndex(){
        $all_languages = Language::all();
        $all_category = StatisticsSubCategory::all();
        $all_main_categories = StatisticsCategory::all();
        return view('backend.statistics.sub-category',compact('all_languages','all_category','all_main_categories'));
    }
    public function subCategoriesStore(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'status' => 'required',
            'lang' => 'required',
            'category' => 'integer',
        ]);
       $sub_cat = StatisticsSubCategory::find($request->id);
       $sub_cat->title = $request->title;
       $sub_cat->cat_id = $request->main_category;
       $sub_cat->status = $request->status;
       $sub_cat->lang = $request->lang;
       $sub_cat->save();
        return redirect()->back()->with(['msg' => __('New Sub Category added...'),'type' => 'success']);

    }



}
