<?php

namespace App\Http\Controllers;

use App\Models\Info\RoleAttr;
use App\Models\Info\TagAttr;
use App\Models\Info\UserAttr;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check() && $request->path() != 'login') {
            return redirect('/login');
        }
        if (!Auth::check() && $request->path() == 'login') {
            return view('welcome');
        }
        $user = Auth::user();
        if ($user->userType == 'user') {
            return redirect('/login');
        }
        if ($request->path() == 'login') {
            return redirect('/');
        }
        return view('welcome');
    }

    public function listTag()
    {
        return Tag::orderBy(TagAttr::ID, 'desc')->get();
    }

    public function addTag(Request $request)
    {
        $this->validate($request, [
            TagAttr::TAG_NAME => 'required'
        ]);
        return Tag::create([
            TagAttr::TAG_NAME => $request->tagName
        ]);
    }

    public function editTag(Request $request)
    {
        $this->validate($request, [
            TagAttr::ID => 'required',
            TagAttr::TAG_NAME => 'required'
        ]);
        return Tag::where(TagAttr::ID, $request->id)->update([
            TagAttr::TAG_NAME => $request->tagName
        ]);
    }

    public function deleteTag(Request $request)
    {
        return Tag::where(TagAttr::ID, $request->id)->delete();
    }

    public function listUser()
    {
        return User::orderBy(UserAttr::ID, 'desc')->get();
    }

    public function addUser(Request $request)
    {
        $this->validate($request, [
            UserAttr::FULLNAME => 'required',
            UserAttr::EMAIL => 'required | email | unique:users',
            UserAttr::PASSWORD => 'required | min:6',
            UserAttr::USER_TYPE => 'required',
        ]);
        return User::create([
            UserAttr::FULLNAME => $request->fullName,
            UserAttr::EMAIL => $request->email,
            UserAttr::PASSWORD => bcrypt($request->password),
            UserAttr::ROLE => $request->userType,
            UserAttr::USER_TYPE => 'MFP'
        ]);
    }

    public function editUser(Request $request)
    {
        $this->validate($request, [
            UserAttr::FULLNAME => 'required',
            UserAttr::EMAIL => "bail | required | email | unique:users,email,$request->id",
            UserAttr::PASSWORD => 'nullable | min:6',
            UserAttr::USER_TYPE => 'required',
        ]);

        $data = [
            UserAttr::FULLNAME => $request->fullName,
            UserAttr::EMAIL => $request->email,
            UserAttr::ROLE => $request->userType,
            UserAttr::USER_TYPE => 'MFP'
        ];

        if ($request->password){
            $data[UserAttr::PASSWORD] = bcrypt($request->password);
        }

        return User::where(UserAttr::ID, $request->id)->update($data);
    }

    public function deleteUser(Request $request)
    {
        return User::where(UserAttr::ID, $request->id)->delete();
    }

    public function listRole()
    {
        return Role::orderBy(RoleAttr::ID, 'desc')->get();
    }

    public function addRole(Request $request)
    {
        $this->validate($request, [
            RoleAttr::ROLE_NAME => 'required',
            RoleAttr::IS_ADMIN => 'required',
        ]);
        return Role::create([
           RoleAttr::ROLE_NAME => $request->roleName,
           RoleAttr::IS_ADMIN => $request->isAdmin,
        ]);
    }

    public function editRole(Request $request)
    {
        $this->validate($request, [
            RoleAttr::ROLE_NAME => 'required',
            RoleAttr::IS_ADMIN => 'required',
        ]);
        return Role::where(RoleAttr::ID, $request->id)->update([
            RoleAttr::ROLE_NAME => $request->roleName,
            RoleAttr::IS_ADMIN => $request->isAdmin,
        ]);
    }

    public function assignRole(Request $request)
    {
        $this->validate($request, [
            RoleAttr::PERMISSION => 'required',
            RoleAttr::ID => 'required',
        ]);
        return Role::where(RoleAttr::ID, $request->id)->update([
            RoleAttr::PERMISSION => $request->permission,
        ]);
    }
}
