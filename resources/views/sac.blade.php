@extends('template')
@section('content')
	
	<div class="row" style="margin-top:50px">
		<div class="col-md-12">
			<h3>Cadastro de Chamado</h3>
		</div>
		<div class="jumbotron">
		<form action="{!! route('postSac') !!}" method="post" class="form">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
		  <div class="form-group">
		    <label for="pedido_numero">Número do pedido</label>
		    <input type="text" class="form-control" id="pedido_numero" placeholder="Digite o número"
		    	value="{!! old('pedido_numero') !!}" name="pedido_numero" required="">
		    	@if( Session::has('alert'))
		    		<span id="helpBlock2" class="inputs-messages">{!! Session::get('alert')['message'] !!}</span>
		    	@endif
		    
		  </div>

		  <div class="form-group">
		    <label for="cliente_nome">Nome do Cliente</label>
		    <input type="text" name="cliente_nome" class="form-control" id="cliente_nome" 
		    	placeholder="Digite o nome do cliente" value="{!! old('cliente_nome') !!}" required="" >
		  </div>
		  <div class="form-group">
		    <label for="cliente_email">Email do Cliente</label>
		    <input type="email" name="cliente_email" class="form-control" id="cliente_email" 
		     placeholder="Digite o email do cliente" value="{!! old('cliente_email') !!}" required="">
		  </div>
		  <div class="form-group">
		    <label for="chamado_titlo">Titulo</label>
		    <input type="text" name="chamado_titlo" class="form-control" id="chamado_titlo" 
		    placeholder="Digite um titulo" value="{!! old('chamado_titlo') !!}" required="">
		  </div>
		  <div class="form-group">
		    <label for="chamado_descricao">Observação</label>
		    <textarea class="form-control" rows="3" id="chamado_observacao" name="chamado_observacao" required="">{!! old('chamado_observacao') !!}</textarea>
		  </div>


		  <button type="submit" class="btn btn-success btnSave">Cadastrar</button>
		  <button type="submit" class="btn btn-success btnSaveAjax">Cadastrar Com Ajax</button>
		</form>
	</div>
</div>

@endsection

@section('Js')
<script type="text/javascript">
	$(function(){
		@if( Session::has('success'))
			$.notify("{!!Session::get('success')['message'] !!}", "success");
		@endif

		$('.btnSaveAjax').click(function(e){
			e.preventDefault();

			save();
		});
	});

	function formSerialize()
	{
		var data = {
			"_token" : $("#_token").val(),
			"pedido_numero" : $("#pedido_numero").val(),
			"cliente_nome" : $("#cliente_nome").val(),
			"cliente_email" : $("#cliente_email").val(),
			"chamado_titlo" : $("#chamado_titlo").val(),
			"chamado_observacao" : $("#chamado_observacao").val(),
		};

		return data;
	}

	function save()
	{
		var data = formSerialize();
		console.log( data );

		$.ajax({
			url : "{!! route('postSacAjax') !!}",
			dataType : "Json",
			type : "post",
			data : data,
			success : function(response){
				console.log(response);

				$.notify(response.message, response.status);
			}
		});
	}
</script>
@endsection