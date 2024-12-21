@extends('layout')
@section('content')
<div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                  <div class="ajax"></div>
               </div>
            </div>
            <div id="halim_related_movies-2xx" class="wrap-slider">
                     <div class="section-bar clearfix">
                        <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                     </div>
                     <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                        @foreach ($hotMovie as $key => $hot )
                        
                        
                        <article class="thumb grid-item post-38498">
                           <div class="halim-item">
                              <a class="halim-thumb" href="{{route('movie', $hot->slug)}}" title="{{$hot->title}}">
                                 <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$hot->img)}}" alt="{{$hot->title}}" title="{{$hot->title}}"></figure>
                                 <span class="status">{{$hot->resolution}}</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>{{$hot->subtitle}}</span> 
                                 <div class="icon_overlay"></div>
                                 <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                       <p class="entry-title">{{$hot->title}}</p>
                                       <p class="original_title">{{$hot->title}}</p>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        </article>
                        @endforeach
                     </div>
                     <script>
                        $(document).ready(function($) {				
                        var owl = $('#halim_related_movies-2');
                        owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="bx bxs-skip-previous-circle" ></i>', '<i class="bx bxs-skip-next-circle"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
                     </script>
                  </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
               @foreach ($category_home as $cat_home )
               
               
               <section id="halim-advanced-widget-2">
                  <div class="section-heading">
                     <a href="{{route('category',$cat_home->slug)}}" title="{{$cat_home->title}}">
                     <span class="h-text">{{$cat_home->title}}</span>
                     </a>
                  </div>
                  <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                     @foreach ($cat_home->movie->take(4) as $key =>$mov )
                     
                     
                     <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                        <div class="halim-item">
                           <a class="halim-thumb" href="{{route('movie', $mov->slug)}}">
                              <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$mov->img)}}"></figure>
                              <span class="status">{{$mov->resolution}}</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>{{$mov->subtitle}}</span> 
                              <div class="icon_overlay"></div>
                              <div class="halim-post-title-box">
                                 <div class="halim-post-title ">
                                    <p class="entry-title">{{$mov->title}}</p>
                                    <p class="original_title">{{$mov->title}}</p>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </article>
                     @endforeach
                  </div>
               </section>
               @endforeach
               <div class="clearfix"></div>
            </main>
            <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
                     @include('particials.sidebar')
            </aside>
         </div>
@endsection