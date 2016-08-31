<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Chamado;

class SacController extends Controller
{
	public function getSacForm()
	{
		return view("sac");
	}

	public function postSacForm(Request $request)
	{
		$inputs = $request->all();

		$cliente = Cliente::checkCliente($inputs['cliente_nome'], $inputs['cliente_email']);
		$pedido  = Pedido::find($inputs['pedido_numero']);
		if ( !$pedido ) {
			return redirect()->back()->with(
				'alert', [
                        'type' => 'error',
                        'message' => 'Pedido inválido'
                    ]
			)->withInput();
		}

		$chamado = Chamado::novoChamado($cliente, $pedido, $inputs);
		if ( !$chamado ) {
			return back()->withInput()->with(
			'alert', [
                    'type' => 'error',
                    'message' => 'Houve um erro ao salvar o chamado.'
            ])->withInput();
		}

		return back()->withInput()->with(
			'success', [
                'message' => 'Chamado cadastrado com sucesso.'
            ]);
	}


	public function postSacFormAjax(Request $request)
	{
		$inputs = $request->all();

		$cliente = Cliente::checkCliente($inputs['cliente_nome'], $inputs['cliente_email']);
		$pedido  = Pedido::find($inputs['pedido_numero']);
		if ( !$pedido ) {
			return response()->json([
				'status' => 'error',
				'message' => 'Pedido inválido'
				]);
		}

		$chamado = Chamado::novoChamado($cliente, $pedido, $inputs);
		if ( !$chamado ) {
			return response()->json([
				'status' => 'error',
				'message' => 'Houve um erro ao salvar o chamado'
				]);
		}

		return response()->json([
				'status' => 'success',
				'message' => 'Chamado cadastrado com sucesso'
				]);
	}



	public function getRelatorio(Request $request)
	{	
		$chamados = Chamado::getRelatorio($request);
		return view("relatorio")->with(['chamados'=>$chamados]);
	}
}