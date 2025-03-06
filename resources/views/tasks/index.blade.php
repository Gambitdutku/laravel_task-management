@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Görevler</span>
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm">Yeni Görev Ekle</a>
                </div>

                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-info">{{ session('message') }}</div>
                    @endif

                    @if($tasks->isEmpty())
                        <p>Hiç görev bulunmamaktadır.</p>
                    @else
                        <ul class="list-group">
                            @foreach($tasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>{{ $task->title }}</h5>
                                        <p>{{ $task->description }}</p>
                                        <small>
                                            @if($task->created_at)
                                                {{ $task->created_at->diffForHumans() }}
                                            @else
                                                Bilinmiyor
                                            @endif
                                        </small>
                                    </div>

                                    <div class="d-flex">
                                        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="mr-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_completed" value="{{ !$task->is_completed }}">
                                            <button type="submit" class="btn {{ $task->is_completed ? 'btn-success' : 'btn-warning' }} btn-sm">
                                                {{ $task->is_completed ? 'Tamamlandı' : 'Tamamla' }}
                                            </button>
                                        </form>

                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-info btn-sm mr-2">Düzenle</a>

                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection