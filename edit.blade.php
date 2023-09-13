@extends('layouts.app')
@section('content')
	<div class="card">
		<div class="card-body">
			<form method="post" enctype="multipart/form-data" action="{{ url('/trabajadores/'.$trabajador->id) }}">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				@include('trabajadores.form',['modo'=>'editar'])	
			</form>
			
		</div>
		
	</div>
@endsection