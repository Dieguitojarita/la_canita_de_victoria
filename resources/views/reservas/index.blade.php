@extends('layouts.main')

@section('titulo', 'Reservas')

@section('content')
@if ($query)
<div class="alert alert-info" role="alert">
    <p>A continuación se presentan los resultados de la búsqueda <span class="fw-bold">{{ $query }}</span></p>
</div>
@endif
@if ($mensaje = Session::get('exito'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <p>{{ $mensaje }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@can(['administrador'])
<div class="mt-3">
    <a href="{{ route('reservas.create') }}" class="btn btn-secondary mb-3">
        Crear nuevo proyecto
    </a>
</div>
<div class="card text-center shadow">
    <div class="card-header bold shadow">
        reservas
        @endcan
        <div class="card-body mb-4">
            <div class="my-3">
                @if (count($reservas) > 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservas as $item)
                        <tr>
                            <td>{{ $item->nombre }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('reservas.show', $item->id) }}" class="btn btn-outline-success justify-content-start me-1 rounded-circle"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('reservas.edit', $item->id) }}" class="btn btn-outline-warning justify-content-start me-1 rounded-circle"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('reservas.destroy', $item->id) }}" method="post" class="justify-content-start form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger rounded-circle">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $reservas->links() }}
                @else
                <p>La búsqueda no arrojó resultados.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script>
    // Captura del evento submit del formulario para eliminar
    $('.form-delete').submit(function(e) {
        // Para el lanzamiento del evento
        e.preventDefault();
        // Lanzar alerta de SweetAlert
        Swal.fire({
            title: '¿Está seguro de eliminar el proyecto?',
            text: "¡Esta acción no se podrá deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#dc3545',
            confirmButtonText: '¡Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });
</script>
@endsection