<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Rating;
use App\Models\View;
use Illuminate\Support\Facades\DB;


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
        $movie = Movie::all();
        $movie_new = Movie::latest('created_at')->take(8)->get();
        $movie_count = $movie->count();
        $rating_count = Rating::all()->count();
        $total_view = View::all()->sum('view');
        return view('home', compact('movie_new','movie_count','rating_count', 'total_view'));
    }
    public function date()
    {
        $movie_date = View::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(view) as total_views'))
        ->groupBy(DB::raw('DATE(created_at)'))
        ->get();
        return view('admin.statistical.statistical_date', compact('movie_date'));
    }
    public function get_date()
    {
        $movie_date = View::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(view) as total_views'))
        ->groupBy(DB::raw('DATE(created_at)'))
        ->get();
        return response()->json($movie_date);
    }
    public function month()
    {
        return view('admin.statistical.statistical_month');
    }
    public function get_month()
    {
        $movie_month = View::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(view) as total_views'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();
        
        return response()->json($movie_month);
    }
    public function year()
    {
        return view('admin.statistical.statistical_year');

    }
    public function get_year()
    {
        $movie_year = View::select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(view) as total_views'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->get();
        
        return response()->json($movie_year);
    }
}
