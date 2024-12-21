@extends('layouts.app')

@section('content')
<main class="admin--page">
    <div class="header">
        <div class="left">
            <h1>Danh Mục</h1>
        </div>
    </div>
    <div class="bottom-data">
        <div class="orders">
            <a href="{{ route('category.create') }}" class="btn btn-primary" style="margin-bottom: 30px;">
                <i class="fa fa-plus"></i> Thêm danh mục
            </a>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <table id="example" class="table table-striped text-center" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên danh mục</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $key => $cat)
                        <tr>
                            <td class="text-center py-4">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $cat->title }}</td>
                            <td class="text-center">{{ $cat->description }}</td>
                            <td class="text-center">
                                @if ($cat->status == 0)
                                    Hiển thị
                                @else
                                    Không hiển thị
                                @endif
                            </td>
                            <td class="d-flex justify-content-center">
                                <button type="button" class="btn btn-xs btn-primary editBtn" data-id="{{ $cat->id }}">
                                    <i alt="Edit" class="bx bx-pencil"></i>
                                </button>
                                <form method="post" action="{{ route('category.destroy', $cat->id) }}" id="delete-form-{{ $cat->id }}">
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
                            <td colspan="5" class="text-center">Không có danh mục nào.</td>
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
            window.location.href = "{{ url('category') }}/" + id + "/edit";
        });
    });
    $(document).ready(function () {
    $("#example").DataTable();
  });
</script>
@endsection
