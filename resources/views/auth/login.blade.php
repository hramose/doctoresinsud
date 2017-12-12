@extends('login')
@section('title', 'Login')

@section('content')
    <form class="form-horizontal" method="post">

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                 {!! csrf_field() !!}

                <fieldset>
                    <h3>Login</h3>

                    <div class="form-group">
                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                        <label class="control-label visible-ie8 visible-ie9">Email</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email"  id="email" name="email"  value="{{ old('email') }}"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Contraseña</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success uppercase">Ingresar</button>
                        <label class="rememberme check">
                        <input type="checkbox" name="remember" value="1"/>Remember </label>
                     </div>

                    
                </fieldset>
            </form>
@endsection