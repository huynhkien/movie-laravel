@extends('layouts.app')

@section('content')
<main>
            <div class="header">
                <div class="left">
                    <h1>Thể loại</h1>
                </div>
            </div>
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        @if (!isset($genre))
                            <h3>Thêm thể loại</h3>
                        @else
                            <h3>Cập nhật thể loại</h3>
                        @endif
                    </div>

                    <!-- Them san pham -->
                    <div class="container">
                        @if (!isset($genre))
                            <form method="POST" action="{{ route('genre.store') }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                        @else
                            <form method="POST" action="{{ route('genre.update', ['genre' => $genre->id]) }}" >
                            @method('PUT')
                            @csrf
                        @endif
                            <div class="form-group">
                                <label for="tile" class="form-label">Tên thể loại:</label>
                                <input type="text" value="{{ $genre->title ?? '' }}" class="form-control" id="slug" name="title" placeholder="Nhập tên thể loại" onkeyup=ChangeToSlug() required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="description" class="form-label">Mô tả:</label>
                                <textarea class="form-control" id="description" rows="3" name="description">{{ $genre->description ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="slug" class="form-label">Slug:</label>
                                <input type="text" value="{{ $genre->slug ?? '' }}" class="form-control" id="convert_slug" name="slug" placeholder="Slug" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="status" class="form-label">Trạng thái:</label>
                                <select name="status" class="form-select" aria-label="Default select example">
                                    <option value="0" {{ isset($genre) && $genre->status == 0 ? 'selected' : '' }}>Hiển thị</option>
                                    <option value="1" {{ isset($genre) && $genre->status == 1 ? 'selected' : '' }}>Không hiển thị</option>
                                </select>
                            </div>

                            @if (!isset($genre))
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
