@extends('layout')

@section('title', 'Новый клиент')

@section('content')
	<div class="row justify-content-center">
		<div class="col-12 col-md-8 col-lg-6">
			<div class="card shadow-sm border-0">
				<div class="card-header bg-white py-3">
					<h4 class="mb-0">✏️ Редактирование клиента</h4>
				</div>
				<div class="card-body">
					<form action="{{ route('clients.update', $client->id) }}" method="POST">
						@csrf
						@method('PUT')
						
						<div class="mb-3">
							<label for="name" class="form-label">Имя *</label>
							<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $client->name)}}">
							@error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
						</div>

						
						<div class="mb-3">
							<label for="email" class="form-label">Email *</label>
							<input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $client->email) }}">
							@error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
						</div>
						
						<div class="mb-3">
							<label for="phone" class="form-label">Телефон</label>
							<input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone', $client->phone) }}">
						</div>
						
						<div class="mb-3">
							<label for="balance" class="form-label">Баланс *</label>
							<input type="number" name="balance" id="balance" class="form-control @error('balance') is-invalid @enderror" value="{{ old('balance', $client->balance) }}" min="0">
							@error('balance') <div class="invalid-feedback">{{ $message }}</div> @enderror
						</div>
						
						<div class="d-flex gap-2">
							<button type="submit" class="btn btn-primary">💾 Сохранить</button>
							<a href="{{ route('clients.index') }}" class="btn btn-outline-secondary ms-auto">↩️ Отмена</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection