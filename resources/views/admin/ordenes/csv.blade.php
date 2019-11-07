@extends('layouts.app')
@section('title', 'CSV Importar')

@section('content_header')
    <h1>CSV Importar</h1>
@stop

@section('content')

<!---728x90--->

{!!Form::open(['url' => '/CSVFormCompras', 'method' => 'POST', 'files' => true])!!}
<div class="panel panel-primary">
  <div class="panel-heading">
    <h2>Importa Reporte de Compras</h2>
  </div>
  <div class="panel-body">
    <p>Busca el archivo de reporte de compras  ".txt" para importarlo</p>
    <div class="col-md-6">
      <input type="file" name="file"/>
    </div>
  </div>
  <div class="panel-footer">
    <button class="btn btn-success" type="submit" name="button">Importar</button>
    <button class="btn btn-danger" type="reset" name="button">Cancelar</button>
  </div>
</div>
{!!Form::close()!!}

@stop

@section('js')
<script src="{{asset('assets/custom/js/orders/csv.js')}}"></script>
@stop
