<!DOCTYPE html>
<html>
<head>
	<title>Список клиентов</title>
</head>
<body>
	<h1></h1>

	<table border="1">
		<tr>
			<th>Имя</th>
			<th>Email</th>
			<th>Телефон</th>
			<th>Баланс</th>
			<th>Действие</th>
		</tr>
		@foreach($clients as $client)
		<tr>
			<td>{{ $client->name }}</td>
			<td>{{ $client->email }}</td>
			<td>{{ $client->phone }}</td>
			<td>{{ $client->balance }}</td>
			<td>
				<a href="{{ route('clients.edit', $client->id) }}" style=" text-decoration: none; color: blue; display: inline;">✏️ Изменить</a>
				
				{{-- Форма для удаления --}}
				<form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="color: red; display: inline;">
					@csrf
					@method('DELETE') {{-- Магия Laravel: меняем POST на DELETE --}}
					<button type="submit" onclick = "return confirm('Точно удалить клиента {{ $client->name }}?');" style="color: red; border: none; background: none; cursor: pointer;"> 🗑️ Удалить </button>
				</form>
			</td>
		</tr>
		@endforeach
	</table>
	<p><a href="{{ route('clients.create') }}">← Добавить клиента</a></p>
</body>
</html>