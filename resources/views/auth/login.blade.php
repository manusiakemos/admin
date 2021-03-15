@extends("layouts.app")

@section("content")
    <div class="container-login100 bg-app">
        <div class="wrap-login100">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1 class="text-center text-white">{{config('app.name')}}</h1>

                <div class="form-group">
                    <div>
                        <input id="username" type="text"
                               placeholder="Username"
                               class="form-control input100 @error('username') is-invalid @enderror" name="username"
                               value="{{ old('username') }}" required autocomplete="username" autofocus>

                        @error('username')
                        <span class="invalid-feedback" role="alert">
                                        <strong class="text-white">{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <input id="password" type="password"
                               placeholder="Password"
                               class="form-control input100 @error('password') is-invalid @enderror" name="password"
                               required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong class="text-white">{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                <strong class="text-white">{{ __('Remember Me') }}</strong>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-block btn-dark">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
