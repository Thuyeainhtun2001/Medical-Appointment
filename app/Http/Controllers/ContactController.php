<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Symfony\Component\String\b;

class ContactController extends Controller
{
    //contact
    public function contact(Request $request){
        // validation
        $this->vali($request);
        // data
        $data = $this->dataArrange($request);
        Contact::create($data);
        return back()->with(['success'=>'your contact data is success']);
    }
    // contact list
    public function contactList(){
        $data = Contact::paginate(5);
        return view('admin.contactList',compact('data'));
    }
    //delete
    public function contactDelete($id){
        Contact::where('id',$id)->delete();
        return back()->with(['success'=>'delete contact data is success']);
    }
    // validation
    private function vali($request){
        $rules=[
            'name'=>'required',
            'message'=>'required',
        ];
        Validator::make($request->all(),$rules)->validate();
    }
    // dataArrange
    private function dataArrange($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=>$request->message,
        ];
    }
}
