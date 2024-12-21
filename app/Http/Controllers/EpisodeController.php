<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Movie;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_movie = Movie::orderBy('id', 'DESC')->pluck('title','id');
        return view('admin.episode.form',compact('list_movie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $episode = new Episode();
        $episode->movie_id = $data['movie_id'];
        $episode->linkmovie = $data['link'];
        $episode->linkserver = $data['linkserver'];
        $episode->episode = $data['episode'];
        $episode->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $list = Episode::with('movie')->where('movie_id',$id)->get();
        return view('admin.episode.list', compact('list'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $episode = Episode::with('movie')->find($id);
        return view('admin.episode.form', compact('episode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $episode = Episode::find($id);
        $episode->linkmovie = $data['link'];
        $episode->linkserver = $data['linkserver'];
        $episode->episode = $data['episode'];
        $episode->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Episode::find($id)->delete();
        return redirect()->back();
    }
    public function select_movie(){
        $id = $_GET['id'];
        $movie = Movie::with('category', 'episode_movie')->find($id);
        $episode = Episode::where('movie_id', $id)->first(); 
        if($movie->category->title == 'Phim bộ'){
            $output = '<option>---Chọn tập phim---</option>';
            for($i= 1;$i <= $movie->episode; $i++)
                // $a = array($i);
                // if($episode){
                //     foreach($episode as $key => $episode_mov)
                        
                //         $uniqueElements = array_diff($a, $episode_mov->episode);
                //         $resultString = implode(", ", $uniqueElements);
                //         $output.= '<option value="'.$resultString.'">'.$resultString.'</option>';
                // }
                $output.= '<option value="'.$i.'">'.$i.'</option>';
           
            
        }else{
            if($episode){
                $output = '<option>Link phim đã được thêm!!!</option>';
            }else{
                $output= '<option value="'.$movie->episode.'">'.$movie->episode.'</option>';
            }       
    }
        echo $output;
    }
    


}
