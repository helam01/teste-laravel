<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
	public function cliente()
	{
		return $this->belongsTo('App\Models\Cliente');
	}

	public function pedido()
	{
		return $this->belongsTo('App\Models\Pedido');
	}


	static public function novoChamado($cliente, $pedido, $input)
	{
		$chamado = new Chamado();
		$chamado->cliente_id = $cliente->id;
		$chamado->pedido_id = $pedido->id;
		$chamado->titulo = $input['chamado_titlo'];
		$chamado->observacao = $input['chamado_observacao'];
		$chamado->save();

		return $chamado;
	}


	static public function getRelatorio($request)
	{
		$query = Chamado::with(['pedido', 'cliente']);

		if ( $request->has('tipo') ) {
			$filtro_tipo = $request->get('tipo');
			$filtro_valor = $request->get('valor');

			switch ($filtro_tipo) {
				case 'email':
					$query->whereHas('cliente', function($q) use($filtro_valor){
						$q->where('email', $filtro_valor);
					});
					break;

				case 'pedido':
					$query->whereHas('pedido', function($q) use($filtro_valor){
						$q->where('id', $filtro_valor);
					});
					break;
			}
		}

		return $query->paginate(5);
	}
}