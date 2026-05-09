@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Login</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button class="btn btn-primary">Entrar</button>
    </form>
</div>
@endsection