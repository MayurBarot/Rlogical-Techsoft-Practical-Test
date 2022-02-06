<?php

namespace App\Http\Controllers;

use App\Models\schedules;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class SchedulesController extends Controller
{
    protected $User;

    public function __construct(User $User)
    {
        $this->middleware('auth');
        $this->User = $User;
    }

    /* get user all own schedules data */
    public function index()
    {
        $schedule=schedules::getAllOwnSchedule();
        return view('user')->with('schedules',$schedule);
    }

    /* create schdule form funcation */
    public function create(User $users)
    {
        $currentUserId = $this->User->getCurrentUserId(); // get login user id
        $users = $this->User->getAllUsers($currentUserId); // get all users except login user
        return view('create_schedule')
                ->with('users',$users);
    }

    //store data to database
    public function store(Request $request)
    {
        $currentUserId = $this->User->getCurrentUserId(); // get login user id
        $request->validate([
            'to_user_id' => 'required',
            'date' => 'required',
            'startTime' => 'required',
            'endTime' => 'required|after:startTime',
        ]);
        $request->merge(['created_by' => $currentUserId]); // merge created by filed in request array

        $recordExits = schedules::recordExits($request); // check data already book or not

        if(isset($recordExits) && !empty($recordExits)){
            return redirect()->back()->with('error', 'This slot already book please try with other start time');
        }

        schedules::create($request->all()); //store data to database

        return redirect()->route('schedules.index')
                        ->with('success','Schedule created successfully.');
    }

    //Delete records from database
    public function destroy($id)
    {
        $schedules=schedules::find($id);
        $schedules->delete();
    
        return redirect()->route('schedules.index')
                        ->with('success','Schedule deleted successfully');
    }

    //show all schedules request list  for admin
    public function admin_schedules_list()
    {
        $schedule=schedules::getAdminAllUserSchedule();
        return view('admin')->with('schedules',$schedule);
    }

     //Admin Approved schedules request 
    public function admin_schedules_approved($id)
    {
        //
        $schedules=schedules::find($id);
        $schedules->status = 'Approved';
        $schedules->save();
        return back()->with('success','Schedule approved successfully');
    }

    //Admin Reject schedules request 
    public function admin_schedules_rejected($id)
    {
        //
        $schedules=schedules::find($id);
        $schedules->status = 'Rejected';
        $schedules->save();
        return back()->with('success','Schedule rejected successfully');
    }

    //show approved schedules request for users
    public function schedules_meeting()
    {
        $schedule=schedules::getAllRequestSchedule();
        return view('meeting_schedule')->with('schedules',$schedule);
    }
}
