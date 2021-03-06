<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
	use HasFactory;
	
	protected $fillable = [
		'nom_categorie',
		'slug',
	];

	public function produits()
	{
		return $this->belongsToMany('App\Models\Produit');
	}
}
