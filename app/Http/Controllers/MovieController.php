<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie_Genre;
use Illuminate\Support\Facades\File;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Movie::with('category', 'movie_genres','country')->orderBy('id', 'DESC')->get();
        $category = Category::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        return view('admin.movie.list', compact('list','category', 'genre', 'country'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $list_genre = Genre::all();
        $country = Country::pluck('title', 'id');
        $list = Movie::with('category', 'genre', 'country')->orderBy('id', 'DESC')->get();
        return view('admin.movie.form', compact('list','category', 'genre', 'country', 'list_genre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->description = $data['description'];
        $movie->category_id = $data['category_id'];
        // insert most genre
        foreach($data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }
        
        $movie->country_id = $data['country_id'];
        $movie->status = $data['status'];
        $movie->hot = $data['hot'];
        $movie->resolution = $data['resolution'];
        $movie->subtitle = $data['subtitle'];
        $movie->year_release = $data['year_release'];
        $movie->trailer = $data['trailer'];
        $movie->slug = $data['slug'];
        $movie->episode = $data['episode'];
        $movie->time = $data['time'];
        // insert image
        $get_image = $request->file('img');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie', $new_image);
            $movie->img = $new_image;
        }
        $movie->save();
        $movie->movie_genres()->attach($data['genre']);
        return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $movie = Movie::with('movie_genres')->find($id);
    $list = Movie::all();
    $list_genre = Genre::all();
    $category = Category::pluck('title', 'id');
    $genre = Genre::pluck('title', 'id');
    $country = Country::pluck('title', 'id');
    // Lấy danh sách thể loại của phim
    $movie_genres = $movie->movie_genres->pluck('id')->toArray();
    return view('admin.movie.form', compact('list', 'movie', 'category', 'genre', 'country', 'list_genre', 'movie_genres'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        // return response()->json($data['genre']);
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->description = $data['description'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        $movie->status = $data['status'];
        $movie->hot = $data['hot'];
        $movie->resolution = $data['resolution'];
        $movie->subtitle = $data['subtitle'];
        $movie->year_release = $data['year_release'];
        $movie->trailer = $data['trailer'];
        $movie->slug = $data['slug'];
        $movie->episode = $data['episode'];
        $movie->time = $data['time'];
        // insert image
        $get_image = $request->file('img');
        if($get_image){
            if(!empty($movie->img)){
                unlink('uploads/movie/'.$movie->img);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie', $new_image);
            $movie->img = $new_image;
        }
        foreach($data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }
        $movie->save();
        $movie->movie_genres()->sync($data['genre']);
        return redirect()->back();
        
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::find($id);
        if ($movie) {
            // Kiểm tra xem hình ảnh có tồn tại không trước khi xóa
            if (!empty($movie->img) && file_exists(public_path('uploads/movie/' . $movie->img))) {
                unlink(public_path('uploads/movie/' . $movie->img));
            }
            
            // Xóa các thể loại liên quan
            Movie_Genre::where('movie_id', $movie->id)->delete();
            
            // Xóa phim
            $movie->delete();
            
            // Thông báo thành công
            return redirect()->back()->with('success', 'Movie deleted successfully');
        }
        
        // Thông báo lỗi nếu không tìm thấy phim
        return redirect()->back()->with('error', 'Movie not found');
    }
    
}
