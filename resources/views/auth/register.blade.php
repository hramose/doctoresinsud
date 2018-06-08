@extends('login')
@section('title', 'Register')

@section('content')
  
            <form class="form-horizontal" method="post">

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                 {!! csrf_field() !!}

                <fieldset>
                     <h3>Registrar cuenta de usuario</h3>
                    <div class="form-group">
                        
                        <h5>Nombre:</h5>
                        
                        <label for="name" class="control-label visible-ie8 visible-ie9">Nombre</label>
                             <input type="name" class="form-control form-control-solid placeholder-no-fix" id="name" placeholder="Nombre Apellido" name="name" value="{{ old('name') }}">
                     </div>
                    
                    <div class="form-group">
                        <span>Email: </span>
                        <label for="email" class="control-label visible-ie8 visible-ie9">Email</label>
                             <input type="email" class="form-control form-control-solid placeholder-no-fix" id="email" placeholder="ejemplo@mail.com" name="email" value="{{ old('email') }}">
                     </div>

                    <div class="form-group">
                        <span>Contraseña:</span>
                        <label for="password" class="control-label visible-ie8 visible-ie9">Contraseña</label>
                             <input type="password" class="form-control form-control-solid placeholder-no-fix"  name="password" placeholder="*********">
                     </div>

                    <div class="form-group">
                        <span>Repita contraseña:</span>
                        <label for="password" class="control-label visible-ie8 visible-ie9">Confirmar Contraseña</label>
                        <input type="password" class="form-control form-control-solid placeholder-no-fix"  name="password_confirmation" placeholder="*********">
                     </div>

                    <div class="form-actions">
              
                        <button type="reset" class="btn btn-default uppercase">Cancelar</button>
                        <button type="submit" class="btn btn-primary uppercase pull-right">Confirmar</button>

                     </div>
   
                </fieldset>
            </form>
       
@endsection