<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use Auth;
use Hash;
class AdminloginController extends Controller
{
    public function login()
    {
        /* Password Generation */
       /*  $pass = Hash::make("admin");
        dd($pass); */
        return view('admin.login');
    }
    public function adminLoginProcess(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $cred = [
            'email' => $email,
            'password' => $password
        ];
        // Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])
        if(Auth::guard('admin')->attempt($cred))
         {
            return redirect()->route('adminIndex');
         }
         else{
            return redirect()->route('adminLogin')->with('error','Not a valid Creds');
         }
     //  dd($request);
    }
    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('adminLogin');
    }
    public function forgetPasswordView ()
    {
        return view('admin.forgetpassword');
    }
    public function forgetPasswordSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email'            
        ]);
        $email = $request->email;
        $adminData = Admin::where('email',$email)->first();
        if(!$adminData){
            return redirect()->back()->with('error','Email Address not found');
        }
        else{
           $token = hash('sha256', time());
           $adminData->token = $token;
           $adminData->update();
           $resetLink = url('admin/reset-password/'.$token."/".$email);
           $subject ="Reset Password";
           $mess = "Please click on the following link:<br>";
           $mess.="<a href= '".$resetLink."' >Click here</a>";
            \Mail::to($email)->send(new Websitemail($subject, $mess));
            return redirect()->route('adminLogin')->with('success','Please check you Email for the steps to reset Password');
        }
    }
    public function resetPassword($token, $email){
            $adminData = Admin::where('email',$email)->where('token',$token)->first();
            if(!$adminData){
                return redirect()->route('adminLogin')->with('Error','Token Not Found, Please try to reset Password Again');
            }
            else{
                return view('admin.resetPasswordForm',compact('email','token'));
            }
    }
    public function adminResetPasswordSubmit(Request $request){
          $token = $request->token;
          $email = $request->email;
          $password = $request->password;
           $request->validate([
            'password' => 'required',
            'retype_password' =>'required|same:password'       
        ]);
        $adminData = Admin::where('email',$email)->where('token',$token)->first();
        if(!$adminData){
            return redirect()->route('adminLogin')->with('Error','Token Not Found, Please try to reset Password Again');
        }
        $pass = hash::make($password);
        $adminData->password = $pass;
        $adminData->token ='';
        $adminData->update();
        return redirect()->route('adminLogin')->with('success','Password Reset Successfull!.');
    }
    public function adminProfile()
    {
       return view('admin.adminProfile');
    }
}
