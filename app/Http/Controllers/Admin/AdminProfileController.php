<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Hash;
class AdminProfileController extends Controller
{
    public function adminProfile()
    {
       return view('admin.adminProfile');
    }
    public function adminProfileEditSubmit(Request $request)
    {
        //dd($request);
        $email = $request->email;
        $adminData = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        if($request->password){
                $request->validate([
                            'password' => 'required',
                            'retype_password' =>'required|same:password'       
                    ]);
                    $adminData->password = Hash::make($request->password);
        }
        /* To add Photo */
        if($request->hasFile('avtar'))
        {
          
            $request->validate([
                        'avtar' => 'image|mimes:jpg,png,gif,jpeg'
                ]);
                unlink(public_path('admin/uploads/'.$adminData->avtar));
                $ext = $request->file('avtar')->extension();
               
                $finalName = 'admin'.".".$ext;
                $request->file('avtar')->move(public_path('admin/uploads/'),$finalName);
                $adminData->avtar = $finalName;
        }

        //dd($adminData);
        $adminData->name = $request->name;
        $adminData->email = $request->email;
        $adminData->update();
        return redirect()->route('adminProfile')->with('success','Profile Updatd Successful');
    }
}
