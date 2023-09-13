@extends('layouts.app')
@section('content')

<a href="{{ url('trabajadores/create')}}"  class="btn btn-success">Agregar Trabajador</a>
<br><br>
<table class="table table-light table-hover">
	<thead>
		<th>#</th>
		<th>Foto</th>
		<th>Nombre completo</th>
		<th>Correo</th>
		<th>Acciones</th>
	</thead>
	<tbody>
		@foreach($trabajadores as $trabajador)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>
					@if(isset($trabajador->foto))
					<img src="{{asset($trabajador->foto)}}" class="img-thumbnail img-fluid" width="150">
					@endif
				</td>
				<td>{{ $trabajador->apellido." ".$trabajador->nombre }}</td>
				<td>{{ $trabajador->correo }}</td>
				<td>
					{{--Botón Editar--}}
					<a href="{{ url('/trabajadores/'.$trabajador->id.'/edit') }}" class="btn btn-warning">Editar</a>

					{{--Botón eliminar--}}
					<form method="post" action="{{url('/trabajadores/'.$trabajador->id)}}">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button  type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar  a {{ $trabajador->apellido." ".$trabajador->nombre }}?')">Eliminar</button>
					</form>
				</td>
			<tr>
		@endforeach
	</tbody>
	
</table>
{{ $trabajadores->links() }}
@endsection