<?php

namespace App\Http\Controllers;

use App\Language;
use App\TeamCategory;
use App\TeamDepartment;
use App\TeamMember;
use App\TeamType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except('teams');
    }

    public function index()
    {

        $all_language = Language::all();
        $all_team_member = TeamMember::with('category', 'department')->get()->groupBy('lang');
        $categories = TeamCategory::where(['status' => 'publish', 'lang' => get_default_language()])->get();
        $types = TeamType::where(['lang' => get_default_language()])->orderby('order_no', 'desc')->get();
        $team_department = TeamDepartment::where(['status' => 'publish', 'lang' => get_default_language()])->orderby('id', 'desc')->get();
        return view('backend.pages.team-member')->with(['all_team_member' => $all_team_member, 'all_languages' => $all_language, 'team_department' => $team_department, 'categories' => $categories, 'types' =>$types]);
    }

    public function teams()
    {
        $teams = TeamCategory::where(['status' => 'publish', 'lang' => get_default_language()])->get();
        return view('frontend.pages.teams')->with(['teams' => $teams]);
    }

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
            'description' => 'required|string|max:5000',
            'about_me' => 'required|string|max:1000',
            'image' => 'required|string|max:225',
            'cat_id' => 'required|string|max:225',
            'department_id' => 'required|string|max:225',
            'order_no' => 'required|string|max:225',
            'show_detail_status' => 'required|string|max:225',
            'is_research_member' => 'required|string|max:225',
            'type' => 'required|string|max:225',
            'type_order' => 'required|string|max:225',
        ]);


        $id= TeamMember::create($request->all());
        $id->slug = Str::slug($request->name.' '.$request->designation);
        $id->save();
        return redirect()->back()->with(['msg' => __('New Member Added...'), 'type' => 'success']);
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
            'about_me' => 'required|string|max:1000',
            'description' => 'required|string|max:5000',
            'cat_id' => 'required|string|max:225',
            'department_id' => 'required|string|max:225',
            'order_no' => 'required|string|max:225',
            'show_detail_status' => 'required|string|max:225',
            'is_research_member' => 'required|string|max:225',
            'type' => 'required|string|max:225',
            'type_order' => 'required|string|max:225',
        ]);
        TeamMember::find($request->id)->update($request->all());
        $id=TeamMember::find($request->id);
        $id->slug = Str::slug($request->name.' '.$request->designation);
        $id->save();
        return redirect()->back()->with(['msg' => __('Team Member Details Updated...'), 'type' => 'success']);
    }

    public function delete($id)
    {
        TeamMember::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Delete Success...'), 'type' => 'danger']);
    }

    public function bulk_action(Request $request)
    {
        $all = TeamMember::find($request->ids);
        foreach ($all as $item) {
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }


    public function category_index()
    {
//        dd();
        $all_gallery_images = TeamCategory::all()->groupBy('lang');
        $all_languages = Language::all();
        return view('backend.team.category')->with(['all_category' => $all_gallery_images, 'all_languages' => $all_languages]);
    }

    public function category_store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|unique:team_categories,name',
            'status' => 'required|string',
            'lang' => 'required|string',
            'image' => 'required|string',
        ]);

        TeamCategory::create([
            'status' => $request->status,
            'lang' => $request->lang,
            'name' => $request->title,
            'img_id' => $request->image,
            'slug' => Str::slug($request->title),
        ]);
        return redirect()->back()->with(['msg' => __('Category Added...'), 'type' => 'success']);
    }

    public function category_update(Request $request)
    {
//        dd($request->id);
        $this->validate($request, [
            'title' => 'required|string|unique:team_categories,name,'.$request->id,
            'status' => 'required|string',
            'lang' => 'required|string',
            'image' => 'required|string',
        ]);

        TeamCategory::where('id', $request->id)->update([
            'status' => $request->status,
            'lang' => $request->lang,
            'name' => $request->title,
            'img_id' => $request->image,
            'slug' => Str::slug($request->title),
        ]);
        return redirect()->back()->with(['msg' => __('Category Updated...'), 'type' => 'success']);
    }

    public function category_delete(Request $request, $id)
    {
        TeamCategory::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Category Delete...'), 'type' => 'danger']);
    }

    public function category_bulk_action(Request $request)
    {
        $all = TeamCategory::find($request->ids);
        foreach ($all as $item) {
            if ($request->type == 'delete') {
                $item->delete();
            } else {
                TeamCategory::find($item->id)->update(['status' => $request->type]);
            }

        }
        return response()->json(['status' => 'ok']);
    }

}
