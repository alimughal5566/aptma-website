<?php

namespace App\Http\Controllers;

use App\ImageGallery;
use App\ImageGalleryCategory;
use App\Language;
use App\Advertisement;
use App\AdvertisementCategory;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_gallery_images = Advertisement::with('category')->get();
//        dd*();
        $all_languages = Language::all();
        $all_categories = AdvertisementCategory::where(['status' => 'publish' ,'lang' => get_default_language()])->get();
        return view('backend.advertisement.index')->with(['all_gallery_images' => $all_gallery_images,'all_languages' => $all_languages,'all_categories' => $all_categories]);
        }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'thumbnail' => 'required',
            'is_featured' => 'required|string',
            'category' => 'required|string',
        ]);


        Advertisement::create([
            'status' => $request->status,
            'is_featured' => $request->is_featured,
            'thumbnail' => $request->thumbnail,
            'title' => $request->title,
            'cat_id' => $request->category,
        ]);
        return redirect()->back()->with(['msg' => __('New advertisement added...'),'type' => 'success']);
    }
    public function update(Request $request){
        $this->validate($request,[
            'edit_image' => 'required|max:2048',
            'title' => 'required|string',
            'is_featured' => 'required|string',
            'category' => 'required|string',
        ]);

        $data= Advertisement::find($request->id);
          $data->status= $request->status;
          $data->is_featured=$request->is_featured;
          $data->thumbnail= $request->edit_image;
          $data->title=$request->title;
          $data->publish_date=$request->publish_date;
          $data->cat_id=$request->category;
          $data->save();
        return redirect()->back()->with(['msg' => __('Data Updated...'),'type' => 'success']);
    }
    public function delete(Request $request,$id){
        Advertisement::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Data Deleted...'),'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        $all = Advertisement::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }

    public function category_index(){
//        dd();
        $all_gallery_images = AdvertisementCategory::all()->groupBy('lang');
        $all_languages = Language::all();
        return view('backend.advertisement.category')->with(['all_category' => $all_gallery_images,'all_languages' => $all_languages ]);
    }
    public function category_store(Request $request){
        $this->validate($request,[
            'name' => 'required|string|unique:advertisement_categories',
            'status' => 'required|string',
            'lang' => 'required|string',
        ]);
//dd();
        AdvertisementCategory::create([
            'status' => $request->status,
            'lang' => $request->lang,
            'name' => $request->name,
        ]);
        return redirect()->back()->with(['msg' => __('Category Added...'),'type' => 'success']);
    }
    public function category_update(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'status' => 'required|string',
            'lang' => 'required|string',
        ]);
        AdvertisementCategory::where('id',$request->id)->update([
            'status' => $request->status,
            'lang' => $request->lang,
            'name' => $request->title,
        ]);
        return redirect()->back()->with(['msg' => __('Category Updated...'),'type' => 'success']);
    }
    public function category_delete(Request $request,$id){
        AdvertisementCategory::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Category Delete...'),'type' => 'danger']);
    }

    public function category_bulk_action(Request $request){
        $all = AdvertisementCategory::find($request->ids);
        foreach($all as $item){
            if ($request->type == 'delete'){
                $item->delete();
            }else{
                AdvertisementCategory::find($item->id)->update(['status' => $request->type]);
            }

        }
        return response()->json(['status' => 'ok']);
    }
    public function category_by_slug(Request $request)
    {
        $service_category = AdvertisementCategory::where(['status' => 'publish', 'lang' => $request->lang])->get();
        return response()->json($service_category);
    }
//
//    public function page_settings(){
//        $all_languages = Language::all();
//        return view('backend.image-gallery.image-gallery-page-settings')->with(['all_languages' => $all_languages]);
//    }
//
//    public function update_page_settings(Request $request){
//        $this->validate($request,[
//           'site_image_gallery_post_items' => 'required',
//           'site_image_gallery_order' => 'required',
//           'site_image_gallery_order_by' => 'required',
//        ]);
//        $all_fields  = [
//            'site_image_gallery_post_items',
//            'site_image_gallery_order',
//            'site_image_gallery_order_by'
//        ];
//
//        foreach ($all_fields as $field){
//            update_static_option($field,$request->$field);
//        }
//
//        return redirect()->back()->with(['msg' => __('Settings Updated...'),'type' => 'success']);
//    }
}
