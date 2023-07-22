<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Reply;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.section.restaurants', [
            'restaurants' => Restaurant::all()->sortBy('name')
            ]
        );
    }

    public function users(){
        return view('admin.section.users', [
                'users' => User::all()->sortBy('name')
            ]
        );
    }
    public function deleteRestaurant(Restaurant $restaurant){
            $attribute = Restaurant::firstWhere('id', $restaurant->id);
            $attribute->delete();
            return back()->with('success', 'Restoran başarıyla silindi.');
    }
    public function deleteUser(User $user){
        $attribute = User::firstWhere('email', $user->email);
        $attribute->delete();
        return back()->with('success', 'Kullanıcı başarıyla silindi. '. $user->name);
    }
    public function deleteComment(Rating $comment){
        $attribute = Rating::firstWhere('id', $comment->id);
        $attribute->delete();
        return back()->with('success', 'Değerlendirme başarıyla silindi.');
    }
    public function deleteReply(Rating $reply){
        $attribute = Reply::firstWhere('id', $reply->id);
        $attribute->delete();
        return back()->with('success', 'Yanıt başarıyla silindi.');
    }
}
