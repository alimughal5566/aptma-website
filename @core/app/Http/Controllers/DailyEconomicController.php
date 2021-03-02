<?php

namespace App\Http\Controllers;
use App\Language;
use App\DailyEconomic;
use App\DailyEconomicCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;




class DailyEconomicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_gallery_images = DailyEconomic::with('category')->get();
//        dd*();
        $all_languages = Language::all();
        $all_categories = DailyEconomicCategory::where(['status' => 'publish' ,'lang' => get_default_language()])->get();
        return view('backend.daily-economic-update.index')->with(['all_gallery_images' => $all_gallery_images,'all_languages' => $all_languages,'all_categories' => $all_categories]);
        }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'is_featured' => 'required|string',
            'category' => 'required|string',
            'pdf_file' => 'required|file',
            'thumbnail' => 'required',

        ]);
        $name=time();
//        if ($request->pdf_file) {
//            $url =  $name. '.' . $request->pdf_file->extension();
//            $request->pdf_file->move('assets/uploads/daily-economics/', $url);
//        }
        if ($request->pdf_file) {
            $profile_pic =  $name.'.'.$request->pdf_file->extension();
            $request->pdf_file->move('assets/uploads/daily-economics/',$profile_pic);
//            $data->url=$profile_pic;
        }

//dd();
        DailyEconomic::create([
            'status' => $request->status,
            'is_featured' => $request->is_featured,
            'title' => $request->title,
            'url' => $profile_pic,
            'cat_id' => $request->category,
            'publish_date' => $request->publish_date,
            'slug' =>Str::slug($request->title.'-'.$request->category),
            'thumbnail' =>$request->thumbnail,
        ]);
        return redirect()->back()->with(['msg' => __('Data added...'),'type' => 'success']);
    }
    public function update(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'is_featured' => 'required|string',
            'category' => 'required|string',
            'thumbnail' => 'required|string',
        ]);

        $name=time();
        $data= DailyEconomic::find($request->id);
             if ($request->pdf_file) {
                 $profile_pic =  $name.'.' . $request->pdf_file->extension();
                 $request->pdf_file->move('assets/uploads/daily-economics/', $profile_pic);
                 $data->url=$profile_pic;
             }

//             $pdfpath = asset('/assets/uploads/daily-economics/'.$profile_pic);
//
//        $pdfO = new Pdf($pdfpath);
//        $pdfO->setPage(1)
//            ->saveImage('/assets/uploads/daily-economics/'); ;
//dd();
//        $thumbnailPath = public_path('assets/uploads/daily-economics/');

//        $pdf = new PDF($pdfpath);
//        $pdf->saveImage($pdfpath);


//        $thumbnail = $pdfO->setPage(1)
//        $pdfO->setOutputFormat('png')->saveImage($pdfpath);
//
//dd();
          $data->status= $request->status;
          $data->is_featured=$request->is_featured;
//          $data->description=$request->description;
//          $data->thumbnail= $request->edit_image;
          $data->title=$request->title;
          $data->publish_date=$request->publish_date;
          $data->cat_id=$request->category;
          $data->thumbnail=$request->thumbnail;
          $data->slug=Str::slug($request->title.' '.$data->cat_id);
          $data->save();
        return redirect()->back()->with(['msg' => __('Data Updated...'),'type' => 'success']);
    }
    public function delete(Request $request,$id){
        DailyEconomic::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Data Deleted...'),'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        $all = DailyEconomic::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }

    public function category_index(){
//        dd();
        $all_gallery_images = DailyEconomicCategory::all()->groupBy('lang');
        $all_languages = Language::all();
        return view('backend.daily-economic-update.category')->with(['all_category' => $all_gallery_images,'all_languages' => $all_languages ]);
    }
    public function category_store(Request $request){
//        dd();
        $this->validate($request,[
            'name' => 'required|string|unique:daily_economic_categories',
            'status' => 'required|string',
            'lang' => 'required|string',
        ]);
//dd();
        DailyEconomicCategory::create([
            'status' => $request->status,
            'lang' => $request->lang,
            'name' => $request->name,
            'slug' =>Str::slug($request->name)
        ]);
        return redirect()->back()->with(['msg' => __('Category Added...'),'type' => 'success']);
    }
    public function category_update(Request $request){
//        dd();
        $this->validate($request,[
            'name' => 'required|string|string|unique:daily_economic_categories,name,'.$request->id,
            'status' => 'required|string',
            'lang' => 'required|string',
        ]);
//        dd();
        DailyEconomicCategory::where('id',$request->id)->update([
            'status' => $request->status,
            'lang' => $request->lang,
            'name' => $request->name,
            'slug' =>Str::slug($request->name)
        ]);
        return redirect()->back()->with(['msg' => __('Category Updated...'),'type' => 'success']);
    }
    public function category_delete(Request $request,$id){
        DailyEconomicCategory::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Category Delete...'),'type' => 'danger']);
    }

    public function category_bulk_action(Request $request){
        $all = DailyEconomicCategory::find($request->ids);
        foreach($all as $item){
            if ($request->type == 'delete'){
                $item->delete();
            }else{
                DailyEconomicCategory::find($item->id)->update(['status' => $request->type]);
            }

        }
        return response()->json(['status' => 'ok']);
    }
    public function category_by_slug(Request $request)
    {
        $service_category = DailyEconomicCategory::where(['status' => 'publish', 'lang' => $request->lang])->get();
        return response()->json($service_category);
    }
}
