@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Guard</h2>
    <a href="{{ route('guards.create') }}" class="btn btn-success">Tambah Guard</a>
</div>
@if($guards->isEmpty())
    <div class="alert alert-info">Belum ada data guard.</div>
@else
<table class="table table-striped table-bordered">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($guards as $guard)
        <tr>
            <td>{{ $guard->id }}</td>
            <td>{{ $guard->name }}</td>
            <td>{{ $guard->email }}</td>
            <td>
                <a href="{{ route('guards.show', $guard->id) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('guards.edit', $guard->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('guards.destroy', $guard->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
