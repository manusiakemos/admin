<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function showProfilePage()
    {
        return view("vendor.admin.profile.profile_page", ['data' => auth()->user()]);
    }

    public function showPasswordPage()
    {
        return view("vendor.admin.profile.password_page");
    }

    public function updateProfile(Request $request)
    {
        $db = UserManagement::find(auth()->id());
        $db->name = $request->name;
        $db->email = $request->email;
        $db->username = $request->username;
        if($request->hasFile('file')){
            $filename = my_upload_file($request->file('file'), 'images');
            $db->avatar = $filename;
        }
        $db->save();
        return responseJson("Profile berhasil diupdate",$db);
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);
        $db = UserManagement::find(auth()->id());
        $db->password = bcrypt($request->password);
        if ($db->save() ) {
//            Auth::logout();
            return responseJson("Password berhasil diubah");
        }
    }

}
