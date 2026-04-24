@extends('layout')

@section('title', 'Список клиентов')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2> Клиенты</h2>
		<form method="GET" action="{{ route('clients.index') }}" class="d-flex gap-2 mb-3">
			<input type="text" name="search" class="form-control" placeholder="Поиск по имени или телефону..." value"{{ request('search') }}">
			<button type="submit" class="btn btn-outline-secondary">Найти</button>
			@if(request('search'))
				<a href="{{ route('clients.index') }}" class="btn btn-link">✖ Сбросить</a>
			@endif
		</form>
        <a href="{{ route('clients.create') }}" class="btn btn-primary">➕ Добавить клиента</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Телефон</th>
                        <th>Баланс</th>
                        <th class="text-end">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td><a href="mailto:{{ $client->email }}" class="text-decoration-none">{{ $client->email }}</a></td>
                        <td>{{ $client->phone ?? '-' }}</td>
                        <td>{{ number_format($client->balance) }} ₽</td>
                        <td class="text-end">
                            <a href="{{ route('clients.call', $client->id) }}" class="btn btn-sm btn-success">📞</a>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-warning">✏️</a>
                            
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Клиентов пока нет. Добавьте первого!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection