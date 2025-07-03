@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Detail Guard</h2>
        <div class="card card-body shadow-sm mb-3">
            <div class="mb-2">
                <strong>Nama:</strong> {{ $guard->name }}
            </div>
            <div class="mb-2">
                <strong>Email:</strong> {{ $guard->email }}
            </div>
        </div>
        <a href="{{ route('guards.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('guards.edit', $guard->id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection
