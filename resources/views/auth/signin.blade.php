@extends('templates.default')

@section('content')
<div class="row">
    <div class="col-lg-4 mx-auto">
        <h3>Вход</h3>
        <form method="POST" action="{{ route('auth.signin') }}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Логин</label>
                <input type="text" name="username" 
                        class="form-control {{ $errors->has('username') ? 'is_invalid' : ''}}" id="username" 
                        placeholder="MrBigDick" value="{{ Request::old('username') ? : '' }}">

                @if ($errors->has('username'))
                    <span class="help-block text-danger">
                        {{ $errors->first('username') }}
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" name="password" 
                        class="form-control {{ $errors->has('password') ? 'is_invalid' : ''}}" id="password">

                @if ($errors->has('password'))
                    <span class="help-block text-danger">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>
            <div class="form-check mb-3">
                <input name="remember" type="checkbox" class="form-check-input" id="remember">
                <label for="remember" class="form-check-label">Запомнить меня</label>
            </div>
            <button type="submit" class="btn btn-primary mx-auto">Войти</button>
        </form>
    </div>
</div>
@endsection