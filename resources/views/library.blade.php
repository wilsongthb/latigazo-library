@extends('layouts.app') 

@section('content')



<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<h3 class="text-center">LIBRERIA</h3>
					<form action="{{url('library')}}" method="GET">
						<div class="form-group">
							<input type="text" name="buscar" value="{{ request()->buscar }}" class="form-control" placeholder="Buscar | Filtrar">
						</div>

						<!-- este div es para buscar por autor y tema -->
						<div class="form-inline">
							<label for="">Area: </label>
							<select name="area_id" class="form-control">
								<option value=""></option>
								@foreach($areas as $item)
								<option value="{{$item->id}}" <?= (request()->area_id == $item->id) ? 'selected' : '' ?>>{{$item->name}} </option>
								@endforeach
							</select>

							<label for="">Autor: </label>
							<select name="author_id" class="form-control">
								<option value=""></option>
								@foreach($authors as $item)
								<option value="{{$item->id}}" <?= (request()->author_id == $item->id) ? 'selected' : '' ?>>{{$item->nickname}} </option>
								@endforeach
							</select>

							<label for="">Tema: </label>
							<select name="theme_id" class="form-control">
								<option value=""></option>
								@foreach($themes as $item)
								<option value="{{$item->id}}" <?= (request()->theme_id == $item->id) ? 'selected' : '' ?>>{{$item->name}} </option>
								@endforeach
							</select>
							<button class="btn btn-default" type="submit">Buscar</button>
						</div>

					</form>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>TITULO</th>
								<th>AREA</th>
								<th>AUTORES</th>
								<th>TEMAS</th>
								<th>PRECIO</th>
								<th class="col-lg-2"></th>
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
									<a href="{{url('library/'.$item->id)}}" class="btn btn-info">Detalles</a>
									<a href="" class="btn btn-success"> Comprar</a>
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