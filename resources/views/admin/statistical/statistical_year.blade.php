@extends('layouts.app')

@section('content')
<main>
  <div class="header">
    <div class="left">
        <h1>Thống kê lượt xem theo năm</h1>
    </div>
  </div>
  <div>
  <select id="statistical-select">
        <option value="date" data-url="/home/statistical/date" {{ Request::is('home/statistical/date') ? 'selected' : '' }}>Ngày</option>
        <option value="month" data-url="/home/statistical/month" {{ Request::is('home/statistical/month') ? 'selected' : '' }}>Tháng</option>
        <option value="year" data-url="/home/statistical/year" {{ Request::is('home/statistical/year') ? 'selected' : '' }}>Năm</option>
    </select>
  </div>
  <div id="myfirstchart" class="bg-light rounded mt-3" style="height: 250px;"></div>
</main>
    <script>
        $(document).ready(function() {
            // Gọi API để lấy dữ liệu JSON
            $.get('/movie-views-by-year', function(data) {
                // Chuyển đổi định dạng dữ liệu cho Morris.js
                var chartData = data.map(function(item) {
                    return { year: item.year, value: item.total_views };
                });

                // Tạo biểu đồ
                new Morris.Bar({
                    element: 'myfirstchart',
                    data: chartData,
                    xkey: 'year',
                    ykeys: ['value'],
                    labels: ['Lượt xem']
                });
            });

            document.getElementById('statistical-select').addEventListener('change', function() {
                var url = this.options[this.selectedIndex].getAttribute('data-url');
                if (url) {
                    window.location.href = url;
                }
            });
        });
    </script>

@endsection