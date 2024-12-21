@extends('layouts.app')

@section('content')
<main>
            <div class="header">
                <div class="left">
                    <h1>Danh mục</h1>
                </div>
            </div>
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        @if (!isset($category))
                            <h3>Thêm danh mục</h3>
                        @else
                            <h3>Cập nhật danh mục</h3>
                        @endif
                    </div>

                    <!-- Them san pham -->
                    <div class="container">
                        @if (!isset($category))
                            <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                        @else
                            <form method="POST" action="{{ route('category.update', ['category' => $category->id]) }}" >
                            @method('PUT')
                            @csrf
                        @endif
                            <div class="form-group">
                                <label for="tile" class="form-label">Tên danh mục:</label>
                                <input type="text" value="{{ $category->title ?? '' }}" class="form-control" id="slug" name="title" placeholder="Nhập tên danh mục" onkeyup=ChangeToSlug() required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="description" class="form-label">Mô tả:</label>
                                <textarea class="form-control" id="description" rows="3" name="description">{{ $category->description ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="slug" class="form-label">Slug:</label>
                                <input type="text" value="{{ $category->slug ?? '' }}" class="form-control" id="convert_slug" name="slug" placeholder="Slug" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="status" class="form-label">Trạng thái:</label>
                                <select name="status" class="form-select" aria-label="Default select example">
                                    <option value="0" {{ isset($category) && $category->status == 0 ? 'selected' : '' }}>Hiển thị</option>
                                    <option value="1" {{ isset($category) && $category->status == 1 ? 'selected' : '' }}>Không hiển thị</option>
                                </select>
                            </div>

                            @if (!isset($category))
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
