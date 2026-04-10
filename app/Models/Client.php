<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	//Разрешаем заполненять эти поля массово
	protected $fillable = [
		'name',
		'email',
		'phone',
		'balance'
	];
}
