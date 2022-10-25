@extends('layouts.main')

@section('titulo', 'Usuarios')

@section('content')
    <div class="card text-center shadow">
        <div class="card-header bold shadow">
            @if ($mensaje = Session::get('exito'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>{{ $mensaje }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($mensaje = Session::get('warning'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p>{{ $mensaje }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="my-3">
                @if (count($usuarios) > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('usuarios.edit', $item->id) }}"
                                            class="btn btn-warning justify-content-start me-1 rounded-circle"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>no hay nada que coincida con la busqueda</p>
                @endif

            </div>
        </div>
    </div>
@endsection
