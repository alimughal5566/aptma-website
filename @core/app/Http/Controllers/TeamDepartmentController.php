<?php

namespace App\Http\Controllers;

use App\Language;
use App\TeamDepartment;
use App\TeamMember;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TeamDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

//    public function index()
//    {
//        $all_language = Language::all();
//        $all_team_member = TeamMember::with('category')->get()->groupBy('lang');
//        $categories = TeamDepartment::where(['status' => 'publish' ,'lang' => get_default_language()])->get();
//        return view('backend.pages.team-member')->with(['all_team_member' => $all_team_member,'all_languages' => $all_language,'categories' => $categories]);
//    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'designation' => 'required|string|max:191',
            'icon_one' => 'nullable|string|max:191',
            'icon_two' => 'nullable|string|max:191',
            'icon_three' => 'nullable|string|max:191',
            'icon_one_url' => 'nullable|string|max:191',
            'icon_two_url' => 'nullable|string|max:191',
            'icon_three_url' => 'nullable|string|max:191',
            'description' => 'required|string|max:555',
            'about_me' => 'required|string|max:255',
            'image' => 'required|string|max:225',
            'cat_id' => 'required|string|max:225',

        ]);
        TeamMember::create($request->all());
        return redirect()->back()->with(['msg' => __('New Team Member Added...'), 'type' => 'success']);
    }

    public function update(Request $request)
    {


        $this->validate($request, [
            'name' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'designation' => 'required|string|max:191',
            'image' => 'nullable|string|max:191',
            'icon_one' => 'nullable|string|max:191',
            'icon_two' => 'nullable|string|max:191',
            'icon_three' => 'nullable|string|max:191',
            'icon_one_url' => 'nullable|string|max:191',
            'icon_two_url' => 'nullable|string|max:191',
            'icon_three_url' => 'nullable|string|max:191',
            'about_me' => 'required|string|max:255',
            'description' => 'required|string|max:555',
            'cat_id' => 'required|string|max:225',

        ]);
        TeamMember::find($request->id)->update($request->all());

        return redirect()->back()->with(['msg' => __('Team Member Details Updated...'), 'type' => 'success']);
    }

    public function delete($id)
    {
       TeamMember::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Delete Success...'), 'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        $all = TeamMember::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }



    public function category_index(){
//        dd();
        $all_gallery_images = TeamDepartment::all()->groupBy('lang');
        $all_languages = Language::all();
        return view('backend.teamdepartment.category')->with(['all_category' => $all_gallery_images,'all_languages' => $all_languages ]);
    }

    public function category_store(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'status' => 'required|string',
            'lang' => 'required|string',
            'image' => 'required|string',
            'order_no' => 'required|string',
        ]);

        TeamDepartment::create([
            'status' => $request->status,
            'lang' => $request->lang,
            'name' => $request->title,
            'img_id' => $request->image,
            'order_no' => $request->order_no,
        ]);
        return redirect()->back()->with(['msg' => __('Team department Added...'),'type' => 'success']);
    }
    public function category_update(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'status' => 'required|string',
            'lang' => 'required|string',
            'image' => 'required|string',
            'order_no' => 'required|string',
        ]);

        TeamDepartment::where('id',$request->id)->update([
            'status' => $request->status,
            'lang' => $request->lang,
            'name' => $request->title,
            'img_id' => $request->image,
            'order_no' => $request->order_no,
        ]);
        return redirect()->back()->with(['msg' => __('Data Updated...'),'type' => 'success']);
    }
    public function category_delete(Request $request,$id){
        TeamDepartment::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Data Delete...'),'type' => 'danger']);
    }

    public function category_bulk_action(Request $request){
        $all = TeamDepartment::find($request->ids);
        foreach($all as $item){
            if ($request->type == 'delete'){
                $item->delete();
            }else{
                TeamDepartment::find($item->id)->update(['status' => $request->type]);
            }

        }
        return response()->json(['status' => 'ok']);
    }

}
