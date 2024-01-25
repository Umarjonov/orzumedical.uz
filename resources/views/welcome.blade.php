@extends('layouts.frontend', ['class' => 'bg-default'])

@section('content')
<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark" href="">FAQs</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Help</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Support</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark px-2" href="">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-dark pl-2" href="">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <a href="" class="col-lg-3 d-none d-lg-flex text-decoration-none">
            <svg width="60" height="60" viewBox="0 0 312.5 308.642" class="looka-1j8o68f" style="background:#202020;box-shadow:none;border-radius:50%">
                <defs>
                    <linearGradient id="a">
                        <stop stop-color="#905e26" offset="0"/>
                        <stop stop-color="#f5ec9b" offset=".5"/>
                        <stop stop-color="#905e26" offset="1"/>
                    </linearGradient>
                </defs>
                <path xmlns="http://www.w3.org/2000/svg" d="M104.6 41.3a52.2 52.2 0 0 0-3.5-11.2A51.1 51.1 0 0 0 44.3 1a49.6 49.6 0 0 0-5.7 1.5 49.1 49.1 0 0 0-7.9 2.7A51.6 51.6 0 0 0 6.3 77a53.7 53.7 0 0 0 4.1 6.4 57 57 0 0 0 5 5.7 51.7 51.7 0 0 0 55.3 11.5l3.3-1.4 3-1.5a50.9 50.9 0 0 0 5.8-3.8l2.7-2.1 1.2-1.1 1.1-.9 2-1.8.7-.6.6-.7 1.8-2a48.5 48.5 0 0 0 5.9-8.3 50.4 50.4 0 0 0 5.6-14.7 51.6 51.6 0 0 0 .2-20.4zM87.1 88.6l-1.2 1.1-1.2 1.1-2.6 2.1a49.5 49.5 0 0 1-5.7 3.6l-3 1.5-3.2 1.3-4.9 1.6h-.5a50.9 50.9 0 0 1-20.3.1 51.8 51.8 0 0 1-11.1-3.6A50.5 50.5 0 0 1 22.9 91a52 52 0 0 1-9.1-9.4 50.3 50.3 0 0 1-3.7-5.7c-.6-1-1.1-2-1.6-3.1s-1-2.1-1.3-3.2a50.6 50.6 0 0 1 8.6-50.8l.8-.8.5-.6.6-.6 1.2-1.1 2.4-2.1A50.5 50.5 0 0 1 62.4 3.2a48.5 48.5 0 0 1 14.7 5.2 47 47 0 0 1 8.3 5.8l2 1.8.7.6.6.7 1.8 2a49.7 49.7 0 0 1 11.3 22.9 50.8 50.8 0 0 1-.1 20.2 51.6 51.6 0 0 1-3.6 11 50.2 50.2 0 0 1-6.6 10.5l-2.1 2.4zm-44.9 13a50.1 50.1 0 0 1-13.7-5 51.8 51.8 0 0 1-6.2-4 55.2 55.2 0 0 1-5.5-4.8 49.9 49.9 0 0 1-11-53.2c.4-1.1.9-2.1 1.3-3.1l.6-1.3a50.2 50.2 0 0 0-3.4 11 51.3 51.3 0 0 0 2.4 28.5c.4 1.1.9 2.2 1.4 3.2s1 2.1 1.6 3.1a50.6 50.6 0 0 0 3.7 5.8 51.5 51.5 0 0 0 9.2 9.5 50.9 50.9 0 0 0 10.7 6.5 51 51 0 0 0 28.7 3.9 50.3 50.3 0 0 1-19.8-.1zm61.9-39.9a50.2 50.2 0 0 1-5.5 14.7 48.4 48.4 0 0 1-5.8 8.3l-1.8 2-.6.7-.7.6-1.9 1.7h.2l2.3-2.4 2.1-2.5A51.3 51.3 0 0 0 98.9 74a51.4 51.4 0 0 0 3.2-31.6 49.6 49.6 0 0 0-2.5-8.2 49.4 49.4 0 0 0-3.1-6.5 48.7 48.7 0 0 0-5.9-8.3l-1.8-2-.6-.7-.7-.6-2-1.8A49.9 49.9 0 0 0 77.3 8a49.3 49.3 0 0 0-6.5-3.2 49.8 49.8 0 0 0-8.2-2.6A52.2 52.2 0 0 0 49.9 1a50.8 50.8 0 0 1 22.7 3.2l3.2 1.3 3.1 1.6a50.1 50.1 0 0 1 5.7 3.7l2.6 2.1 1.2 1.1 1.2 1.1 2.3 2.3 2.1 2.4a50.4 50.4 0 0 1 6.5 10.5 51.6 51.6 0 0 1 3.6 11 51.1 51.1 0 0 1 0 20.3z" transform="translate(-.111 .085) scale(2.96256)" fill="url(#a)"/>
                <g xmlns="http://www.w3.org/2000/svg" fill="#fee822">
                    <path d="M162.427 96.8 139.12 84.038V84l-.037.02-.075-.02v.02L116 91.731v3.28l23.083-7.714 23.344 12.837z"/>
                    <path d="m162.427 100.451-23.307-11.01v-.056l-.037.056-.037-.056v.056L116 96.073v2.85l23.083-6.67 23.344 11.105z"/>
                    <path d="m162.427 104.215-23.307-9.558v-.018h-.037L116 100.414v2.478l23.083-5.738 23.344 9.52z"/>
                    <path d="m162.427 108.053-23.25-8.254v-.056l-.057.019-.037-.019v.019L116 104.736v2.18l23.12-4.993 23.307 8.253z"/>
                    <path d="m162.427 111.574-23.25-6.167v-.019l-.057.02v-.02.02L116 109.132v1.565l23.12-3.707 23.307 6.185z"/>
                    <path d="m162.427 115.281-23.214-4.601h-.093L116 113.455v1.211l23.176-2.813 23.251 4.64z"/>
                    <path d="m162.427 119.063-23.176-4.005h-.075L116 117.48v3.204h46.427zM196 106.301v-2.329l-16.284-8.998h-.111l-16.172 5.421v2.33l16.209-5.422z"/>
                    <path d="M196 108.518v-1.974l-16.284-7.77v-.018h-.074l-16.209 4.676v2.03l16.209-4.694z"/>
                    <path d="M196 110.903v-1.77l-16.284-6.651v-.074l-.037.037-.037-.037v.074l-16.209 4.006v1.714l16.246-4.006z"/>
                    <path d="M196 113.344v-1.528l-16.284-5.794h-.074l-16.209 3.502v1.49l16.246-3.502z"/>
                    <path d="M196 115.43v-1.136l-16.284-4.322h-.037l-16.246 2.608v1.136l16.283-2.645z"/>
                    <path d="M196 117.722v-.838l-16.246-3.224h-.038l-16.283 1.975v.839l16.283-1.975z"/>
                    <path d="m196 119.566-16.246-2.813v-.037h-.038l-16.283 1.733v2.235H196z"/>
                </g>
                <path d="m56 183.42 5.237-21.053-4.713-20.843h5.237l2.095 14.663h.524l2.094-14.663h5.237l-4.713 19.429 5.237 22.467h-5.237l-2.618-14.821h-.524l-2.619 14.82H56zm20.555 0v-41.896h5.237v41.896h-5.237zm9.034-37.183v-4.713H101.3v4.713h-5.237v37.183h-5.237v-37.183H85.59zm18.984 15.135c0-14.611.314-20.372 8.17-20.372s8.17 5.76 8.17 20.372c0 16.758-.315 22.571-8.17 22.571s-8.17-5.813-8.17-22.571zm5.237 0c0 15.135 0 17.334 2.933 17.334s2.933-2.2 2.933-17.334c0-13.616 0-16.182-2.933-16.182s-2.933 2.566-2.933 16.182zm14.376-19.848h5.237l3.142 16.13h.523l3.143-16.13h5.237l-6.023 23.671v18.225h-5.237v-18.225zm32.207 29.117h5.29c.104 6.756.628 8.065 2.513 8.065 2.566 0 2.566-2.147 2.566-7.855 0-8.38-10.37-6.127-10.37-17.282 0-6.546 0-12.569 7.856-12.569 5.813 0 7.384 3.3 7.751 11.207h-5.237c-.21-5.708-.838-7.017-2.514-7.017-2.566 0-2.566 2.828-2.566 8.379 0 8.117 10.422 5.237 10.422 17.282 0 7.332 0 13.092-7.908 13.092-6.075 0-7.489-3.613-7.803-13.302zm20.555 12.779v-21.996c0-14.61 0-20.371 7.855-20.371s7.856 5.76 7.856 20.371v21.996h-5.237v-12.045h-5.237v12.045h-5.237zm5.237-16.235h5.237v-5.76c0-13.617 0-16.183-2.619-16.183s-2.618 2.566-2.618 16.182v5.761zm14.794-25.661h5.5l3.141 30.898h.524l3.142-30.898h5.499l-5.76 41.896h-6.285zm22.127 41.896v-41.896h7.855c7.855 0 7.855 5.76 7.855 19.848 0 16.235 0 22.048-7.855 22.048h-7.855zm5.236-5.237h2.619c2.933 0 2.933-2.2 2.933-16.811 0-13.092 0-15.659-2.933-15.659h-2.619v32.47zm15.319-16.811c0-14.611.314-20.372 8.17-20.372S256 146.76 256 161.372c0 16.758-.314 22.571-8.17 22.571s-8.17-5.813-8.17-22.571zm5.237 0c0 15.135 0 17.334 2.932 17.334s2.933-2.2 2.933-17.334c0-13.616 0-16.182-2.933-16.182s-2.932 2.566-2.932 16.182z" fill="#f7d708"/>
                <path d="M105 224.642v-30.3h3.409l3.977 18.937h.378l3.977-18.938h3.41v30.301h-3.788v-15.15l-2.69 15.15h-2.272l-2.614-15.15v15.15H105zm20.358 0v-15.908c0-10.567 0-14.734 5.682-14.734s5.68 4.167 5.68 14.734v15.908h-3.787v-8.711h-3.787v8.711h-3.788zm3.788-11.742h3.787v-4.166c0-9.848 0-11.704-1.893-11.704s-1.894 1.856-1.894 11.704v4.166zm12.783 11.742v-30.3h6.136c3.901 0 5.227 2.385 5.227 6.968 0 4.129-.493 6.477-1.667 7.613v.228c.985.34 1.288 2.12 1.667 6.552l.757 8.939h-3.787l-.493-8.939c-.265-4.507-.947-5.454-2.083-5.454h-1.97v14.393h-3.787zm3.787-17.423h2.349c1.325 0 1.704-1.326 1.704-5.909 0-2.992-.568-3.939-1.704-3.939h-2.349v9.848zm12.784 17.423v-30.3h3.787v12.006l3.788-12.007h3.787l-4.545 14.393 4.545 15.908h-3.787l-3.788-13.257v13.257H158.5zm15.055 0v-15.908c0-10.567 0-14.734 5.682-14.734s5.681 4.167 5.681 14.734v15.908h-3.787v-8.711h-3.788v8.711h-3.788zm3.788-11.742h3.788v-4.166c0-9.848 0-11.704-1.894-11.704s-1.894 1.856-1.894 11.704v4.166zm11.268 11.742 6.818-27.27h-6.06v-3.03h10.605l-6.628 26.512h5.87v3.788h-10.605zm15.056 0v-30.3h3.787v30.3h-3.787z" fill="#f0d239"/>
            </svg>
            <div class="d-flex flex-column justify-content-center ml-2 text-primary font-weight-semi-bold">
                <span class="text-center">XITOY</span>
                <span class="text-center">SAVDO MARKAZI</span>
            </div>
        </a>
        <div class="col-lg-6 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products">
                    <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge">0</span>
            </a>
            <a href="" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">0</span>
            </a>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown">Dresses <i class="fa fa-angle-down float-right mt-1"></i></a>
                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            <a href="" class="dropdown-item">Men's Dresses</a>
                            <a href="" class="dropdown-item">Women's Dresses</a>
                            <a href="" class="dropdown-item">Baby's Dresses</a>
                        </div>
                    </div>
                    <a href="" class="nav-item nav-link">Shirts</a>
                    <a href="" class="nav-item nav-link">Jeans</a>
                    <a href="" class="nav-item nav-link">Swimwear</a>
                    <a href="" class="nav-item nav-link">Sleepwear</a>
                    <a href="" class="nav-item nav-link">Sportswear</a>
                    <a href="" class="nav-item nav-link">Jumpsuits</a>
                    <a href="" class="nav-item nav-link">Blazers</a>
                    <a href="" class="nav-item nav-link">Jackets</a>
                    <a href="" class="nav-item nav-link">Shoes</a>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
{{--                <a href="" class="text-decoration-none d-block d-lg-none">--}}
{{--                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>--}}
{{--                </a>--}}
                <a href="" class="d-lg-none d-flex text-decoration-none">
                    <svg width="60" height="60" viewBox="0 0 312.5 308.642" class="looka-1j8o68f" style="background:#202020;box-shadow:none;border-radius:50%">
                        <defs>
                            <linearGradient id="a">
                                <stop stop-color="#905e26" offset="0"/>
                                <stop stop-color="#f5ec9b" offset=".5"/>
                                <stop stop-color="#905e26" offset="1"/>
                            </linearGradient>
                        </defs>
                        <path xmlns="http://www.w3.org/2000/svg" d="M104.6 41.3a52.2 52.2 0 0 0-3.5-11.2A51.1 51.1 0 0 0 44.3 1a49.6 49.6 0 0 0-5.7 1.5 49.1 49.1 0 0 0-7.9 2.7A51.6 51.6 0 0 0 6.3 77a53.7 53.7 0 0 0 4.1 6.4 57 57 0 0 0 5 5.7 51.7 51.7 0 0 0 55.3 11.5l3.3-1.4 3-1.5a50.9 50.9 0 0 0 5.8-3.8l2.7-2.1 1.2-1.1 1.1-.9 2-1.8.7-.6.6-.7 1.8-2a48.5 48.5 0 0 0 5.9-8.3 50.4 50.4 0 0 0 5.6-14.7 51.6 51.6 0 0 0 .2-20.4zM87.1 88.6l-1.2 1.1-1.2 1.1-2.6 2.1a49.5 49.5 0 0 1-5.7 3.6l-3 1.5-3.2 1.3-4.9 1.6h-.5a50.9 50.9 0 0 1-20.3.1 51.8 51.8 0 0 1-11.1-3.6A50.5 50.5 0 0 1 22.9 91a52 52 0 0 1-9.1-9.4 50.3 50.3 0 0 1-3.7-5.7c-.6-1-1.1-2-1.6-3.1s-1-2.1-1.3-3.2a50.6 50.6 0 0 1 8.6-50.8l.8-.8.5-.6.6-.6 1.2-1.1 2.4-2.1A50.5 50.5 0 0 1 62.4 3.2a48.5 48.5 0 0 1 14.7 5.2 47 47 0 0 1 8.3 5.8l2 1.8.7.6.6.7 1.8 2a49.7 49.7 0 0 1 11.3 22.9 50.8 50.8 0 0 1-.1 20.2 51.6 51.6 0 0 1-3.6 11 50.2 50.2 0 0 1-6.6 10.5l-2.1 2.4zm-44.9 13a50.1 50.1 0 0 1-13.7-5 51.8 51.8 0 0 1-6.2-4 55.2 55.2 0 0 1-5.5-4.8 49.9 49.9 0 0 1-11-53.2c.4-1.1.9-2.1 1.3-3.1l.6-1.3a50.2 50.2 0 0 0-3.4 11 51.3 51.3 0 0 0 2.4 28.5c.4 1.1.9 2.2 1.4 3.2s1 2.1 1.6 3.1a50.6 50.6 0 0 0 3.7 5.8 51.5 51.5 0 0 0 9.2 9.5 50.9 50.9 0 0 0 10.7 6.5 51 51 0 0 0 28.7 3.9 50.3 50.3 0 0 1-19.8-.1zm61.9-39.9a50.2 50.2 0 0 1-5.5 14.7 48.4 48.4 0 0 1-5.8 8.3l-1.8 2-.6.7-.7.6-1.9 1.7h.2l2.3-2.4 2.1-2.5A51.3 51.3 0 0 0 98.9 74a51.4 51.4 0 0 0 3.2-31.6 49.6 49.6 0 0 0-2.5-8.2 49.4 49.4 0 0 0-3.1-6.5 48.7 48.7 0 0 0-5.9-8.3l-1.8-2-.6-.7-.7-.6-2-1.8A49.9 49.9 0 0 0 77.3 8a49.3 49.3 0 0 0-6.5-3.2 49.8 49.8 0 0 0-8.2-2.6A52.2 52.2 0 0 0 49.9 1a50.8 50.8 0 0 1 22.7 3.2l3.2 1.3 3.1 1.6a50.1 50.1 0 0 1 5.7 3.7l2.6 2.1 1.2 1.1 1.2 1.1 2.3 2.3 2.1 2.4a50.4 50.4 0 0 1 6.5 10.5 51.6 51.6 0 0 1 3.6 11 51.1 51.1 0 0 1 0 20.3z" transform="translate(-.111 .085) scale(2.96256)" fill="url(#a)"/>
                        <g xmlns="http://www.w3.org/2000/svg" fill="#fee822">
                            <path d="M162.427 96.8 139.12 84.038V84l-.037.02-.075-.02v.02L116 91.731v3.28l23.083-7.714 23.344 12.837z"/>
                            <path d="m162.427 100.451-23.307-11.01v-.056l-.037.056-.037-.056v.056L116 96.073v2.85l23.083-6.67 23.344 11.105z"/>
                            <path d="m162.427 104.215-23.307-9.558v-.018h-.037L116 100.414v2.478l23.083-5.738 23.344 9.52z"/>
                            <path d="m162.427 108.053-23.25-8.254v-.056l-.057.019-.037-.019v.019L116 104.736v2.18l23.12-4.993 23.307 8.253z"/>
                            <path d="m162.427 111.574-23.25-6.167v-.019l-.057.02v-.02.02L116 109.132v1.565l23.12-3.707 23.307 6.185z"/>
                            <path d="m162.427 115.281-23.214-4.601h-.093L116 113.455v1.211l23.176-2.813 23.251 4.64z"/>
                            <path d="m162.427 119.063-23.176-4.005h-.075L116 117.48v3.204h46.427zM196 106.301v-2.329l-16.284-8.998h-.111l-16.172 5.421v2.33l16.209-5.422z"/>
                            <path d="M196 108.518v-1.974l-16.284-7.77v-.018h-.074l-16.209 4.676v2.03l16.209-4.694z"/>
                            <path d="M196 110.903v-1.77l-16.284-6.651v-.074l-.037.037-.037-.037v.074l-16.209 4.006v1.714l16.246-4.006z"/>
                            <path d="M196 113.344v-1.528l-16.284-5.794h-.074l-16.209 3.502v1.49l16.246-3.502z"/>
                            <path d="M196 115.43v-1.136l-16.284-4.322h-.037l-16.246 2.608v1.136l16.283-2.645z"/>
                            <path d="M196 117.722v-.838l-16.246-3.224h-.038l-16.283 1.975v.839l16.283-1.975z"/>
                            <path d="m196 119.566-16.246-2.813v-.037h-.038l-16.283 1.733v2.235H196z"/>
                        </g>
                        <path d="m56 183.42 5.237-21.053-4.713-20.843h5.237l2.095 14.663h.524l2.094-14.663h5.237l-4.713 19.429 5.237 22.467h-5.237l-2.618-14.821h-.524l-2.619 14.82H56zm20.555 0v-41.896h5.237v41.896h-5.237zm9.034-37.183v-4.713H101.3v4.713h-5.237v37.183h-5.237v-37.183H85.59zm18.984 15.135c0-14.611.314-20.372 8.17-20.372s8.17 5.76 8.17 20.372c0 16.758-.315 22.571-8.17 22.571s-8.17-5.813-8.17-22.571zm5.237 0c0 15.135 0 17.334 2.933 17.334s2.933-2.2 2.933-17.334c0-13.616 0-16.182-2.933-16.182s-2.933 2.566-2.933 16.182zm14.376-19.848h5.237l3.142 16.13h.523l3.143-16.13h5.237l-6.023 23.671v18.225h-5.237v-18.225zm32.207 29.117h5.29c.104 6.756.628 8.065 2.513 8.065 2.566 0 2.566-2.147 2.566-7.855 0-8.38-10.37-6.127-10.37-17.282 0-6.546 0-12.569 7.856-12.569 5.813 0 7.384 3.3 7.751 11.207h-5.237c-.21-5.708-.838-7.017-2.514-7.017-2.566 0-2.566 2.828-2.566 8.379 0 8.117 10.422 5.237 10.422 17.282 0 7.332 0 13.092-7.908 13.092-6.075 0-7.489-3.613-7.803-13.302zm20.555 12.779v-21.996c0-14.61 0-20.371 7.855-20.371s7.856 5.76 7.856 20.371v21.996h-5.237v-12.045h-5.237v12.045h-5.237zm5.237-16.235h5.237v-5.76c0-13.617 0-16.183-2.619-16.183s-2.618 2.566-2.618 16.182v5.761zm14.794-25.661h5.5l3.141 30.898h.524l3.142-30.898h5.499l-5.76 41.896h-6.285zm22.127 41.896v-41.896h7.855c7.855 0 7.855 5.76 7.855 19.848 0 16.235 0 22.048-7.855 22.048h-7.855zm5.236-5.237h2.619c2.933 0 2.933-2.2 2.933-16.811 0-13.092 0-15.659-2.933-15.659h-2.619v32.47zm15.319-16.811c0-14.611.314-20.372 8.17-20.372S256 146.76 256 161.372c0 16.758-.314 22.571-8.17 22.571s-8.17-5.813-8.17-22.571zm5.237 0c0 15.135 0 17.334 2.932 17.334s2.933-2.2 2.933-17.334c0-13.616 0-16.182-2.933-16.182s-2.932 2.566-2.932 16.182z" fill="#f7d708"/>
                        <path d="M105 224.642v-30.3h3.409l3.977 18.937h.378l3.977-18.938h3.41v30.301h-3.788v-15.15l-2.69 15.15h-2.272l-2.614-15.15v15.15H105zm20.358 0v-15.908c0-10.567 0-14.734 5.682-14.734s5.68 4.167 5.68 14.734v15.908h-3.787v-8.711h-3.787v8.711h-3.788zm3.788-11.742h3.787v-4.166c0-9.848 0-11.704-1.893-11.704s-1.894 1.856-1.894 11.704v4.166zm12.783 11.742v-30.3h6.136c3.901 0 5.227 2.385 5.227 6.968 0 4.129-.493 6.477-1.667 7.613v.228c.985.34 1.288 2.12 1.667 6.552l.757 8.939h-3.787l-.493-8.939c-.265-4.507-.947-5.454-2.083-5.454h-1.97v14.393h-3.787zm3.787-17.423h2.349c1.325 0 1.704-1.326 1.704-5.909 0-2.992-.568-3.939-1.704-3.939h-2.349v9.848zm12.784 17.423v-30.3h3.787v12.006l3.788-12.007h3.787l-4.545 14.393 4.545 15.908h-3.787l-3.788-13.257v13.257H158.5zm15.055 0v-15.908c0-10.567 0-14.734 5.682-14.734s5.681 4.167 5.681 14.734v15.908h-3.787v-8.711h-3.788v8.711h-3.788zm3.788-11.742h3.788v-4.166c0-9.848 0-11.704-1.894-11.704s-1.894 1.856-1.894 11.704v4.166zm11.268 11.742 6.818-27.27h-6.06v-3.03h10.605l-6.628 26.512h5.87v3.788h-10.605zm15.056 0v-30.3h3.787v30.3h-3.787z" fill="#f0d239"/>
                    </svg>
                    <div class="d-flex flex-column justify-content-center ml-2 text-primary font-weight-semi-bold">
                        <span class="text-center">XITOY</span>
                        <span class="text-center">SAVDO MARKAZI</span>
                    </div>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="shop.html" class="nav-item nav-link">Shop</a>
                        <a href="detail.html" class="nav-item nav-link">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                <a href="checkout.html" class="dropdown-item">Checkout</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        <a href="" class="nav-item nav-link">Login</a>
                        <a href="" class="nav-item nav-link">Register</a>
                    </div>
                </div>
            </nav>
            <div id="header-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="height: 410px;">
                        <img class="img-fluid" src="img/carousel-1.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                                <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="height: 410px;">
                        <img class="img-fluid" src="img/carousel-2.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                                <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Navbar End -->


<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="img/cat-1.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Men's dresses</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="img/cat-2.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Women's dresses</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="img/cat-3.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Baby's dresses</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="img/cat-4.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Accerssories</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="img/cat-5.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Bags</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="img/cat-6.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Shoes</h5>
            </div>
        </div>
    </div>
</div>
<!-- Categories End -->


<!-- Offer Start -->
<div class="container-fluid offer pt-5">
    <div class="row px-xl-5">
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                <img src="img/offer-1.png" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Spring Collection</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                <img src="img/offer-2.png" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Winter Collection</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->


<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-1.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-2.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-3.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-4.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-5.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-6.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-7.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-8.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Products End -->


<!-- Subscribe Start -->
<div class="container-fluid bg-secondary my-5">
    <div class="row justify-content-md-center py-5 px-xl-5">
        <div class="col-md-6 col-12 py-5">
            <div class="text-center mb-2 pb-2">
                <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod duo labore labore.</p>
            </div>
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                    <div class="input-group-append">
                        <button class="btn btn-primary px-4">Subscribe</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Subscribe End -->


<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Just Arrived</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-1.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-2.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-3.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-4.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-5.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-6.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-7.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="img/product-8.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Products End -->


<!-- Vendor Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="vendor-item border p-4">
                    <img src="img/vendor-1.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/vendor-2.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/vendor-3.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/vendor-4.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/vendor-5.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/vendor-6.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/vendor-7.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/vendor-8.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->


<!-- Footer Start -->
<div class="container-fluid bg-secondary text-dark mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <a href="" class="text-decoration-none">
                <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopper</h1>
            </a>
            <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                        <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                        <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                        <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                        <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                        <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                        <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                        <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                        <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                        <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                        <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                    <form action="">
                        <div class="form-group">
                            <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                   required="required" />
                        </div>
                        <div>
                            <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top border-light mx-xl-5 py-4">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-dark">
                &copy; <a class="text-dark font-weight-semi-bold" href="#">Your Site Name</a>. All Rights Reserved. Designed
                by
                <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
                Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="img/payments.png" alt="">
        </div>
    </div>
</div>
<!-- Footer End -->


@endsection
