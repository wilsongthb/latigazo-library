@extends('layouts.app') 

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            
            <div class="panel panel-default">
                <div class="panel-body">
                <h2 class="text-center">Agregar Tema</h2>
                   <form action="{{url('book_add_theme/'.$book_id)}}" method="POST">
                        {{ csrf_field() }}
                       <div class="form-group">
                           <label for="">Tema</label>
                           <select name="theme_id" class="form-control" required>
                               @foreach($themes as $item)
                               <option value="{{$item->id}}">{{$item->name}} </option>
                               @endforeach
                           </select>
                       </div>
                       <button class="btn btn-default" type="submit"> Agregar</button>
                   </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection