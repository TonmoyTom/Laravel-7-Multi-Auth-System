<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin');
    }

    public function profile()
    {
        return view('auth.Admin.profile');
    }

     public function profilechange()
    {
        $admindetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('auth.Admin.profilechange')->with(compact('admindetails'));
    }

    public function oldPassword(Request $request){
        $data = $request->all();
        // echo "<pre>" ; print_r($data); 
        // echo "<pre>" ; print_r( Auth::guard('admin')->user()->password); 
        if(Hash::check($data['old_password'],Auth::guard('admin')->user()->password)){
            echo "true";
        }else{
            echo "false";
        }
    }


    public function upadtepassword(Request $request){
         if($request->isMethod('post')){
             $data = $request->all();
            //Password Change
            //  print_r($data);
            if(Hash::check($data['old_password'],Auth::guard('admin')->user()->password)){
                if($data['new_password'] == $data['confirm_pass']){
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=> bcrypt($data['new_password'])]);
                    return redirect()->route('admin.profile.change')->with('success','Your Password Has been Change!');
                }else{
                    return redirect()->route('admin.profile.change')->with('error','Your  Password Is Not Match!');
                }
            }else{
               return redirect()->route('admin.profile.change')->with('error','Your current Password Is Incorrect!');
            }
         }
    }

    public function upadteprofile()
    { $admindetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('auth.Admin.updateprofile')->with(compact('admindetails'));
    }
    public function upadteprofilestore(Request $request)
    {
        

        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'name' => 'required',
                'email' => 'required',
            ];
            $customMessage = [
                'name.required' => 'Name Is Requerd',
                'email.required' => 'email Is Requerd',
            ];
                $this->validate($request,$rules,$customMessage);

                if(Hash::check($data['old_password'],Auth::guard('admin')->user()->password)){
                    Admin::where('email', Auth::guard('admin')->user()->email)->update(['name'=> $data['name'],'email' =>$data['email']]);
                    return redirect()->route('admin.update.profile.change')->with('success','Your current profile  has Been Change!');
                }else{
                    return redirect()->route('admin.update.profile.change')->with('error','Your current Password Is Incorrect!');
                }
        }
    }
}
