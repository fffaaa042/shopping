<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UsersRequest;
use App\Role;
use App\User;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }


    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create', compact('roles'));
    }


    public function store(UsersRequest $request)
    {
        $input = $request->all();

         if($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
         }
        $input['password']= bcrypt($request->password);
        User::create($input);
        return redirect('/admin/users');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.edit', compact('user', 'roles'));
    }


    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }


        if($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);

            $photo = Photo::create(['file'=> $name]);
            $input['photo_id'] = $photo->id;
        }
        $user->update($input);
        return redirect('/admin/users');

    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        unlink(public_path().$user->photo->file);
        $user->delete();
        Session::flash('deleted_user', 'The User Has Been Deleted!!');
        return redirect('/admin/users');
    }
}
