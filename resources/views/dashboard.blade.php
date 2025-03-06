@extends('layouts.app')
@section('content')
<div class='container'>
    <h1 class='mb-4'>Görevlerim</h1>
    <a href='{{ route('tasks.create') }}' class='btn btn-primary mb-3'>Yeni Görev Ekle</a>
    <table class='table'>
        <thead><tr><th>Başlık</th><th>Durum</th><th>İşlemler</th></tr></thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->is_completed ? 'Tamamlandı' : 'Devam Ediyor' }}</td>
                    <td>
                        <a href='{{ route('tasks.edit', $task) }}' class='btn btn-warning'>Düzenle</a>
                        <form action='{{ route('tasks.destroy', $task) }}' method='POST' style='display:inline-block;'>
                            @csrf @method('DELETE')
                            <button type='submit' class='btn btn-danger'>Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection