@extends('layouts.app') 

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
			<div class="panel panel-default">
				<div class="panel-body">
                    <h1 class="text-center">LIBRO</h1>
                    <form action="{{url('books')}}" method="POST">
                        
                        <!-- el csrf es un metodo de comprobacion para evitar aceptar peticiones falsas -->
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="">TITULO</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="">RESUMEN</label>
                            <textarea rows="4" class="form-control" name="resume"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">PRECIO</label>
                            <input type="text" class="form-control" name="unit_price" required>
                        </div>
                        <div class="form-group">
                            <label for="">AREA</label>
                            <select name="area_id" class="form-control" required>
                                @foreach($areas AS $item)
                                <option value="{{$item->id}}">{{$item->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Guardar</button>
                        </div>
                    </form>
                </div>
			</div>
        </div>
    </div>
</div>

@endsection