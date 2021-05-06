@extends('templates.default')

@section('content')
<div class="row">
    <div class="col-lg-4 mx-auto">
        <h3>Регистрация</h3>
        <form method="POST" action="{{ route('auth.signup') }}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Электронная почта</label>
                <input type="email" name="email" 
                        class="form-control {{ $errors->has('email') ? 'is_invalid' : ''}}" id="email" 
                        placeholder="test@test.ru" value="{{ Request::old('email') ? : '' }}">

                @if ($errors->has('email'))
                    <span class="help-block text-danger">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" name="name" 
                        class="form-control {{ $errors->has('name') ? 'is_invalid' : ''}}" id="name" 
                        placeholder="Иван" value="{{ Request::old('name') ? : '' }}">

                @if ($errors->has('name'))
                    <span class="help-block text-danger">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
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
            <button type="submit" class="btn btn-primary mx-auto">Создать аккаунт</button>
        </form>
    </div>
</div>
@endsection