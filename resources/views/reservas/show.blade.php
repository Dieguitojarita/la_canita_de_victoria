@extends('layouts.main')

@section('titulo', 'Detalle del producto')

@section('content')

<div class="">
    <div class="card text-center shadow">
        <div class="card-header bold shadow">
            Productos
        </div>
        <table class="table table-bordered ">
            <tbody class="">
                <tr>
                    <td class="fw-bold">Nombre</td>
                    <td>{{ $producto->nombre }}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Descripcion</td>
                    <td>{{ $producto->descripcion }}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Precio</td>
                    <td>{{ $producto->precio}}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Unidades</td>
                    <td>{{ $producto->unidades }}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Imagen</td>
                    <td><img src="{{ asset('storage') . '/' . $producto->imagen }}" alt="Imagen" class="img-fluid img-miniatura"></td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>

@endsection