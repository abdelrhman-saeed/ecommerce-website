<nav>

    <div class="row text-center">

        <div class="brand col-xxl-3 col-xl-1 col-md-1">
           <a href="/" class="href">
                <img src="{{asset('273584356_370175967827836_2892381250825247435_n.jpg')}}" alt="" class="" height="90" width="100">
            </a>
        </div>
        <div class="home-links col-xxl-4 col-xl-5 col-md-5">
            <ul class="col-12">
                <li>Home</li>
                <li>Products</li>
                <li>About</li>
                <li>Contact us</li>
                <li>Orders</li>
            </ul>
        </div>
        <div class="home-actions col-xxl-5 xl-6 col-md-6">
            <ul class="">
                <li>
                    <form action="/search">
                        <div>
                            <input type="text" name="search" id="" placeholder="Search products" class="">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </form>
                </li>
                <li class=""><i class="fa fa-shopping-cart"></i></li>
                @if (!auth()->check())
                    <li><button class="btn sign-btn">Sign in</button></li>
                @endif
            </ul>
        </div>

    </div>

</nav>