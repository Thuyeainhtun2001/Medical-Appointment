<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Deparment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    //schedule
    public function schedule()
    {
        $data = Doctor::get();
        $data2 = Deparment::get();
        return view('admin.createSchedule', compact('data', 'data2'));
    }
    // create
    public function create(Request $request)
    {
        // validation
        $this->vali($request);
        // data
        $data = $this->dataArrange($request);
        Appointment::create($data);
        return back()->with(['success' => 'create doctor schedule is successs']);
    }
    // list
    public function list()
    {
        $data = Appointment::select('appointments.*', 'doctors.name as doctorName')
            ->leftJoin('doctors', 'doctors.id', 'appointments.doctor_id')
            ->paginate(4);
        return view('admin.scheduleList', compact('data'));
    }
    // edit
    public function edit($id){
       $data = Appointment::where('id',$id)->first();
       $doctData = Doctor::get();
       $deparData = Deparment::get();
        return view('admin.scheduleEdit',compact('data','doctData','deparData'));
    }
    //update
    public function update(Request $request,$id){
        // valid
        $this->vali($request);
        //data
        $data = $this->dataArrange($request);
        Appointment::where('id',$id)->update($data);
        return redirect()->route('admin.doctor.schedule.list')->with(['success'=>'updat your data is success']);
    }
    // delete
    public function delete($id){
        Appointment::where('id',$id)->delete();
        return back()->with(['success'=>'delete shcedule data is success']);
    }
    // validation
    private function vali($request)
    {
        $rules = [
            'doctorName' => 'required',
            'deparment' => 'required',
            'start' => 'required',
            'end' => 'required',
            'day'=>'required',
        ];
        Validator::make($request->all(), $rules)->validate();
    }
    // dataArrange
    private function dataArrange($request)
    {
        return [
            'doctor_id' => $request->doctorName,
            'deparment_id' => $request->deparment,
            'start_time' => $request->start,
            'end_time' => $request->end,
            'day' => $request->day,
        ];
    }
}
