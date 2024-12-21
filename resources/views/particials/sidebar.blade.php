<div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
 <div class="section-bar clearfix">

 <div class="section-title">
    <span>Top View</span>
    <ul class="halim-popular-tab" id="myTab" role="tablist">
        
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#ngay" role="tab" aria-controls="ngay" aria-selected="true">Ngày</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tuan" role="tab" aria-controls="tuan" aria-selected="false">Tuần</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#thang" role="tab" aria-controls="thang" aria-selected="false">Tháng</a>
        </li>
    </ul>
    </div>
</div>
    <div class="tab-content" id="myTabContent">
        <div role="tabpanel" class="tab-pane active halim-ajax-popular-post" id="ngay" aria-labelledby="home-tab">
            <div class="halim-ajax-popular-post-loading hidden"></div>
            <div id="halim-ajax-popular-post" class="popular-post">
                @foreach ($moviesWithViews as $key => $hot )
                
                
                <div class="item post-37176">
                    <a href="{{route('movie', $hot->slug)}}" title="">
                        <div class="item-link">
                        <img src="{{asset('uploads/movie/'.$hot->img)}}" class="lazy post-thumb" alt="{{$hot->title}}" title="{{$hot->title}}" />
                        <span class="is_trailer">{{$hot->resolution}}</span>
                        </div>
                        <p class="title">{{$hot->title}}</p>
                    </a>
                    <div class="viewsCount" style="color: #9d9d9d;">{{$hot->total_views}} lượt xem</div>
                    <div style="float: left;">
                        <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                        <span style="width: 0%"></span>
                        </span>
                    </div>
                </div>
                @endforeach
                
                
            </div>
        </div>
        <div class="tab-pane fade halim-ajax-popular-post" id="tuan" role="tabpanel" aria-labelledby="profile-tab">
        <div class="halim-ajax-popular-post-loading hidden"></div>
            <div id="halim-ajax-popular-post" class="popular-post">
                @foreach ($moviesWithViewsWeek as $key => $hot )
                
                
                <div class="item post-37176">
                    <a href="{{route('movie', $hot->slug)}}" title="">
                        <div class="item-link">
                        <img src="{{asset('uploads/movie/'.$hot->img)}}" class="lazy post-thumb" alt="{{$hot->title}}" title="{{$hot->title}}" />
                        <span class="is_trailer">{{$hot->resolution}}</span>
                        </div>
                        <p class="title">{{$hot->title}}</p>
                    </a>
                    <div class="viewsCount" style="color: #9d9d9d;">{{$hot->total_views}} Lượt xem</div>
                    <div style="float: left;">
                        <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                        <span style="width: 0%"></span>
                        </span>
                    </div>
                </div>
                @endforeach
                
                
            </div>
        
        </div>
    <div class="tab-pane fade halim-ajax-popular-post" id="thang" role="tabpanel" aria-labelledby="contact-tab">
        <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">
                    @foreach ($moviesWithViewsMonth as $key => $hot )
                    
                    
                    <div class="item post-37176">
                        <a href="{{route('movie', $hot->slug)}}" title="">
                            <div class="item-link">
                            <img src="{{asset('uploads/movie/'.$hot->img)}}" class="lazy post-thumb" alt="{{$hot->title}}" title="{{$hot->title}}" />
                            <span class="is_trailer">{{$hot->resolution}}</span>
                            </div>
                            <p class="title">{{$hot->title}}</p>
                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">{{$hot->total_views}} lượt xem</div>
                        <div style="float: left;">
                            <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                            <span style="width: 0%"></span>
                            </span>
                        </div>
                    </div>
                    @endforeach
                    
                    
                </div>
    </div>
    </div>
    <div class="clearfix"></div>
</div>