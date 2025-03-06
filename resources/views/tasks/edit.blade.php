@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Görevi Düzenle</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Başlık</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Açıklama</label>
                            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $task->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="is_completed">Tamamlandı mı?</label>
                            <select name="is_completed" id="is_completed" class="form-control">
                                <option value="0" {{ $task->is_completed == 0 ? 'selected' : '' }}>Hayır</option>
                                <option value="1" {{ $task->is_completed == 1 ? 'selected' : '' }}>Evet</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Görevi Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
