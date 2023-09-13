<h4>{{$modo=='crear'?'Agregar Trabajador':'Modificar Trabajdor'}}</h4>
<div class="form-group">
	<label for="nombre">{{ 'Nombre' }}</label>
	<input type="text" name="nombre" id="nombre" class="form-control {{ $errors->has('nombre')?'is-invalid':''}}" value="{{ isset($trabajador->nombre)?$trabajador->nombre:old('nombre') }}">
	{!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}
</div>
<div class="form-group">
	<label for="apellido">{{'Apellido'}}</label>
	<input type="text" name="apellido" id="apellido" class="form-control {{ $errors->has('apellido')?'is-invalid':''}}" value="{{ isset($trabajador->apellido)?$trabajador->apellido:old('apellido') }}">
	{!! $errors->first('apellido','<div class="invalid-feedback">:message</div>')!!}
</div>
<div class="form-group">
	<label for="correo">{{'Correo'}}</label>
	<input type="email" name="correo" id="correo" class="form-control {{ $errors->has('correo')?'is-invalid':''}}" value="{{ isset($trabajador->correo)?$trabajador->correo:old('correo') }}">
	{!! $errors->first('correo','<div class="invalid-feedback">:message</div>')!!}
</div>

<div class="form-group">
	<label for="foto">{{'Foto'}}</label>
	@if(isset($trabajador->foto))
		<img src="{{asset($trabajador->foto)}}" class="img-thumbnail img-fluid" width="150">
	@endif

	<input type="file" name="foto" id="foto" class="form-control {{ $errors->has('foto')?'is-invalid':''}}">
	{!! $errors->first('foto','<div class="invalid-feedback">:message</div>')!!}
</div>

<input type="submit" class="btn btn-primary" value="{{ $modo=='crear'?'Agregar':'Modificar'}}">