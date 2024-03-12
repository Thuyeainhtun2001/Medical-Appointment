<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Deparment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    //show
    public function show()
    {
        $data = Deparment::get();
        return view('deparmentShow', compact('data'));
    }
    // doctor
    public function display()
    {
        $data = Doctor::select('doctors.*', 'deparments.deparment as deparmentName')
            ->leftJoin('deparments', 'deparments.id', 'doctors.deparment_id')
            ->get();
        return view('doctorDisplay', compact('data'));
    }
    // for form
    public function doctor()
    {
        $data = Deparment::get();
        return view('admin.createDoctor', compact('data'));
    }
    // create
    public function create(Request $request)
    {
        // validation
        $this->vali($request);
        // data
        $data = $this->dataArrange($request);
        // for image
        if ($request->hasFile('image')) {
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('/public/deparments/', $imageName);
            $data['image'] = $imageName;
        }
        Doctor::create($data);
        return back()->with(['success' => 'create your deparment data is successs...']);
    }
    // list
    public function list()
    {
        $data = Doctor::paginate(5);
        return view('admin.doctorList', compact('data'));
    }
    // detail
    public function detail($id)
    {
        $data = Doctor::where('doctors.id', $id)
            ->select('doctors.*', 'deparments.deparment as deparmentName')
            ->leftJoin('deparments', 'deparments.id', 'doctors.deparment_id')
            ->first();
        return view('admin.doctorDetail', compact('data'));
    }
    // edit
    public function edit($id)
    {
        $doctorData = Doctor::where('id', $id)->first();
        $deparmentData = Deparment::get();
        return view('admin.doctorEdit', compact('doctorData', 'deparmentData'));
    }
    // update
    public function update(Request $request, $id)
    {
        // validation
        $this->vali($request);
        // data
        $data = $this->dataArrange($request);
        // image
        if ($request->hasFile('image')) {
            $dbImg = Deparment::where('id', $id)->value('image');
            if ($dbImg != NULL) {
                Storage::delete('public/deparments/' . $dbImg);
            }
            $imageName = uniqid() . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/public/deparments/', $imageName);
            $data['image'] = $imageName;
        }
        Doctor::where('id', $id)->update($data);
        return back()->with(['success' => 'update your data is successs']);
    }
    // delete
    public function delete($id)
    {
        $dbImg = Doctor::where('id', $id)->value('image');
        if ($dbImg != NULL) {
            Storage::delete('public/deparments/' . $dbImg);
        }
        Doctor::where('id', $id)->delete();
        return back()->with(['success' => 'delete doctor data is successs']);
    }
    // time
    public function timetable($id)
    {
        $data = Doctor::where('doctors.id', $id)
            ->select('doctors.*', 'appointments.*')
            ->leftJoin('appointments','appointments.doctor_id','doctors.id')
            ->get();
        return view('doctorTimetable', compact('data'));
    }
    // appointment
    public function appointment(Request $request){
        $data = [
            'user_id'=>$request->userId,
            'doctor_id'=>$request->doctorId,
        ];
        Patient::create($data);
        return response(200);
    }
    // validation
    private function vali($request)
    {
        $rules = [
            'name' => 'required',
            'degree' => 'required',
            'experience' => 'required',
            'history' => 'required',
            'deparment' => 'required',
        ];
        Validator::make($request->all(), $rules)->validate();
    }
    // dataArrange
    private function dataArrange($request)
    {
        return [
            'deparment_id' => $request->deparment,
            'name' => $request->name,
            'degree' => $request->degree,
            'experience' => $request->experience,
            'history' => $request->history,
        ];
    }
}
