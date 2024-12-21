<header id="header">
         <div class="container">
            <div class="row" id="headwrap">
               <div class="col-md-3 col-sm-6 slogan">
                  <h4 >Phimmoi.net</h4>
                  
               </div>
               <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                  <div class="header-nav">
                     <div class="col-xs-12">
                        <form id="search-form-pc" name="halimForm" role="search" action="{{route('search')}}" method="GET">
                           <div class="d-flex">
                              <div class="input-group col-xs-12">
                                 <input id="search" type="search" name="key" class="form-control" placeholder="Tìm kiếm..." autocomplete="off" required>
                              </div>
                           </div>
                           
                        </form>
                        <ul class="ui-autocomplete ajax-results hidden"></ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 hidden-xs">
                  <div id="get-bookmark" class="box-shadow"><i class='bx bxs-bookmarks' ></i><span> Bookmarks</span><span class="count">0</span></div>
                  <div id="bookmark-list" class="hidden bookmark-list-on-pc">
                     <ul style="margin: 0;"></ul>
                  </div>
               </div>
            </div>
         </div>
      </header>