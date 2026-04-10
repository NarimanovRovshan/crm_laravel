<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;


class ClientController extends Controller
{	
	public function index(){
		$clients = Client::all();
		return view('clients.index', compact('clients'));
	}
	
	public function create()
	{
		// Просто показать пустую форму
		return view('clients.create');
	}
	
	public function store(Request $request)
	{
		// 1. Валидация данных (проверка на ошибки)
		$validated = $request->validate([
			'name' => 'required|string|max:225',
			'email' => 'required|email|unique:clients,email',
			'phone' => 'nullable|string',
			'balance' => 'required|integer|min:0',
		]);
		
		// 2. Создание записи в БД
		// $validated содержит только те поля, что прошли проверку
		Client::create($validated);
		
		// 3. Редирект обратно на список с сообщением успеха
		return redirect()->route('clients.index')->with('success','Клиент успешно добавлен!');
	}
}
