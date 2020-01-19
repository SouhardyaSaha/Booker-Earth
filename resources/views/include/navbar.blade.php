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
                                <li><a href="{{ url('book-requests/create') }}">Add</a></li>
                                <li><a href="{{ url('book-requests') }}">List</a></li>
                                <li><a href="{{ route('myBookRequests') }}">My Book Requests</a></li>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            Book Posts <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <li><a href="{{ url('book-posts/create') }}">Add</a></li>
                                <li><a href="{{ url('book-posts') }}">List</a></li>
                                <li><a href="{{ url('book-posts/my-book-posts') }}">My Book Posts</a></li>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            Messages <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <li><a href="{{ url('messages/send') }}">Send Message</a></li>
                                <li>
                                    <a href="{{ url('messages/inbox') }}">Inbox
                                        @if (auth()->user()->unreadMessages()->count() > 0)
                                            <span class="pull-right" style="font-style: oblique; color: crimson"  > {{ auth()->user()->unreadMessages()->count() }} </span>                                            
                                        @endif
                                    </a>
                                </li>
                                <li><a href="{{ url('messages/outbox') }}">Outbox</a></li>
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
                                    <li><a href="{{ url('users') }}">All Users</a></li>
                                    <li><a href="{{ url('bannedusers') }}">Suspended Users</a></li>
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
                            <li><a href="{{ url('home') }}">Profile</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
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