<nav class="navbar navbar-expand-md mx-5 py-4 d-block">
    <div class="d-flex justify-content-between">

        {{-- TITLE - name --}}
        <a class="d-flex align-items-center text-decoration-none text-white" href="{{ url('/') }}">
            <h3 class="text-uppercase">alvaro arbaiza</h3>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- NAVBAR --}}
        <div class="collapse navbar-collapse flex-grow-0 pe-2" id="navbarSupportedContent">

            <!-- lists -->
            <ul class="navbar-nav ml-auto fs-4">

                {{-- HOME --}}
                <li class="nav-item">
                    <a class="nav-link text-white-50" href="{{route('home') }}">{{ __('Home') }}</a>
                </li>

                {{-- WORK :
                        sono i projects da mostrare agli utenti anche se non sono loggati --}}
                <li class="nav-item">
                    <a class="nav-link text-white-50" href="{{route('guest.index') }}">{{ __('Work') }}</a>
                </li>

                {{-- ABOUT --}}
                <li class="nav-item">
                    <a class="nav-link text-white-50" href="{{route('about') }}">{{ __('About') }}</a>
                </li>

                <!-- DROPDOWN - Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white-50" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link text-white-50" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                @else
                    <li class="nav-item dropdown" data-bs-theme="dark">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white-50" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            {{-- dashboard --}}
                            <a class="dropdown-item" href="{{ url('admin') }}">{{__('Dashboard')}}</a>

                            {{-- profile --}}
                            <a class="dropdown-item" href="{{ url('admin/profile') }}">{{__('Profile')}}</a>

                            {{-- projects --}}
                            <a class="dropdown-item" href="{{ route('projects.index') }}">{{__('Projects')}}</a>

                            {{-- types --}}
                            <a class="dropdown-item" href="{{ route('types.index') }}">{{__('Types')}}</a>

                            {{-- logout --}}
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>