@extends('layouts.app') 

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<h3 class="text-center">LIBROS</h3>
					<form action="{{url('books')}}" method="GET">
						<div class="form-group">
							<input type="text" name="buscar" class="form-control" placeholder="Buscar | Filtrar">
						</div>
					</form>
					<div class="form-group">
						<a href="{{url('books/create')}} " class="btn btn-success">Crear</a>
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>TITULO</th>
								<th>AREA</th>
								<th>AUTORES</th>
								<th>TEMAS</th>
								<th>PRECIO</th>
								<th class="col-lg-3"></th>
							</tr>
						</thead>
						<tbody>
                            @foreach($books as $item)
                            <tr>
								<td>{{$item->id}} </td>
                                <td>{{$item->title}} </td>
                                <td>{{$item->area}} </td>
                                <td>
                                    @foreach($item->authors as $author)
                                    <span class="label label-default">{{$author->nickname}} </span>    
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($item->themes as $theme)
                                    <span class="label label-default">{{$theme->name}} </span>    
                                    @endforeach
                                </td>
                                <td>S/. {{$item->unit_price}} </td>
                                <td>
									<a href="{{url('books/'.$item->id)}}" class="btn btn-info">Detalles</a>
                                    <a href="{{url('books/'.$item->id.'/edit')}}" class="btn btn-warning">Editar</a>
									<a href="" class="btn btn-danger" onclick="
										event.preventDefault();
										document.getElementById('delete-{{$item->id}}').submit();
									">Eliminar</a>
									<form class="form-inline" id="delete-{{$item->id}}" action="{{url('books/'.$item->id)}}" method="POST">
										{{ method_field('DELETE') }}
										{{ csrf_field() }}
									</form>
                                </td>
							</tr>
                            @endforeach
						</tbody>
					</table>

                    {{ $books->links() }}
				</div>
			</div>

		</div>
	</div>
</div>
@endsection
