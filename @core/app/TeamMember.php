<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = 'team_members';
    protected $fillable = ['name','lang','description','designation','about_me','image','icon_one','icon_two','icon_three','icon_one_url','icon_two_url','icon_three_url','cat_id','department_id','order_no'];

    public function category(){
        return $this->belongsTo('App\TeamCategory','cat_id');
    }
    public function department(){
        return $this->belongsTo('App\TeamDepartment','department_id');
    }
}
