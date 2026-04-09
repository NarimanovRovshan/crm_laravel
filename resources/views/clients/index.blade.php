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
		</tr>
		@foreach($clients as $client)
		<tr>
			<th>{{ $client->name }}</th>
			<th>{{ $client->email }}</th>
			<th>{{ $client->phone }}</th>
			<th>{{ $client->balance }}</th>
		</tr>
		@endforeach
	</table>
</body>
</html>