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

	// 1. Показать форму с данными клиента
	public function edit($id)
	{
		//Находим клиента, если нет - ошибка 404
		$client = client::findOrFail($id);
		return view('clients.edit', compact('client'));
	}
	
	// 2. Обработать сохранение
	public function update(Request $request, $id)
	{
		$client = Client::findOrFail($id);
		
		// Валидаци (почти такая же, как при создании, но email может быть тот же)
		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|unique:clients,email,' . $client->id, // Исключаем текущего клиента
			'phone' => 'nullable|string',
			'balance' => 'required|integer|min:0',
	]);
	
		// обновляем данные
		$client->update($validated);
	
		return redirect()->route('clients.index')->with('success', 'Клиент обнавлён!');
	}
	
	public function destroy($id)
	{
		// 1. Находим клиента (если нет - ошибка 404)
		$client = Client::findOrFail($id);
		
		// 2. Удаляем запись из БД
		$client->delete();
		
		//3. Возвращаемся на список с сообщением
		return redirect()->route('clients.index')->with('success', 'Клиент удалён!');
	}
}
?>