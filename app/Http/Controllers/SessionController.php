<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SessionController extends Controller
{
    public function create()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => 'required'
        ]);
        $user = User::create($attributes);
        auth()->login($user);
        return redirect('/')->with('success', 'Hesabınız başarıyla oluşturuldu. ' . $user->name);
    }

    public function destroy()
    {
        if(auth()->check()) {
            auth()->logout();
            return redirect('/')->with('success', 'Hesabınızdan çıkış yapıldı.');
        }
        return redirect('/');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', Rule::exists('users', 'email')],
            'password' => 'required'
        ]);
        $user = User::firstWhere('email', $attributes['email']);
            if($attributes['password'] == $user->password){
                session()->regenerate();//session fixation
                auth()->login($user);
                $role = auth()->user()->role;
                if($role == 1) {
                    return redirect('/index')->with('success', 'Hoşgeldiniz. ' . $user->name);
                }
                if($role == 0 || $role == 2){
                    return redirect('/')->with('success', 'Hoşgeldiniz. ' . $user->name);
                }
            }
        return back()->
        withInput()->
        withErrors(['email' => 'Bilgileriniz Doğrulanamadı.']);
    }
}
