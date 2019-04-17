<?php

namespace App\Http\Controllers;
use App\User;
use App\Rent;
use App\Motorhome;
use App\RVModel;
use App\Photo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $motorhomes = Motorhome::where('user_id', $user_id)->pluck('id');
        $myRent = Rent::whereIn('motorhome_id', $motorhomes)->get();
        foreach($user->motorhome as $mh)
        {
            $photo = Photo::where('motorhome_id', $mh->id)->first();
            $mh->cover_image = $photo->url;
        }



        $rent = Rent::where('user_id', $user_id)->get();
        return view('home')->with('motorhomes', $user->motorhome)->with('myRents', $myRent)->with('rents', $rent)->with('photos', $photo);
    }
}
