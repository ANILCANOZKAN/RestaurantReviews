<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Reply;
use App\Models\Rating;
use App\Models\Restaurant;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RestaurantController extends Controller
{

    public function index(){

        $restaurant = Restaurant::latest()->filter(request(['search', 'category']))->paginate(20)->withQueryString();
        return view('welcome',[
            'restaurants' => $restaurant,
            'categories' => Category::all(),
            'currentCategory' => Category::firstWhere('slug', request('category'))
        ]);

    }

    public function createReply(Rating $rating)
    {
        if(auth()->user()?->role >= 1) {
            $restaurant_id = $rating->restaurant_id;
            $restaurant = Restaurant::firstWhere('id', $restaurant_id);
            if ($restaurant->user_id == auth()->id()) {
                if (Reply::firstWhere('rating_id', $rating->id) == null) {
                    $attributes = request()->validate([
                        'comment' => 'required'
                    ]);
                    $attributes['user_id'] = auth()->id();
                    $attributes['rating_id'] = $rating->id;
                    Reply::create($attributes);
                    return back()->with('success', 'Yanıtınız başarıyla kaydedildi.');
                } else {
                    $attributes = request()->validate([
                        'comment' => 'required'
                    ]);
                    $attributes['user_id'] = auth()->id();
                    $attributes['rating_id'] = $rating->id;
                    Reply::where('rating_id', $rating->id)->update($attributes);
                    return back()->with('success', 'Yanıtınız başarıyla düzenlendi.');
                }
            }else{
                return back()->with('success', 'Yanıt verebilmek için restorana sahip olmanız gerekmektedir.');
            }
            }
        abort(419);
    }

    public function rating(Restaurant $restaurant)
    {
        if (auth()->check()) {
            $rate = Rating::all();
            $bool = false;
            foreach ($rate as $rate) {
                if ($rate->user_id == auth()->id() && $rate->restaurant_id == $restaurant->id) {
                    $bool = true;
                    $rate_id = $rate->id;
                    break;
                }
            }
                if ($bool) {
                    $attributes = request()->validate([
                        'restaurant_id' => ['required', Rule::exists('restaurants', 'id')],
                        'rating' => 'required'
                    ]);
                    $attributes['user_id'] = auth()->id();
                    Rating::where('id', $rate_id)->update($attributes);
                    $rating = $attributes['rating'];
                    $num = 1;
                    $restaurants = Rating::all()->where('restaurant_id', $restaurant->id);
                    foreach ($restaurants as $restaurant_rate) {
                        $rating = $restaurant_rate->rating + $rating;
                        $num++;
                    }
                    $overall_like['overall_like'] = $rating/$num;
                    Restaurant::where('id', $restaurant->id)->update($overall_like);
                    return back()->with('success', 'Değerlendirmeniz başarıyla güncellendi.');
                } else {
                    $attributes = request()->validate([
                        'restaurant_id' => ['required', Rule::exists('restaurants', 'id')],
                        'rating' => 'required',
                        'comment' => 'required'
                    ]);
                    $attributes['user_id'] = auth()->id();
                    Rating::create($attributes);
                    $rating = 0;
                    $num = 0;
                    $restaurants = Rating::all()->where('restaurant_id', $restaurant->id);
                    foreach ($restaurants as $restaurant_rate) {
                        $rating = $restaurant_rate->rating + $rating;
                        $num++;
                    }
                    $overall_like['overall_like'] = $rating/$num;
                    Restaurant::where('id', $restaurant->id)->update($overall_like);
                    return back()->with('success', 'Değerlendirmeniz başarıyla yapıldı.');
                }
            }
            abort(404);
        }

        public function createRestaurant(){
                if(auth()->user()->role > 0){
                    $attributes = request()->validate([
                        'name' => 'required',
                        'descriptions' => 'required',
                        'slug' => ['required', Rule::unique('restaurants', 'slug')]
                    ]);
                    $attributes['user_id'] = auth()->id();
                    $attributes['category_id'] = random_int(1, 10);
                    Restaurant::create($attributes);
                    return back()->with('success', 'Restoran başarıyla oluşturuldu.');
                }
                abort(404);
        }
}
