<!DOCTYPE html>
<html>
<head land="ru">
	<meta charset="UTF-8">
	<titel>Редактировать клиента</titel>
</head>
<body>
	<h1>✏️ Редактирование: </h1>
	
	<form action="{{ route('clients.update', $client->id) }}" method="POST">
		@csrf
		@method('PUT') {{-- 🔑 Магия: сообщаем Laravel, что это обновление --}}
		
		<p>
			<label>Имя:</label><br>
			<input type="text" name="name" value="{{ old('name', $client->name) }}">
			@error('name') <span style="color: red">{{ $message }}</span> @enderror
		</p>
		
		<p>
			<label>Email:</label><br>
			<input type="email" name="email" value="{{ old('email', $client->email) }}">
			@error ('email') <span style="color: red">{{ $message }}</span> @enderror
		</P>
		
		<p>
			<label>Телефон:</label><br>
			<input type="text" name="phone" value="{{ old('phone', $client->phone) }}">
		</p>
		
		<p>
			<label>Баланс:</label><br>
			<input type="number" name="balance" value="{{ old('balance', $client->balance) }}">
			@error ('balance') <span style="color: res">{{ $message }}</span> @enderror
		</p>
		
		<button type="submit">Сохранить изменения</button>
	</form>
	
	<p><a href="{{ route('clients.index') }}">← Назад</a></p>
</body>
</html>