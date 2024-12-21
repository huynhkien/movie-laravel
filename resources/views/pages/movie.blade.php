@extends('layout')
@section('content')
<div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a href="{{route('category', $movie_slug->category->slug)}}">{{$movie_slug->category->title}}</a> » <span><a href="{{route('country', $movie_slug->country->slug)}}">{{$movie_slug->country->title}}</a> » <span class="breadcrumb_last" aria-current="page">{{$movie_slug->title}}</span></span></span></span></div>
                     </div>
                  </div>
               </div>
               <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                  <div class="ajax"></div>
               </div>
            </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
               <section id="content" class="test">
                  <div class="clearfix wrap-content">
                    
                     <div class="halim-movie-wrapper">
                        <div class="title-block">
                           <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                              <div class="halim-pulse-ring"></div>
                           </div>
                           <div class="title-wrapper" style="font-weight: bold;">
                              Bookmark
                           </div>
                        </div>
                        <div class="movie_info col-xs-12">
                           <div class="movie-poster col-md-3">
                              <img class="movie-thumb" src="{{asset('uploads/movie/'.$movie_slug->img)}}" alt="{{$movie_slug->title}}">
                              @if($movie_slug->resolution!='Trailer')
                              <div class="bwa-content">
                                 <div class="loader"></div>
                                 @if(isset($movie_episode_one))
                                    <a href="{{url('xem-phim/'.$movie_slug->slug.'/tap-'.$movie_episode_one->episode)}}" class="bwac-btn" onclick="increaseView('{{ $movie_episode_one->id }}')"><i class="fa fa-play"></i></a>
                                 @else
                                    <a href="#" class="bwac-btn" onclick="return confirm('Phim chưa được cập nhật! Vui lòng trở lại sau?')"><i class="fa fa-play"></i></a>
                                 @endif
                                 
                                
                              </div>
                              @endif
                           </div>
                           <div class="film-poster col-md-9">
                              <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{$movie_slug->title}}</h1>
                              <h2 class="movie-title title-2" style="font-size: 12px;">{{$movie_slug->title}}</h2>
                              <ul class="list-info-group">
                                 <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">{{$movie_slug->resolution}}</span><span class="episode">{{$movie_slug->subtitle}}</span></li>
                                 <!-- <li class="list-info-group-item"><span>Điểm IMDb</span> : <span class="imdb">7.2</span></li> -->
                                 <li class="list-info-group-item"><span>Thời lượng</span> : {{$movie_slug->time}}</li>
                                 @if ($movie_slug->category->title == 'Phim bộ')
                                 <li class="list-info-group-item"><span>Số tập: </span> : {{$episode_current_list_count}}/{{$movie_slug->episode}}</li>
                                 @endif
                                 <li class="list-info-group-item"><span>Thể loại</span> : 
                                    @foreach ($movie_slug->movie_genres as $gen )
                                       <a href="{{route('genre',$movie_slug->genre->slug)}}" rel="cateogry tag">{{$gen->title}}</a>
                                    
                                    @endforeach
                                 </li>
                                 <li class="list-info-group-item"><span>Quốc gia</span> : <a href="" rel="tag">{{$movie_slug->country->title}}</a></li>
                                 <li class="list-info-group-item"><span>Danh mục</span> : <a href="" rel="tag">{{$movie_slug->category->title}}</a></li>
                                 <ul class="list-inline rating"  title="Average Rating">

                                                  @for($count=1; $count<=5; $count++)

                                                    @php

                                                      if($count<=$rating){ 
                                                        $color = 'color:#ffcc00;'; //mau vang
                                                      }
                                                      else {
                                                        $color = 'color:#ccc;'; //mau xam
                                                      }
                                                    
                                                    @endphp
                                                  
                                                    <li title="star_rating" 

                                                    id="{{$movie_slug->id}}-{{$count}}" 
                                                    
                                                    data-index="{{$count}}"  
                                                    data-movie_id="{{$movie_slug->id}}" 

                                                    data-rating="{{$rating}}" 
                                                    class="rating" 
                                                    style="cursor:pointer; {{$color}} 

                                                    font-size:30px;">&#9733;</li>

                                                  @endfor

                                        </ul>
                                        <span class="total_rating">Đánh giá: {{$rating}}/{{$count_total}} lượt</span>
                           
                              </ul>
                              <div class="movie-trailer hidden"></div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div id="halim_trailer"></div>
                     <div class="clearfix"></div>
                     <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                     </div>
                     <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                           <article id="post-38424" class="item-content">
                              Phim <a>{{$movie_slug->title}}</a> - {{$movie_slug->created_at}} - {{$movie_slug->country->title}}:
                              <p>{{$movie_slug->title}} &#8211; {{$movie_slug->title}}: {{$movie_slug->description}}</p>
                           </article>
                        </div>
                     </div>
                     <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Trailer</span></h2>
                     </div>
                     <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$movie_slug->trailer}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                     </div>
                     <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
                     </div>
                     <div class="entry-content htmlwrap clearfix">
                        @php
                        $current_url = Request::url();
                        @endphp

                        <div class="comment">
                           <div class="fb-comments" data-href="{{$current_url}}" data-width="100%" data-numposts="10" data-colorscheme="dark"></div>
                        </div>
                     </div>
                     <style>
                        .comment{
                           background-color: aliceblue !important;
                        }
                     </style>

                  </div>
               </section>
               <section class="related-movies">
                  <div id="halim_related_movies-2xx" class="wrap-slider">
                     <div class="section-bar clearfix">
                        <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                     </div>
                     <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                     @foreach ($movie_related as $key => $related )
                     
                       
                     <article class="thumb grid-item post-38498">
                           <div class="halim-item">
                              <a class="halim-thumb" href="{{route('movie',$related->slug)}}" title="{{$related->title}}">
                                 <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$related->img)}}" alt="{{$related->title}}" title="{{$related->title}}"></figure>
                                 <span class="status">HD</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span> 
                                 <div class="icon_overlay"></div>
                                 <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                       <p class="entry-title">{{$related->title}}</p>
                                       <p class="original_title">{{$related->title}}</p>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        </article>
                        @endforeach 
                          
                       
                     </div>
                     <script>
                        jQuery(document).ready(function($) {				
                        var owl = $('#halim_related_movies-2');
                        owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="bx bxs-skip-previous-circle" ></i>', '<i class="bx bxs-skip-next-circle"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
                     </script>
                  </div>
               </section>
            </main>
            <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
                     @include('particials.sidebar')
            </aside>
         </div>
@endsection