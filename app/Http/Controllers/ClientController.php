<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Client;


class ClientController extends Controller
{	
	public function index(Request $request){
		$query = Client::query();
		
		if ($request->filled('search')) {
			$search = $request->search;
			$query->where('name', 'like', "%{$search}%")->orWhere('phone', 'like', "%{$search}%");
		}
		
		return view('clients.index', ['clients' => $query->latest()->get()]);
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

public function callClient($id)
{
    $client = Client::findOrFail($id);

    if (empty($client->phone)) {
        return back()->with('error', 'У клиента нет номера телефона!');
    }

    // Отправляем запрос с отключенной проверкой SSL (для локалки)
    $response = Http::withOptions(['verify' => false])->post(
        'https://app.mango-office.ru/vpbx/v1/request/call_initiator.json',
        [
            'key'       => env('MANGO_API_KEY'),
            'initiator' => env('MANGO_INITIATOR'),
            'abonent'   => $client->phone,
            'record'    => true,
        ]
    );

    // 🔍 ОТЛАДКА: Получаем сырой ответ
    $data = $response->json();
    $status = $response->status();

    // 🔍 ОТЛАДКА: Выводим всё на экран (временно!)
    return response()->json([
        'http_status' => $status,
        'mango_response' => $data,
        'request_data' => [
            'key' => substr(env('MANGO_API_KEY'), 0, 10) . '...', // Показываем только начало ключа
            'initiator' => env('MANGO_INITIATOR'),
            'abonent' => $client->phone,
        ]
    ]);
}
}
?>