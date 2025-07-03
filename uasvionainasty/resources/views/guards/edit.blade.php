@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>{{ $title ?? 'Edit Guard' }}</h2>
        @if(!empty($subtitle))
            <div class="mb-3 text-muted">{{ $subtitle }}</div>
        @endif
        <form action="{{ route('guards.update', $guard->id) }}" method="POST" class="card card-body shadow-sm">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $guard->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $guard->email) }}" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('guards.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
