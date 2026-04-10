<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Добавить клиента</title>
</head>
<body>
	<h1>➕ Добавить нового клиента</h1>
	
	{{-- action указывает на маршрут POST --}}
	<form action="{{ route('clients.store') }}" method="POST">
		@csrf {{-- 🔒 Защита от CSRF атак (ОБЯЗАТЕЛЬНО!) --}}
		
		{{-- Поле Имя --}}
		<p>
			<label>Имя:</label><br>
			<input type="text" name="name" value="{{ old('name') }}">
			@error('name') <span style="color: red;">{{ $message }}</span> @enderror
		</p>
		
		{{-- Поле Email --}}
		<p>
			<label>Email:</label><br>
			<input type="email" name="email" value="{{ old('email') }}">
			@error ('email') <span style="color: red;">{{ $message }}</span> @enderror
		</p>
		
		{{-- Поле Телефон --}}
		<p>
			<label>Телефон:</label><br>
			<input type="text" name="phone" value="{{ old('phone') }}">
			@error ('phone') <span style="color: red;">{{ $message }}</span> @enderror
		</p>
		
		{{-- Поле Баланс --}}
		<p>
			<label>Баланс:</label><br>
			<input type="number" name="balance" value="{{ old('balance') }}">
			@error ('balance') <span style="color: red;">{{ $message }}</span> @enderror
		</p>
		
		<button type="submit">Сохранить</button>
	</form>
	
	<p><a href="{{ route('clients.index') }}">← Назад к списку</a></p>
</body>
</html>