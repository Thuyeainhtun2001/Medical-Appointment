<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ContantController extends Controller
{
    //profile
    public function profile()
    {
        return view('profile');
    }
    // for edit profile
    public function editProfile(Request $request)
    {
        // for validation
        $this->vali($request);
        // dataArrange
        $data = $this->dataArrange($request);
        // for image
        if ($request->hasFile('image')) {
            $dbImage =  User::where('id', Auth::user()->id)->value('image');
            // image detlete from database
            if ($dbImage != NULL) {
                Storage::delete('/public/profile/' . $dbImage);
            }
            // save image
            $newImage = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('/public/profile/', $newImage);
            $data['image'] = $newImage;
        }
        // update data
        User::where('id', Auth::user()->id)->update($data);
        return back()->with(['success' => 'update your information data is success!']);
    }
    // change password
    public function changePassword(Request $request)
    {
        // validation
        $this->pwVali($request);
        $dbData = User::where('id', Auth::user()->id)->first();
        $dbPassword = $dbData->password;
        if (Hash::check($request->oldPassword, $dbPassword)) {
            $newPasword = Hash::make($request->newPassword);
            User::where('id', Auth::user()->id)
                ->update(['password' => $newPasword]);
            Auth::guard('web')->logout();
            return redirect()->route('home')->with(['success' => 'change your passord is OK!']);
        } else {
            return back()->with(['error' => 'update your password is not OK!^!']);
        }
    }
    // for validation for password
    private function pwVali($request)
    {
        Validator::make(
            $request->all(),
            [
                'oldPassword' => 'required',
                'newPassword' => 'required|min:8|different:oldPassword',
                'cmPassword' => 'required|same:newPassword',
            ]
        )->validate();
    }
    // for validation
    private function vali($request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
        ];
        Validator::make($request->all(), $rules)->validate();
    }
    // for data arrange
    private function dataArrange($request)
    {
        return [
            'name' => $request->name,
            'gender' => $request->gender,
            'age' => $request->age,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
        ];
    }
}
