<?php

namespace App\Http\Controllers;

use App\Language;
use App\TeamType;
use App\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

//    public function index()
//    {
//        $all_language = Language::all();
//        $all_team_member = TeamMember::with('category')->get()->groupBy('lang');
//        $categories = TeamType::where(['status' => 'publish' ,'lang' => get_default_language()])->get();
//        return view('backend.pages.team-member')->with(['all_team_member' => $all_team_member,'all_languages' => $all_language,'categories' => $categories]);
//    }




//    public function delete($id)
//    {
//        TeamMember::find($id)->delete();
//        return redirect()->back()->with(['msg' => __('Delete Success...'), 'type' => 'danger']);
//    }
//
//    public function bulk_action(Request $request)
//    {
//        $all = TeamType::find($request->ids);
//        foreach ($all as $item) {
//            $item->delete();
//        }
//        return response()->json(['status' => 'ok']);
//    }


    public function category_index()
    {
//        dd();
        $all_gallery_images = TeamType::all()->groupBy('lang');
        $all_languages = Language::all();
        return view('backend.teamtype.category')->with(['all_category' => $all_gallery_images, 'all_languages' => $all_languages]);
    }

    public function category_store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|unique:team_type,name',
            'status' => 'required|string',
            'lang' => 'required|string',
            'image' => 'required|string',
            'order_no' => 'required|string',
        ]);

        TeamType::create([
            'status' => $request->status,
            'lang' => $request->lang,
            'name' => $request->title,
            'img_id' => $request->image,
            'order_no' => $request->order_no,
        ]);
        return redirect()->back()->with(['msg' => __('Team type Added...'), 'type' => 'success']);
    }

    public function category_update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|unique:team_type,name,'.$request->id,
            'status' => 'required|string',
            'lang' => 'required|string',
            'image' => 'required|string',
            'order_no' => 'required|string',
        ]);

        TeamType::where('id', $request->id)->update([
            'status' => $request->status,
            'lang' => $request->lang,
            'name' => $request->title,
            'img_id' => $request->image,
            'order_no' => $request->order_no,
            'slug' => Str::slug($request->title),
        ]);
        return redirect()->back()->with(['msg' => __('Data Updated...'), 'type' => 'success']);
    }

//    public function category_delete(Request $request, $id)
//    {
//        TeamType::find($id)->delete();
//        return redirect()->back()->with(['msg' => __('Data Delete...'), 'type' => 'danger']);
//    }

    public function category_bulk_action(Request $request)
    {
        $all = TeamType::find($request->ids);
        foreach ($all as $item) {
            if ($request->type == 'delete') {
                $item->delete();
            } else {
                TeamType::find($item->id)->update(['status' => $request->type]);
            }

        }
        return response()->json(['status' => 'ok']);
    }

}
