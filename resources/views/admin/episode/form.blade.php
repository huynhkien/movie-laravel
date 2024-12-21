@extends('layouts.app')

@section('content')
<main>
            <div class="header">
                <div class="left">
                    <h1>Tập phim</h1>
                </div>
            </div>
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        @if (!isset($episode))
                            <h3>Thêm tập phim</h3>
                        @else
                            <h3>Cập nhật tập phim</h3>
                        @endif
                    </div>

                    <!-- Them san pham -->
                    <div class="container">
                        @if (!isset($episode))
                            <form method="POST" action="{{ route('episode.store') }}">
                            @method('POST')
                            @csrf
                        @else
                            <form method="POST" action="{{ route('episode.update', ['episode' => $episode->id]) }}" >
                            @method('PUT')
                            @csrf
                        @endif
                            <div class="form-group mt-2">
                                <label for="movie_id" class="form-label">Tên phim:</label>
                                @if(isset($episode))
                                <input type="text" name="movie_id" id="" value="{{$episode->movie->title}}" class="form-control">
                                @else
                                <select name="movie_id" class="form-select select-movie"  aria-label="Default select example">
                                    <option>---Chọn phim---</option>
                                    @foreach ($list_movie as $key =>$movie )
                                        <option value="{{$key}}">{{$movie}}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                            <div class="form-group mt-2">
                                <label for="episode" class="form-label">Tập phim:</label>
                                @if (isset($episode))
                                <input class="form-control" type="text" name="episode" id="" value="{{$episode->episode}}">
                                @else
                                
                                <select name="episode" class="form-select " id="show" aria-label="Default select example">
                                    
                                </select>
                                @endif
                            </div>
                            <div class="form-group mt-2">
                                <label for="link" class="form-label">Link phim:</label>
                                <input type="text" value="{{ $episode->linkmovie ?? '' }}" class="form-control" id="" name="link" placeholder="Link phim" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="linkserver" class="form-label">Server:</label>
                                <select name="linkserver" class="form-select" aria-label="Default select example">
                                    <option>---Chọn link server phim---</option>
                                    <option value="youtube"  {{ isset($episode) && $episode->linkserver == 'youtube' ? 'selected' : '' }}>Link Youtube</option>
                                    <option value="ophim"  {{ isset($episode) && $episode->linkserver == 'ophim' ? 'selected' : '' }}>Link Ophim</option>
                                </select>
                            </div>
    

                            @if (!isset($episode))
                            <button type="submit" name="submit" class="btn btn-primary mt-2">Thêm</button>
                            @else
                            <button type="submit" name="submit" class="btn btn-primary mt-2">Cập nhật</button>
                            @endif
                    </form>
                    </div>
                    <!-- End them san pham -->
                </div>
            </div>
        </main>


@endsection
