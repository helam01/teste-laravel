<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	public function scopeNome($query, $nome)
	{
		return $query->where('nome', $nome);
	}

	public function scopeEmail($query, $email)
	{
		return $query->where('email', $email);
	}

	static public function checkCliente($nome, $email)
	{
		$cliente =  Cliente::nome($nome)->email($email)->first();
		if ( !$cliente ) {
			$cliente = new Cliente();
			$cliente->nome = $nome;
			$cliente->email = $email;
			$cliente->save();

		}
		return $cliente;
	}
}