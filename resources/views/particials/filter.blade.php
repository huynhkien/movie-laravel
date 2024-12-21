<form method="get" action="{{route('filter')}}">
    <div class="form-row">
        <div class="form-group col-md-3">
            <select name="order" class="form-control" id="exampleFormControlSelect1">
                <option value="new">Mới cập nhật</option>
                <option value="view">Lượt xem</option>
                <option value="name">Tên phim</option>
                <option value="year">Năm sản xuất</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <select name="category" class="form-control" id="exampleFormControlSelect1">
                @foreach ($category as $key => $cat_filter )
                    <option value="{{$cat_filter->id}}">{{$cat_filter->title}}</option>    
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <select name="country" class="form-control" id="exampleFormControlSelect1">
                @foreach ($country as $key => $count_filter )
                    <option value="{{$count_filter->id}}">{{$count_filter->title}}</option>    
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <select name="genre" class="form-control" id="exampleFormControlSelect1">
                @foreach ($genre as $key => $gen_filter )
                    <option value="{{$gen_filter->id}}">{{$gen_filter->title}}</option>    
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <select name="year" class="form-control" id="exampleFormControlSelect1">
                @for ($year = 2000; $year<= date('Y'); $year++)
                    <option value="{{$year}}">{{$year}}</option>
                @endfor
            </select>
        </div>
        
    </div>
    <div class="col">
        <button type="submit" class="btn btn-primary ">Lọc phim</button>
    </div>
  
</form>