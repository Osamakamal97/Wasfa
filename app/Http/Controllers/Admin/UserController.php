<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUser;
use App\Http\Requests\Admin\UpdateUser;
use App\Traits\APITrait;
use App\User;

class UserController extends Controller
{
    use APITrait;

    public function index()
    {
        $users = User::get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(StoreUser $user)
    {
        User::create($user->all());
        return $this->returnSuccess('S000', 'User created successfully.');
    }


    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('admin.user.edit', compact('user'));
        } else {
            return redirect()->route('admin.index')->with('error', 'User not found.');
        }
    }

    public function update(UpdateUser $user)
    {
        User::find($user->id)->update($user->all());
        return $this->returnSuccess('S000', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            // Delete all related favorites for the user
            if ($user->favorites)
                $user->favorites->each(function ($value, $key) {
                    $value->delete();
                });
            // Delete all related likes for the user
            if ($user->likes)
                $user->likes->each(function ($value, $key) {
                    $value->delete();
                });
            // Delete all related comments for the user
            if ($user->comments)
                $user->comments->each(function ($value, $key) {
                    $value->delete();
                });
            // Delete user
            $user->delete();
            return $this->returnSuccess('S000', 'User delete successfully.');
        }
        return $this->returnError('S001', 'User not deleted.');
    }
}
