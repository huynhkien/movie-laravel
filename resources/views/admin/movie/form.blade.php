@extends('layouts.app')

@section('content')
<main>
            <div class="header">
                <div class="left">
                    <h1>Phim</h1>
                </div>
            </div>
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        @if (!isset($movie))
                            <h3>Thêm phim</h3>
                        @else
                            <h3>Cập nhật phim</h3>
                        @endif
                    </div>

                    <!-- Them san pham -->
                    <div class="container">
                        @if (!isset($movie))
                            <form method="POST" action="{{ route('movie.store') }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                        @else
                            <form method="POST" action="{{ route('movie.update', ['movie' => $movie->id]) }}" enctype="multipart/form-data" >
                            @method('PUT')
                            @csrf
                        @endif
                            <div class="form-group">
                                <label for="tile" class="form-label">Tên phim:</label>
                                <input type="text" value="{{ $movie->title ?? '' }}" class="form-control" id="slug" name="title" placeholder="Nhập tên thể loại" onkeyup=ChangeToSlug() required>
                            </div>
                            <div class="form-group">
                                <label for="episode" class="form-label">Số tập:</label>
                                <input type="text" value="{{ $movie->episode ?? '' }}" class="form-control" id="slug" name="episode" placeholder="Số tập phim">
                            </div>
                            <div class="form-group">
                                <label for="time" class="form-label">Thời lượng:</label>
                                <input type="text" value="{{ $movie->time ?? '' }}" class="form-control" id="slug" name="time" placeholder="Thời lượng phim">
                            </div>
                            <div class="form-group mt-2">
                                <label for="category_id" class="form-label">Danh mục phim:</label>
                                <select name="category_id" class="form-select" aria-label="Default select example">
                                    @foreach($category as $categoryId => $categoryTitle)
                                        <option value="{{$categoryId}}" {{ isset($movie) && $movie->category_id == $categoryId ? 'selected' : '' }}>{{$categoryTitle}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-2">
                            @foreach($list_genre as $genreId => $gen)
                                <input type="checkbox" class="form-check-input" name="genre[]" value="{{ $gen->id }}" {{ isset($movie_genres) && in_array($gen->id, $movie_genres) ? 'checked' : '' }}>
                                <label class="form-check-label" for="genre">{{ $gen->title }}</label>
                            @endforeach
                            </div>
                            <div class="form-group mt-2">
                                <label for="country_id" class="form-label">Quốc gia:</label>
                                <select name="country_id" class="form-select" aria-label="Default select example">
                                    @foreach($country as $countryId => $countryTitle)
                                        <option value="{{$countryId}}" {{ isset($movie) && $movie->country_id == $countryId ? 'selected' : '' }}>{{$countryTitle}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="description" class="form-label">Mô tả:</label>
                                <textarea class="form-control" id="description" rows="3" name="description">{{ $movie->description ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="trailer" class="form-label">Trailer:</label>
                                <input type="text" value="{{ $movie->trailer ?? '' }}" class="form-control" id="trailer" name="trailer" placeholder="trailer">
                            </div>
                            <div class="form-group">
                                <label for="slug" class="form-label">Slug:</label>
                                <input type="text" value="{{ $movie->slug ?? '' }}" class="form-control" id="convert_slug" name="slug" placeholder="Slug" required>
                            </div>
                            <div class="form-group">
                                <label for="year_release" class="form-label">Năm phát hành:</label>
                                <select name="year_release" class="form-select" aria-label="Default select example">
                                    @for ($year = 2000; $year<= date('Y'); $year++)
                                        <option value="{{$year}}" {{ isset($movie) && $movie->year_release == $year ? 'selected' : '' }}>{{$year}}</option>
                                    @endfor
                                    
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="status" class="form-label">Trạng thái:</label>
                                <select name="status" class="form-select" aria-label="Default select example">
                                    <option value="0" {{ isset($movie) && $movie->status == 0 ? 'selected' : '' }}>Hiển thị</option>
                                    <option value="1" {{ isset($movie) && $movie->status == 1 ? 'selected' : '' }}>Không hiển thị</option>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="resolution" class="form-label">Định dạng:</label>
                                <select name="resolution" class="form-select" aria-label="Default select example">
                                    <option value="HD" {{ isset($movie) && $movie->resolution == 'HD' ? 'selected' : '' }}>HD</option>
                                    <option value="SD" {{ isset($movie) && $movie->resolution == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="HDCam" {{ isset($movie) && $movie->resolution == 'HDCam' ? 'selected' : '' }}>HDCam</option>
                                    <option value="Cam" {{ isset($movie) && $movie->resolution == 'Cam' ? 'selected' : '' }}>Cam</option>
                                    <option value="FullHD" {{ isset($movie) && $movie->resolution == 'FullHD' ? 'selected' : '' }}>FullHD</option>
                                    <option value="4K" {{ isset($movie) && $movie->resolution == '4K' ? 'selected' : '' }}>4K</option>
                                    <option value="Trailer" {{ isset($movie) && $movie->resolution == 'Trailer' ? 'selected' : '' }}>Trailer</option>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="subtitle" class="form-label">Phụ đề:</label>
                                <select name="subtitle" class="form-select" aria-label="Default select example">
                                    <option value="Phụ đề" {{ isset($movie) && $movie->subtitle == 0 ? 'selected' : '' }}>Phụ đề</option>
                                    <option value="Thuyết minh" {{ isset($movie) && $movie->subtitle == 1 ? 'selected' : '' }}>Thuyết minh</option>
                                    
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="hot" class="form-label">Phim hot:</label>
                                <select name="hot" class="form-select" aria-label="Default select example">
                                    <option value="0" {{ isset($movie) && $movie->hot == 0 ? 'selected' : '' }}>Yes</option>
                                    <option value="1" {{ isset($movie) && $movie->hot == 1 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="image" class="form-label">Hình ảnh:</label>
                                <input type="file" value="{{ $movie->img ?? '' }}" class="form-control" id="img" name="img" placeholder="Nhập tên thể loại" onkeyup=ChangeToSlug()>
                            </div>
                            @if (isset($movie))
                            <div class="mt-2">
                                <img height="100px" src="{{asset('uploads/movie/'.$movie->img)}}" alt="">
                            </div>
                            
                            @endif

                            @if (!isset($movie))
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
