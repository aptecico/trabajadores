@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-body">
		<form action="{{ url('/trabajadores') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}


			@include('trabajadores.form',['modo'=>'crear'])		
		</form>
	</div>
</div>
@endsection