@extends("vendor.admin.layouts.app")

@section("content")
    <div class="container-login100 bg-app">
        <div class="wrap-login100">
            <form method="POST" action="{{ url('/user/confirm-password') }}">
                @csrf
                <h1 class="text-center text-white">{{config('app.name')}}</h1>

                <div class="form-group">
                    <div>
                        <input id="password" type="password"
                               placeholder="Password"
                               class="form-control input100" name="password"
                               required autocomplete="current-password">

                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-block btn-dark">
                            {{ __('Confirm Password') }}
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
