@extends('layouts.app') 

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
			<div class="panel panel-default">
				<div class="panel-body">
                    <h1 class="text-center">LIBRO</h1>
                    <form action="{{url('books/'.$book->id)}}" method="POST">
                        
                        <!-- esta linea de codigo ayuda hay emular a http para hacer una peticion de metodo PUT -->
                        {{ method_field('PUT') }}
                        
                        <!-- el csrf es un metodo de comprobacion para evitar aceptar peticiones falsas -->
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="">TITULO</label>
                            <input disabled type="text" class="form-control" name="title" value="{{$book->title}}" required>
                        </div>
                        <div class="form-group">
                            <label for="">RESUMEN</label>
                            <textarea disabled rows="4" class="form-control" name="resume">{{$book->resume}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">PRECIO</label>
                            <input disabled type="text" class="form-control" name="unit_price" value="{{$book->unit_price}}" required>
                        </div>
                        <div class="form-group">
                            <label for="">AREA</label>
                            <select disabled name="area_id" class="form-control" required>
                                @foreach($areas AS $item)
                                <option value="{{$item->id}}" <?= ($book->area_id == $item->id) ? 'selected' : '' ?> >{{$item->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <!-- <button class="btn btn-success" type="submit">Guardar</button> -->
                            <a href="{{url('books/'.$book->id.'/edit')}}" class="btn btn-default">Editar</a>
                        </div>
                    </form>
                </div>
			</div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="text-center">AUTORES</h2>
                   <table class="table table-bordered table-hover">
                       <thead>
                           <tr>
                               <th>ID</th>
                               <th>NOMBRE</th>
                               <!-- <th></th> -->
                           </tr>
                       </thead>
                       <tbody>
                           @foreach($book->authors AS $item)
                           <tr>
                               <td>{{$item->id}} </td>
                               <td>{{$item->nickname}} </td>
                               <!-- <td>
                                    <a href="" class="btn btn-danger" onclick="
                                        event.preventDefault();
                                        document.getElementById('delete-a-{{$item->ba_id}}').submit();
                                    ">Eliminar</a>
                                    <form class="form-inline" id="delete-a-{{$item->ba_id}}" action="{{url('book_delete_author/'.$item->ba_id)}}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                    </form>
                               </td> -->
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
                    <!-- <a href="{{url('book_add_author/'.$book->id)}}" class="btn btn-default"> Agregar</a> -->


                   <h2 class="text-center">TEMAS</h2>
                   <table class="table table-bordered table-hover">
                       <thead>
                           <tr>
                               <th>ID</th>
                               <th>TEMA</th>
                               <!-- <th></th> -->
                           </tr>
                       </thead>
                       <tbody>
                           @foreach($book->themes AS $item)
                           <tr>
                               <td>{{$item->id}} </td>
                               <td>{{$item->name}} </td>
                               <!-- <td>
                                    <a href="" class="btn btn-danger" onclick="
                                        event.preventDefault();
                                        document.getElementById('delete-t-{{$item->bt_id}}').submit();
                                    ">Eliminar</a>
                                    <form class="form-inline" id="delete-t-{{$item->bt_id}}" action="{{url('book_delete_theme/'.$item->bt_id)}}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                    </form>
                               </td> -->
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
                   <!-- <a href="{{url('book_add_theme/'.$book->id)}}" class="btn btn-default"> Agregar</a> -->
                </div>
            </div>
            
        </div>
        
	</div>
</div>
@endsection