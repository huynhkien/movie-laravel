@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col p-3">
            <div class="row p-2">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <span class="bg-white p-2 rounded shadow-sm">
                            <i class='bx bx-movie' style="font-size: 3vw;color:cadetblue;"></i>
                            </span>
                            <span>
                                <h5 class="card-title">Movies</h5>
                                <p>{{$total_view}} Lượt xem</p>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <span class="bg-white p-2 rounded shadow-sm">
                            <i class='bx bx-star' style="font-size: 3vw;color:yellow;"></i>
                            </span>
                            <span>
                                <h5 class="card-title">Đánh giá</h5>
                                <p>{{$rating_count}} Lượt đánh giá</p>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <span class="bg-white p-2 rounded shadow-sm">
                            <i class='bx bx-film' style="font-size: 3vw;color:bisque;" ></i>
                            </span>
                            <span>
                                <h5 class="card-title" >Phim</h5>
                                <p>{{$movie_count}} phim</p>
                            </span>
                        </div>
                    </div>
                </div>
                
                </div>
            <!-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div> -->
        </div>
       
    </div>
    <div class="row justify-content-center p-3 bg-light m-3 rounded">
        <h2>Phim mới được thêm</h2>
        <table class="table table-striped text-center" style="width:100%">
                <thead>
                    <tr>
                         <th>Hình ảnh</th>
                         <th>Tên phim</th>
                         <th>Danh mục</th>
                         <th>Thể loại</th>
                         <th>Quốc gia</th>
                         <th>Mô tả</th>
                         <th>Tập phim</th>
                         
                    </tr>
                </thead>
                <tbody>
                    @forelse ($movie_new as $key => $movie)
                        <tr>
                            <td class="text-center">
                                <img height="50px" src="{{asset('uploads/movie/'.$movie->img)}}" alt="">
                            </td>
                            <td class="text-center">{{ $movie->title }}</td>
                            <td class="text-center">{{ $movie->category->title }}</td>
                            <td class="text-center">
                            @foreach ($movie->movie_genres as $gen )
                            <span class="badge bg-dark">{{ $gen->title }} </span>
                            @endforeach
                            </td>
                            <td class="text-center">{{  $movie->country->title }}</td> 
                            <td class="text-center">{{ \Illuminate\Support\Str::limit($movie->description, $limit = 100, $end = '...') }}</td>
                            <td class="text-center ">
                                <button type="submit" class="btn btn-xs btn-primary listBtn" data-id="{{ $movie->id }}" >
                                    <i class='bx bx-receipt'></i>
                                    {{$movie->episode}}
                                </button>
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Không có thể loại phim nào.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
</div>
@endsection

