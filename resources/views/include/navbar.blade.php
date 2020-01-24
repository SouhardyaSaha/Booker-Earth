<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('book-posts') }}">
                {{ config('app.name', 'Booker Earth') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @guest
                    <li><a href="{{ url('book-requests') }}">Book Requests</a></li>
                    <li><a href="{{ url('book-posts') }}">Book Posts</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            Book Requests <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <li class="hvr-grow"><a href="{{ url('book-requests/create') }}"><i class="fa fa-plus fa-lg" aria-hidden="true">Add</i></a></li>
                                <li class="hvr-grow"><a href="{{ url('book-requests') }}"><i class="fa fa-list fa-lg" aria-hidden="true"> Requests</i></a></li>
                                <li class="hvr-grow"><a href="{{ url('book-requests/my-book-requests') }}">My Book requests</a></li>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            Book Posts <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <li class="hvr-grow"><a href="{{ url('book-posts/create') }}"><i class="fa fa-plus fa-lg" aria-hidden="true"> Add</i></a></li>
                                <li class="hvr-grow"><a href="{{ url('book-posts') }}"><i class="fa fa-book fa-lg" aria-hidden="true"> Books</i></a></li>
                                <li class="hvr-grow"><a href="{{ url('book-posts/my-book-posts') }}">My Book Posts</a></li>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            Messages<span class="caret"></span>
                            @if (auth()->user()->unreadMessages()->count() > 0)
                             <span class="badge">{{auth()->user()->unreadMessages()->count()}}</span>
                            @endif
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <li class="hvr-grow">
                                    <a href="{{ url('messages/send') }}">
                                        <i class="fa fa-commenting fa-lg" aria-hidden="true"> &nbsp;Message</i>
                                    </a>
                                </li>
                                <li class="hvr-grow">
                                    <a href="{{ url('messages/inbox') }}">
                                        <i class="fa fa-inbox fa-lg" aria-hidden="true"> &nbsp; Inbox</i>
                                        
                                        @if (auth()->user()->unreadMessages()->count() > 0)
                                            <span class="pull-right badge"> {{ auth()->user()->unreadMessages()->count() }} </span>
                                        @endif
                                    </a>
                                </li>
                                <li class="hvr-grow"><a href="{{ url('messages/outbox') }}"><i class="fa fa-archive fa-lg" aria-hidden="true"> &nbsp; Outbox</i></a></li>
                            </li>
                        </ul>
                    </li>
                    
                    @if (auth()->user()->isAdmin())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                User Management <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <li><a href="{{ url('users') }}"><i class="fa fa-users fa-lg" aria-hidden="true"> All Users</i></a></li>
                                    <li><a href="{{ url('bannedusers') }}"><i class="fa fa-ban fa-lg" aria-hidden="true"> Suspended</i> </a></li>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endguest
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="{{ url('home') }}"><i class="fa fa-user fa-lg" aria-hidden="true"> Profile</i></a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                             <i class="fa fa-sign-out fa-lg" aria-hidden="true"> Logout</i>                                    
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>