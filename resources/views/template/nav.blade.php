<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'ЗабирайДаром.BY') }}
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav navbar-right">

                <!-- Authentication Links -->
                <li><a href="/">Главная</a></li>
                <li> <a href="/category/0" >Все объявления</a></li>
                @foreach($categories_menu as $category)
                    <li>  <a href="{{route('category',['category_id'=> $category->id])}}">{{$category->name}}</a></li>
                @endforeach
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Войти</a></li>
                    <li><a href="{{ route('register') }}">Регистрация</a></li>
                @else

                    {{--@foreach($categoriesMenu as $category)--}}
                        {{--<a href="{{route('category',['category_id'=> $category->id])}}"--}}
                           {{--class="list-group-item {{ ($category_id == $category->id) ? 'active' : '' }}">{{$category->name}}</a>--}}
                    {{--@endforeach--}}
                    {{--<li><a href="{{ route('login') }}">Новости</a></li>--}}
                    <li><a style="margin-top: -7px;" href="{{route('addAdvert')}}"><button  class="btn btn-primary" style="color:white">Добавить Объявление</button></a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/dashboard') }}">Личный кабинет</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}">
                                    Выйти
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
