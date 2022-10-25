@extends('layouts.main')

@section('titulo', 'Editar ususario')

@section('content')
    <form action="{{ route('usuarios.update', $usuario->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" 
            placeholder="name" value="{{ $usuario->name }}" readonly >
            <label for="name">nombre</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="email" name="email" 
            placeholder="email" value="{{ $usuario->email }}" readonly >
            <label for="email">correo electronico</label>
        </div>
        <label for="roles" class="fw-bold mb-3">Roles</label>
        @foreach($roles as $item)
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" name="rol[]" value="{{ $item->id}}" @if($usuario->roles->pluck('id')->contains($item->id)) checked @endif>
                <label class="form-check-label">{{ $item->nombre}}</label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-secondary">Guardar</button>
    </form>
@endsection