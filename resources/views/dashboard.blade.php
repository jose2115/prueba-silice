<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div style="padding-left:5%; padding-right:5%;">
    <a href="{{ route('register') }}">
        <button type="button" class="btn btn-outline-primary my-4" >Nuevo</button>
    </a>
    

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Nif</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user )
            <tr  >
                <td>{{$user->name}}</td>
                <td>{{$user->full_name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->nif}}</td>
                <td> @if ($user->roles->isNotEmpty())
                        {{ $user->roles->first()->name }}
                    @else
                        Sin Rol
                    @endif 
                </td>
                <td>
                    <a href="{{ route('editar', ['id' => $user->id]) }}">
                        <button type="button" class="btn btn-outline-primary my-4">Editar</button>
                    </a>
                    <button type="button" data-id="{{ $user->id }}" class="btn btn-outline-danger btn-eliminar">Eliminar</button>
                </td>
            </tr>
        @endforeach
        
        </tbody>
        <tfoot>
            <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Nif</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
            $(document).ready(function () {
                $('#example').DataTable();
            });

            $(document).ready(function() {

            $('.btn-eliminar').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                if (confirm('¿Estás seguro de eliminar el usuario?')) {
                    $.ajax({
                        url: '/users/' + id,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            alert(response.message);
                            location.reload();
                        },
                        error: function(xhr) {
                            alert('Error al eliminar el usuario.');
                        }
                    });
                }
            });
        });
    </script>


        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</x-app-layout>


