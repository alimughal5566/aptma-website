<?php

namespace App\Http\Controllers;

use App\ImageGallery;
use App\ImageGalleryCategory;
use App\Language;
use App\Book;
use App\BookCategory;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_gallery_images = Book::with('category')->get();
//        dd*();
        $all_languages = Language::all();
        $all_categories = BookCategory::where(['status' => 'publish' ,'lang' => get_default_language()])->get();
        return view('backend.book.index')->with(['all_gallery_images' => $all_gallery_images,'all_languages' => $all_languages,'all_categories' => $all_categories]);
        }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'thumbnail' => 'required',
            'is_featured' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
            'pdf_file' => 'required|file',
        ]);
        $name=time();
        if ($request->pdf_file) {
            $profile_pic =  $name. '.' . $request->pdf_file->extension();
            $request->pdf_file->move('assets/uploads/books/', $profile_pic);
        }

        Book::create([
            'status' => $request->status,
            'is_featured' => $request->is_featured,
            'description' => $request->description,
            'thumbnail' => $request->thumbnail,
            'title' => $request->title,
            'url' => $name,
            'cat_id' => $request->category,
        ]);
        return redirect()->back()->with(['msg' => __('New book added...'),'type' => 'success']);
    }
    public function update(Request $request){
        $this->validate($request,[
            'edit_image' => 'required|max:2048',
            'title' => 'required|string',
            'is_featured' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
        ]);

        $name=time();
        $data= Book::find($request->id);
             if ($request->pdf_file) {
                 $profile_pic =  $name. '.' . $request->pdf_file->extension();
                 $request->pdf_file->move('assets/uploads/books/', $profile_pic);
                 $data->url=$profile_pic;
             }


          $data->status= $request->status;
          $data->is_featured=$request->is_featured;
          $data->description=$request->description;
          $data->thumbnail= $request->edit_image;
          $data->title=$request->title;
          $data->publish_date=$request->publish_date;
          $data->cat_id=$request->category;
          $data->save();
        return redirect()->back()->with(['msg' => __('Data Updated...'),'type' => 'success']);
    }
    public function delete(Request $request,$id){
        Book::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Video Deleted...'),'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        $all = Book::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }

    public function category_index(){
//        dd();
        $all_gallery_images = BookCategory::all()->groupBy('lang');
        $all_languages = Language::all();
        return view('backend.book.category')->with(['all_category' => $all_gallery_images,'all_languages' => $all_languages ]);
    }
    public function category_store(Request $request){
//        dd();
        $this->validate($request,[
            'title' => 'required|string',
            'status' => 'required|string',
            'lang' => 'required|string',
        ]);
//dd();
        BookCategory::create([
            'status' => $request->status,
            'lang' => $request->lang,
            'name' => $request->title,
        ]);
        return redirect()->back()->with(['msg' => __('Category Added...'),'type' => 'success']);
    }
    public function category_update(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'status' => 'required|string',
            'lang' => 'required|string',
        ]);
        BookCategory::where('id',$request->id)->update([
            'status' => $request->status,
            'lang' => $request->lang,
            'name' => $request->title,
        ]);
        return redirect()->back()->with(['msg' => __('Category Updated...'),'type' => 'success']);
    }
    public function category_delete(Request $request,$id){
        BookCategory::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Category Delete...'),'type' => 'danger']);
    }

    public function category_bulk_action(Request $request){
        $all = BookCategory::find($request->ids);
        foreach($all as $item){
            if ($request->type == 'delete'){
                $item->delete();
            }else{
                BookCategory::find($item->id)->update(['status' => $request->type]);
            }

        }
        return response()->json(['status' => 'ok']);
    }
    public function category_by_slug(Request $request)
    {
        $service_category = BookCategory::where(['status' => 'publish', 'lang' => $request->lang])->get();
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
