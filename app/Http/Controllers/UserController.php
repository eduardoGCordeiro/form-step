<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $items = User::orderBy('created_at', 'desc')->get();
        return view('user.home', compact('items'));
    }

    public function form(User $user)
    {
        $address = $user->address->last();
        $phone_mobile = $user->phoneMobile->last();
        $phone = $user->phone->last();
        return view('user.form', compact(['user', 'address', 'phone_mobile', 'phone']));
    }

    public function destroy(User $user)
    {
        if (!$user->exists) {
            return abort(404);
        }

        $user->delete();
        return redirect()->route('user.home');
    }
}
