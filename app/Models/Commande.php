<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    
	protected $fillable = [
		'produits',
		'montant_commande',
		// 'id_prod',
		// 'id_user',
	];
	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
}
