@extends('layouts.app')

@section('content')

<main class="admin--page">
    <div class="header">
        <div class="left">
            <h1>Phim</h1>
        </div>
    </div>
    <div class="bottom-data">
        <div class="orders">
            <a href="{{route('movie.create')}}" class="btn btn-primary" style="margin-bottom: 30px;">
                <i class="fa fa-plus"></i> Thêm phim
            </a>
            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            <table id="example" class="table table-striped text-center" style="width:100%">
                <thead>
                    <tr>
                         <th>Hình ảnh</th>
                         <th>Tên phim</th>
                         <th>Danh mục</th>
                         <th>Thể loại</th>
                         <th>Quốc gia</th>
                         <th>Mô tả</th>
                         <th>Tập phim</th>
                         <th>Trạng thái</th>
                         <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $key => $movie)
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
                            <td class="text-center">
                                @if ($movie->status == 0)
                                    Hiển thị
                                @else
                                    Không hiển thị
                                @endif
                            </td>
                            <td class="text-center" style="height: auto; text-align: center; line-height: auto;">
                            <button type="submit" class="btn btn-xs btn-primary editBtn" data-id="{{ $movie->id }}">
                                <i alt="Edit" class="bx bx-pencil"></i>
                            </button>
                                <form method="post" action="{{ route('movie.destroy', $movie->id) }}" id="delete-form-{{ $movie->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger" name="delete" onclick="return confirm('Are you sure?')">
                                        <i alt="Delete" class="bx bx-trash"></i>
                                    </button>
                                </form>
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
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    jQuery(document).ready(function ($) {
        $('.editBtn').on('click', function (e) {
            var id = $(this).data('id');
            window.location.href = "{{ url('movie') }}/" + id + "/edit";
        });
    });
    jQuery(document).ready(function ($) {
        $('.listBtn').on('click', function (e) {
            var id = $(this).data('id');
            window.location.href = "{{ url('episode') }}/" + id + "/show";
        });
    });
    $(document).ready(function () {
    $("#example").DataTable();
  });
</script>
@endsection
