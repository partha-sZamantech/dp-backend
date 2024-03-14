<?php

namespace App\Http\Controllers\Backend\Settings\User;

use App\Http\Controllers\Controller;
use App\Models\MisUser;
use Illuminate\Http\Request;

class MisUserController extends Controller
{
    public function index()
    {
        $users = MisUser::where('deletable', 1)->get();

        return view('backend.user.mis.mis_user_list', compact('users'));
    }

    public function create()
    {
        return view('backend.user.mis.mis_user_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required|unique:mis_users',
            'user_initial' => 'required|unique:mis_users'
        ]);

        $user = new MisUser();
        $user->user_type        = $request->user_type;
        $user->dept_type        = $request->dept_type;
        $user->user_name        = $request->user_name;
        $user->user_name_bn     = $request->user_name_bn;
        $user->user_slug        = fFormatUrl($request->user_name);
        $user->user_initial     = $request->user_initial;
        $user->user_initial_bn  = $request->user_initial_bn;
        $user->user_bio         = $request->user_bio;
        $user->user_bio_bn      = $request->user_bio_bn;
        $user->save();

        return redirect('backend/mis-users')->with('successMsg', 'The user has been submitted successfully!');
    }

    public function edit($id)
    {
        $user = MisUser::find($id);

        return view('backend.user.mis.mis_user_edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_name' => 'required',
            'user_initial' => 'required'
        ]);

        $user = MisUser::find($id);
        $user->user_type        = $request->user_type;
        $user->dept_type        = $request->dept_type;
        $user->user_name        = $request->user_name;
        $user->user_name_bn     = $request->user_name_bn;
        $user->user_slug        = fFormatUrl($request->user_name);
        $user->user_initial     = $request->user_initial;
        $user->user_initial_bn  = $request->user_initial_bn;
        $user->user_bio         = $request->user_bio;
        $user->user_bio_bn      = $request->user_bio_bn;
        $user->save();

        return redirect('backend/mis-users')->with('successMsg', 'The user has been updated successfully!');

    }

    public function destroy($id)
    {
        MisUser::where('user_id', $id)->update(['deletable' => 2]);
        return redirect('backend/mis-users')->with('successMsg', 'The user has been removed successfully!');
    }
}
