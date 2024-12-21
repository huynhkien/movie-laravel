<div class="navbar-container">
         <div class="container">
            <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#halim" aria-expanded="false">
                  <span class="sr-only">Menu</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right expand-search-form" data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                  <span class="hl-search" aria-hidden="true"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                  Bookmarks<i class="hl-bookmark" aria-hidden="true"></i>
                  <span class="count">0</span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right get-locphim-on-mobile">
                  <a href="javascript:;" id="expand-ajax-filter" style="color: #ffed4d;">Lọc <i class="fas fa-filter"></i></a>
                  </button>
               </div>
               <div class="collapse navbar-collapse" id="halim">
                  <div class="menu-menu_1-container">
                     <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                        <li class="current-menu-item active"><a title="Trang Chủ" href="{{route('homepage')}}">Trang Chủ</a></li>
                        @foreach ($category as $key =>$cat )
                        <li class="mega"><a title="{{$cat->title}}" href="{{route('category', $cat->slug)}}">{{$cat->title}}</a></li>
                        @endforeach
                        <li class="mega dropdown">
                           <a title="Năm phát hành" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Năm phát hành <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                           @for ($year = 2000; $year<= date('Y'); $year++)
                            <li><a title="{{$year}}" href="{{route('years', $year)}}">{{$year}}</a></li>
                            @endfor
                              
                              
                           </ul>
                        </li>
                        <li class="mega dropdown">
                           <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Thể Loại <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                            @foreach ($genre as $key => $gen )
                            <li><a title="{{$gen->title}}" href="{{route('genre', $gen->slug)}}">{{$gen->title}}</a></li>
                            @endforeach
                              
                              
                           </ul>
                        </li>
                        <li class="mega dropdown">
                           <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                           @foreach ($country as $key => $gen )
                                <li><a title="{{$gen->title}}" href="{{route('country', $gen->slug)}}">{{$gen->title}}</a></li>
                            @endforeach
                              
                           </ul>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav>
            <div class="collapse navbar-collapse" id="search-form">
               <div id="mobile-search-form" class="halim-search-form"></div>
            </div>
            <div class="collapse navbar-collapse" id="user-info">
               <div id="mobile-user-login"></div>
            </div>
         </div>
      </div>
      </div>