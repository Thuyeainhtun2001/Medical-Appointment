<?php

namespace App\Http\Controllers;

use App\Models\Deparment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DeparmentController extends Controller
{
    //create deparment
    public function createDeparment(){
        return view('admin.createDeparment');
    }
    // create data
    public function createData(Request $request){
        // validtaion
        $this->vali($request);
        // data
        $data = $this->dataArrange($request);
        // for image
        if($request->hasFile('image')){
           $imageName = uniqid().$request->file('image')->getClientOriginalName();
           $request->file('image')->storeAs('/public/deparments/',$imageName);
           $data['image']=$imageName;
        }
        Deparment::create($data);
        return back()->with(['success'=>'create your deparment data is successs...']);
    }
    // list
    public function list(){
        $data = Deparment::paginate(3);
        return view('admin.deparmentList',compact('data'));
    }
    // detail
    public function detail($id){
       $data = Deparment::where('id',$id)->first();
       return view('admin.deparmentDetail',compact('data'));
    }
    // for update
    public function edit($id){
       $data = Deparment::where('id',$id)->first();
       return view('admin.deparmentEdit',compact('data'));
    }
    //update
    public function update(Request $request,$id){
        $this->vali($request);
        $data = $this->dataArrange($request);
        if($request->hasFile('image')){
           $dbImg = Deparment::where('id',$id)->value('image');
           if($dbImg != NULL){
            Storage::delete('public/deparments/'.$dbImg);
           }
           $imageName = uniqid().$request->file('image')->getClientOriginalExtension();
           $request->file('image')->storeAs('/public/deparments/',$imageName);
           $data['image']=$imageName;
        }
        Deparment::where('id',$id)->update($data);
        return back()->with(['success'=>'update your data is successs']);
    }
    //delete
    public function delete($id){
        $dbImg = Deparment::where('id',$id)->value('image');
        if($dbImg != NULL){
            Storage::delete('public/deparments/'.$dbImg);
        }
        Deparment::where('id',$id)->delete();
        return back()->with(['success'=>'delete your data is successs']);
    }
    // validation
    private function vali($request){
        $rules = [
            'deparmentName'=>'required',
            'deparmentDescription'=>'required',
        ];
        $messages = [
            'deparmentName.required'=>'Please fill your deparment name',
            'deparmentDescription.required'=>'please fill your description',
        ];
        Validator::make($request->all(),$rules,$messages)->validate();
    }
    // dataArrange
    private function dataArrange($request){
        return [
            'deparment'=>$request->deparmentName,
            'description'=>$request->deparmentDescription,
        ];
    }
}
