<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //
    public function list(){
        $data = Patient::paginate(10);
        return view('admin.patientList',compact('data'));
    }
    // finish
    public function finish($id){
        Patient::where('id',$id)->update(['finish'=>1]);
        return back()->with(['success'=>'Those patient is finished']);
    }
    // delete
    public function delete($id){
        Patient::where('id',$id)->delete();
        return back()->with(['success'=>'delete patient data is success']);
    }
    // user list
    public function userList(){
        $data = User::where('role','user')->paginate(10);
        return view('admin.userList',compact('data'));
    }
    // chagne
    public function change($id){
        User::where('id',$id)->update(['role'=>'admin']);
        return back()->with(['success'=>'change to admin is successs']);
    }
    // user delete
    public function userDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['success'=>'delete user data is successs']);
    }
    // admin list
    public function adminList(){
        $data = User::where('role','admin')->paginate(10);
        return view('admin.adminList',compact('data'));
    }
    // demote
    public function demote($id){
        User::where('id',$id)->update(['role'=>'user']);
        return back()->with(['success'=>'change to user is successs']);
    }
    // admindelete
    public function adminDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['success'=>'delete admin data is success']);
    }
}
