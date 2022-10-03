@extends('layouts.main')

@section('titulo', 'Proyectos')

@section('content')
    @if($query)
        <div class="alert alert-info" role="alert">
            <p>A continuacion se presentan los resultados de la busqueda <span class="fw-bold">{{$query}}</span></p>
        </div>
    @endif
    @if($mensaje = Session::get('exito'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p>{{ $mensaje }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="mt-3">
        <a href="{{ route('proyectos.create') }}" class="btn btn-secondary">
            Crear nuevo proyecto
        </a>
    </div>
    <div class="my-3">
        @if(count($proyectos)>0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyectos as $item)
                        <tr>
                            <td>{{ $item->nombre}}</td>
                            <td class="d-flex">
                                <a href="{{ route('proyectos.show', $item->id) }}" class="btn btn-info justify-content-start me-1 rounded-circle"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('proyectos.edit', $item->id) }}" class="btn btn-warning justify-content-start me-1 rounded-circle"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('proyectos.destroy', $item->id) }}" method="post" class="justify-content-start form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger rounded-circle"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$proyectos->links() }}
        @else
            <p>no hay nada que coincida con la busqueda</p>
        @endif

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script>
        $('.form-delete').submit(function(e){
            e.preventDefault();
            //Lanzar alerta de Sweetalert
            Swal.fire({
                title: '¿Esta seguro de eliminar?',
                text: "Esta acción no se podrá deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>

@endsection