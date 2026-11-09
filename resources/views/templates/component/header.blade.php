
<div class="header">
    <div class="container">
        <div class="w3layouts_logo">
            <a href="{{ route('home') }}">
                <h1>One<span>Movies</span></h1>
            </a>
        </div>

        <div class="w3_search">
            <form action="#" method="post">
                <input type="text" name="Search" placeholder="Search" required="">
                <input type="submit" value="Go">
            </form>
        </div>

        <div class="w3l_sign_in_register">
            <ul>
                @guest
                    <li>
                        <a href="{{ route('login') }}">LOGIN / SIGN UP</a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('profile') }}">MY PROFILE</a>
                    </li>
                @endguest
            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
</div>
