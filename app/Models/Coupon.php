<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	use HasFactory;


	public function remise($total){
		return ( ($this->pourcentageRemise/100) * $total);
	}
}
