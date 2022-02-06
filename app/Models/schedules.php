<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\User;
class schedules extends Model
{
    use HasFactory;

    protected $fillable = [
        'to_user_id',
        'date',
        'startTime',
        'endTime',
        'created_by',
        'table_no',
    ];

    // get to user data
    public function user(){
        return $this->hasOne('App\Models\User','id','to_user_id');
    }

    // get created request data
    public function created_user(){
        return $this->hasOne('App\Models\User','id','created_by');
    }

    // get to all users schedule list for each user  
    public static function getAllOwnSchedule(){
        $userId = Auth::id();
        return  schedules::with(['user'])->where('created_by',$userId)->orderBy('id','DESC')->get();
    }

    // get to all users schedule list for Admin
    public static function getAdminAllUserSchedule(){
        return  schedules::with(['user','created_user'])->orderBy('id','DESC')->get();
    }

    // get to all users schedule request approved list for each user 
    public static function getAllRequestSchedule(){
        $userId = Auth::id();
        return  schedules::with(['created_user'])->where('to_user_id',$userId)->where('status','=', 'approved')->orderBy('id','DESC')->get();
    }
    public static function getSchedule($id){
        return  schedules::where('created_by',$id)->orderBy('id','DESC')->first();
    }

    //check already time exist or not for  schedule
    public static function recordExits($data){
        $starttime = date("h:i:s", strtotime($data->startTime));
        return schedules::where('to_user_id',$data->to_user_id)->where('date',$data->date)->where('startTime',$starttime)->first();
    }
}
