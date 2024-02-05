<div class="col-lg-3 d-none d-lg-block">
    <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
        <h6 class="m-0">Katalog</h6>
        <i class="fa fa-angle-down text-dark"></i>
    </a>
    <nav class="collapse {{Route::currentRouteName()=='welcome'?'show':'position-absolute bg-light higher-z-index'}} navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
         id="navbar-vertical">
        <div class="navbar-nav w-100 overflow-hidden h-100" style="max-height: 410px">
            @foreach($catalogs as $catalog)
                <div class="nav-item dropdown">
                    @if(!empty($catalog->child[0]))
                        <a href="#" class="nav-link" data-toggle="dropdown">{{$catalog->name}}<i class="fa fa-angle-down float-right mt-1"></i> </a>
                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            @foreach($catalog->child as $child)
                                <a href="#" class="dropdown-item">{{$child->name}}</a>
                            @endforeach
                        </div>
                    @else
                        <a href="#" class="nav-item nav-link">{{$catalog->name}}</a>
                    @endif
                </div>
            @endforeach
        </div>
    </nav>
</div>
