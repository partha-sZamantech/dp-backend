<?php

namespace App\Http\Controllers\Backend\Settings\User;

use App\Http\Controllers\Controller;
use App\Models\BnCategory;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->where('visibility', 1)->where('deletable', 1)->latest()->get();

        return view('backend.user.user.user_list', compact('users'));
    }

    public function create()
    {
        $categories = BnCategory::select('cat_id', 'cat_name', 'cat_name_bn')->where(['cat_type' => 1, 'status' => 1, 'deletable' => 1])->get();
        return view('backend.user.user.user_create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'designation' => 'required',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $user = new User();
        $user->name         = $request->name;
        $user->designation  = $request->designation;
        $user->username     = $request->username;
        $user->email        = $request->email;
        $user->password     = bcrypt($request->password);
        $user->role         = $request->role;
        $user->status       = $request->status;
        $user->save();

        // If the user is catAdmin
        if ($user->role == 4 && count($request->category)) {
            $user->bn_cat_ids = implode(',', $request->category);
            $user->save();
        }

        return redirect('backend/users')->with('successMsg', 'The user has been submitted successfully!');
    }

    public function edit($id)
    {
        $user = User::find($id);

        $categories = BnCategory::select('cat_id', 'cat_name', 'cat_name_bn')->where(['cat_type' => 1, 'status' => 1, 'deletable' => 1])->get();

        return view('backend.user.user.user_edit', compact('user', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'designation' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'username' => 'required|unique:users,username,'.$id,
        ]);

        $user = User::find($id);
        $user->name         = $request->name;
        $user->designation  = $request->designation;
        $user->username     = $request->username;
        $user->email        = $request->email;
        $user->role         = $request->role;
        $user->status       = $request->status;

        // If the user is catAdmin
        if ($user->role == 4 && count($request->category)) {
            $user->bn_cat_ids = implode(',', $request->category);
        }

        $user->save();

        return redirect('backend/users')->with('successMsg', 'The user has been updated successfully!');
    }

    public function destroy($id)
    {
        User::where('id', $id)->update(['deletable' => 2]);
        return redirect('backend/users')->with('successMsg', 'The user has been removed successfully!');
    }

    public function getChangePassword($id){
        $user = User::find($id);

        return view('backend.user.user.change_password', compact('user'));
    }

    public function postChangePassword(Request $request, $id){
        $this->validate($request, [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        User::where('id', $id)->update(['password' => bcrypt($request->password)]);
        return redirect('backend/users')->with('successMsg', 'The user password has been changed successfully!');
    }
}
