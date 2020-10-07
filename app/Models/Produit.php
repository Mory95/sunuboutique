<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    	
	protected $fillable = [
		'libelle',
		'description',
		'prix',
		'qte_stock',
		'taux_remise',
		'image',
		// 'id_cat',
		// 'id_marque'
	];

	public function categories()
	{
		return $this->belongsToMany('App\Models\Categorie');
	}


	public function marque()
	{
		return $this->belongsTo('App\Models\Marque');
	}
}
