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

class IndexController extends Controller
{
    public function home()
        {
            
            $category = Category::orderBy('id', 'DESC')->where('status',0)->get();
            $genre = Genre::orderBy('id', 'DESC')->get();
            $country = Country::orderBy('id', 'DESC')->get();
            $hotMovie =  Movie::where('hot',0)->where('status',0)->get();
            $category_home = Category::with('movie')->orderBy('id', 'DESC')->where('status', 0)->get();
            $moviesWithViews = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereDate('views.created_at', '=', now()->toDateString())
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title',  'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 10')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsMonth = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereYear('views.created_at', '=', now()->year)
                ->whereMonth('views.created_at', '=', now()->month)
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 1000')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsWeek = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereBetween('views.created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 100')
                ->orderBy('total_views', 'desc')
                ->get();
            
            return view('pages.home', compact('moviesWithViewsWeek','moviesWithViewsMonth','moviesWithViews','category','genre', 'country', 'hotMovie', 'category_home'));
    }
    public function category($slug)
        {
            $category = Category::orderBy('id', 'DESC')->where('status',0)->get();
            $genre = Genre::orderBy('id', 'DESC')->get();
            $country = Country::orderBy('id', 'DESC')->get();
            $cat_slug = Category::where('slug', $slug)->first();
            $hotMovie =  Movie::where('hot',0)->where('status',0)->get();
            $moviesWithViews = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
            ->join('views', 'episodes.id', '=', 'views.episode_id')
            ->whereDate('views.created_at', '=', now()->toDateString())
            ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
            ->groupBy('movies.id', 'movies.title',  'movies.img','movies.slug')
            ->havingRaw('SUM(views.view) > 10')
            ->orderBy('total_views', 'desc')
            ->get();
            $moviesWithViewsMonth = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereYear('views.created_at', '=', now()->year)
                ->whereMonth('views.created_at', '=', now()->month)
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 1000')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsWeek = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereBetween('views.created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 100')
                ->orderBy('total_views', 'desc')
                ->get();
            $movie_category = Movie::where('category_id', $cat_slug->id)->where('status',0)->paginate(8);
            return view('pages.category',compact('moviesWithViewsWeek','moviesWithViewsMonth','moviesWithViews','category','genre', 'country', 'cat_slug', 'movie_category', 'hotMovie'));
    }
    public function year($year)
        {
            $category = Category::orderBy('id', 'DESC')->where('status',0)->get();
            $genre = Genre::orderBy('id', 'DESC')->get();
            $country = Country::orderBy('id', 'DESC')->get();
            $year = $year;
            $hotMovie =  Movie::where('hot',0)->where('status',0)->get();
            $moviesWithViews = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereDate('views.created_at', '=', now()->toDateString())
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title',  'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 10')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsMonth = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereYear('views.created_at', '=', now()->year)
                ->whereMonth('views.created_at', '=', now()->month)
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 1000')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsWeek = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereBetween('views.created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 100')
                ->orderBy('total_views', 'desc')
                ->get();
            $movie_year = Movie::where('year_release', $year)->paginate(8);
            return view('pages.year',compact('moviesWithViewsWeek','moviesWithViewsMonth','moviesWithViews','category','genre', 'country', 'year', 'movie_year', 'hotMovie'));
    }
    public function genre($slug)
        {
            $category = Category::orderBy('id', 'DESC')->where('status',0)->get();
            $genre = Genre::orderBy('id', 'DESC')->get();
            $country = Country::orderBy('id', 'DESC')->get();
            $genre_slug = Genre::where('slug', $slug)->first();
            $hotMovie =  Movie::where('hot',0)->where('status',0)->get();
            // show many genre
            $movie_genre = Movie_Genre::where('genre_id', $genre_slug->id)->get();
            $many_genre = [];
            foreach($movie_genre as $key => $movie){
                $many_genre[] = $movie->movie_id;
            }
            $movie_genre = Movie::whereIn('id',$many_genre)->orderBy('updated_at', 'DESC')->paginate(8);
            $moviesWithViews = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereDate('views.created_at', '=', now()->toDateString())
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title',  'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 10')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsMonth = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereYear('views.created_at', '=', now()->year)
                ->whereMonth('views.created_at', '=', now()->month)
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 1000')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsWeek = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereBetween('views.created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 100')
                ->orderBy('total_views', 'desc')
                ->get();
            return view('pages.genre',compact('moviesWithViewsWeek','moviesWithViewsMonth','moviesWithViews','category','genre', 'country','genre_slug', 'movie_genre', 'hotMovie'));
    }
    public function country($slug)
        {
            $category = Category::orderBy('id', 'DESC')->where('status',0)->get();
            $genre = Genre::orderBy('id', 'DESC')->get();
            $country = Country::orderBy('id', 'DESC')->get();
            $country_slug = Country::where('slug', $slug)->first();
            $hotMovie =  Movie::where('hot',0)->where('status',0)->get();
            $moviesWithViews = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereDate('views.created_at', '=', now()->toDateString())
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title',  'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 10')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsMonth = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereYear('views.created_at', '=', now()->year)
                ->whereMonth('views.created_at', '=', now()->month)
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 1000')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsWeek = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereBetween('views.created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 100')
                ->orderBy('total_views', 'desc')
                ->get();
            $movie_country = Movie::where('country_id', $country_slug->id)->where('status',0)->paginate(8);
            return view('pages.country',compact('moviesWithViewsWeek','moviesWithViewsMonth','moviesWithViews','category','genre', 'country','country_slug', 'movie_country','hotMovie'));
    }
    public function movie($slug)
        {
            $category = Category::orderBy('id', 'DESC')->where('status',0)->get();
            $genre = Genre::orderBy('id', 'DESC')->get();
            $country = Country::orderBy('id', 'DESC')->get();
            $hotMovie =  Movie::where('hot',0)->where('status',0)->get();
            $movie_slug = Movie::with('movie_genres', 'genre', 'category', 'country')->where('slug', $slug)->where('status',0)->first();
            $moviesWithViews = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereDate('views.created_at', '=', now()->toDateString())
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title',  'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 10')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsMonth = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereYear('views.created_at', '=', now()->year)
                ->whereMonth('views.created_at', '=', now()->month)
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 1000')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsWeek = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereBetween('views.created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 100')
                ->orderBy('total_views', 'desc')
                ->get();
            $movie_episode_one = Episode::with('movie')->where('movie_id',$movie_slug->id)->orderBy('episode', 'ASC')->take(1)->first();
            $movie_related = Movie::with('category', 'genre', 'country')
                ->where('category_id', $movie_slug->category->id)
                ->orderBy(DB::raw('RAND()')) // Sắp xếp ngẫu nhiên
                ->whereNotIn('slug',[$slug])
                ->get();
            $recent_episodes = Episode::latest('created_at')->take(3)->get();
            $episode_current_list = Episode::with('movie')->where('movie_id',$movie_slug->id)->get();
            $episode_current_list_count =  $episode_current_list->count();
            // rating
            $rating = Rating::where('movie_id', $movie_slug->id)->avg('rating');
            $rating = round($rating);
            $count_total = Rating::where('movie_id', $movie_slug->id)->count();
            return view('pages.movie', compact('moviesWithViewsWeek','moviesWithViewsMonth','moviesWithViews','count_total','rating','episode_current_list_count','movie_episode_one', 'recent_episodes','category','genre', 'country','movie_slug', 'movie_related', 'hotMovie'));
    }
    public function add_rating(Request $request){
            $data = $request->all();
            $ip_address = $request->ip();
            $rating_count = Rating::where('movie_id', $data['movie_id'])->where('ip_address',$ip_address)->count();
            if($rating_count > 0){
                echo 'exist';
            }else{
                $rating = new Rating();
                $rating->movie_id = $data['movie_id'];
                $rating->rating = $data['index'];
                $rating->ip_address = $ip_address;
                $rating->save();
                echo 'done';
            }
    }

    public function search()
        {
            if(isset($_GET['key'])){
                $search = $_GET['key'];
                $search_key = Movie::where('title', 'LIKE' ,'%'.$search.'%')->paginate(40);
                $moviesWithViews = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereDate('views.created_at', '=', now()->toDateString())
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title',  'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 10')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsMonth = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereYear('views.created_at', '=', now()->year)
                ->whereMonth('views.created_at', '=', now()->month)
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 1000')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsWeek = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereBetween('views.created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 100')
                ->orderBy('total_views', 'desc')
                ->get();
                $category = Category::orderBy('id', 'DESC')->where('status',0)->get();
                $genre = Genre::orderBy('id', 'DESC')->get();
                $country = Country::orderBy('id', 'DESC')->get();
                $hotMovie =  Movie::where('hot',0)->where('status',0)->get();
                return view('pages.search', compact('moviesWithViewsWeek','moviesWithViewsMonth','moviesWithViews','category','genre', 'country','search_key'));
            }else{
                return redirect()->to('/');
            }
    }
    public function filter(){
        $order = $_GET['order'];
        $category = $_GET['category'];
        $genre = $_GET['genre'];
        $country = $_GET['country'];
        $year =  $_GET['year'];
            // Build the query
        $query = Movie::with('episode_movie');

        if ($category) {
            $query->orWhere('category_id', $category);
        }
        if ($genre) {
            $query->orWhere('genre_id', $genre);
        }
        if ($country) {
            $query->orWhere('country_id', $country);
        }
        if ($year) {
            $query->orWhere('year_release', $year);
        }

        // Order the results
        switch ($order) {
            case 'new':
                $query->orderBy('updated_at', 'desc');
                break;
            case 'view':
                $query->join('episodes', 'movies.id', '=', 'episodes.movie_id')
                    ->orderBy('episodes.view', 'desc');
                break;
            case 'name':
                $query->orderBy('title', 'asc');
                break;
            case 'year':
                $query->orderBy('year_release', 'desc');
                break;
        }

        // Paginate the results
        $movies = $query->paginate(30);

        // Get other data
        $moviesWithViews = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereDate('views.created_at', '=', now()->toDateString())
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title',  'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 10')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsMonth = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereYear('views.created_at', '=', now()->year)
                ->whereMonth('views.created_at', '=', now()->month)
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 1000')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsWeek = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereBetween('views.created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 100')
                ->orderBy('total_views', 'desc')
                ->get();
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $hotMovie = Movie::where('hot', 0)->where('status', 0)->get();

        // Return the view with data
        return view('pages.filter_result', compact('moviesWithViewsWeek','moviesWithViewsMonth','moviesWithViews','category', 'genre', 'country', 'movies', 'hotMovie'));
    }
    public function watch($slug, $tap)
{
    $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();
    $genre = Genre::orderBy('id', 'DESC')->get();
    $country = Country::orderBy('id', 'DESC')->get();
    $hotMovie =  Movie::where('hot', 0)->where('status', 0)->get();
    $movie_slug = Movie::with('movie_genres', 'genre', 'category', 'country', 'episode_movie')->where('slug', $slug)->where('status', 0)->first();
    $moviesWithViews = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereDate('views.created_at', '=', now()->toDateString())
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title',  'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 10')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsMonth = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereYear('views.created_at', '=', now()->year)
                ->whereMonth('views.created_at', '=', now()->month)
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 1000')
                ->orderBy('total_views', 'desc')
                ->get();
            $moviesWithViewsWeek = Movie::join('episodes', 'movies.id', '=', 'episodes.movie_id')
                ->join('views', 'episodes.id', '=', 'views.episode_id')
                ->whereBetween('views.created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->select('movies.id', 'movies.title', 'movies.img','movies.slug', DB::raw('SUM(views.view) as total_views'))
                ->groupBy('movies.id', 'movies.title', 'movies.img','movies.slug')
                ->havingRaw('SUM(views.view) > 100')
                ->orderBy('total_views', 'desc')
                ->get();
    $movie_related = Movie::with('category', 'genre', 'country')
        ->where('category_id', $movie_slug->category->id)
        ->orderBy(DB::raw('RAND()')) // Sắp xếp ngẫu nhiên
        ->whereNotIn('slug', [$slug])
        ->get();

    // Lấy thông tin về lượt xem từ bảng 'view'
    $episode_view = View::whereHas('episode_id', function ($query) use ($movie_slug, $tap) {
        $query->where('movie_id', $movie_slug->id)
              ->where('episode', substr($tap, 4, 2));
    })->first();
    

    // Số lượt xem mặc định là 0 nếu không tìm thấy thông tin
    $episode_views = $episode_view ? $episode_view->view : 0;

    if (isset($tap)) {
        $episode = $tap;
        $episode = substr($tap, 4, 2);
        $movie_episode = Episode::where('movie_id', $movie_slug->id)->where('episode', $episode)->first();
    } else {
        $episode = 1;
        $movie_episode = Episode::where('movie_id', $movie_slug->id)->where('episode', $episode)->first();
    }

    return view('pages.watch', compact('moviesWithViewsWeek','moviesWithViewsMonth','moviesWithViews','episode', 'movie_episode', 'category', 'genre', 'country', 'movie_slug', 'movie_related', 'hotMovie', 'episode_views'));
}

    public function increase_view(string $id)
    {
        $episode = Episode::find($id);
        
        if ($episode) {
            // kiểm tra id của view đã tồn tại trong dữ liệu
            $view = View::where('episode_id', $episode->id)->first();
            
            if (!$view) {
                // nếu không tồn tại thì view = 1
                $view = new View();
                $view->episode_id = $episode->id;
                $view->view = 1;
            } else {
                // nếu tồn tại thì view = view + 1
                $view->view += 1;
            }
            $view->save();
            
            return response()->json(['success' => true, 'views' => $view->view]);
        } else {
            return response()->json(['success' => false, 'message' => 'Episode not found']);
        }
    }
}