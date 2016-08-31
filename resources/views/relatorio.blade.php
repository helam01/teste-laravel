@extends('template')
@section('content')
	
	<div class="row" style="margin-top:50px">
		<div class="col-md-12">
			<h3>Relatório</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h4>Fltro</h4>
		</div>
		<div class="col-md-12">
			<form class="form-inline" method="get" action="{!! route('getRelatorio') !!}">
				<div class="form-group">
				    <label for="tipo">Filtar Por: </label>
					<select class="form-control" name="tipo">
						<option value='email'>Email do cliente</option>
						<option value='pedido'>Número do Pedido</option>
					</select>   
				    
				</div>
				<div class="form-group">
				    <label for="pedido_numero">Valor: </label>
				    <input type="text" class="form-control" name="valor">
				</div>
				<button type="submit" class="btn btn-default">Pesquisar</button>
				<a href="{!! route('getRelatorio') !!}" class="btn btn-default">Remover filtro</a>
			</form>
		</div>
	</div>

	<div>
		@if ( $chamados->count() > 0 )
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Titulo</th>
					<th>obervação</th>
					<th>Pedido</th>
					<th>Cliente</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $chamados as $chamado)
					<tr>
						<td>{!! $chamado->titulo !!}</td>
						<td>{!! $chamado->observacao !!}</td>
						<td>{!! $chamado->pedido->id !!}</td>
						<td>{!! $chamado->cliente->nome !!}</td>
						<td>{!! $chamado->cliente->email !!}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<nav aria-label="Page navigation">
		  <ul class="pagination">
		    <li>
		      <a href="{{ $chamados->url(1) }}" aria-label="Previous">
		        <span aria-hidden="true">&laquo;</span>
		      </a>
		    </li>
		    @for ($i = 1; $i <= $chamados->lastPage(); $i++)
		    	<li><a href="{{ $chamados->url($i) }}" class="item button"> {{ $i }}</a></li>
		    @endfor
		    <li>
		      <a href="{{ $chamados->url($chamados->lastPage()) }}" aria-label="Next">
		        <span aria-hidden="true">&raquo;</span>
		      </a>
		    </li>
		  </ul>
		</nav>
		@else
		<p>Nenhum resultado</p>
		@endif
	</div>

@endsection

@section('Js')
<script type="text/javascript">
	$(function(){
		@if( Session::has('success'))
			$.notify("{!!Session::get('success')['message'] !!}", "success");
		@endif
	});
</script>
@endsection