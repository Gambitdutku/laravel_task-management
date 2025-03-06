<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskController extends Controller {
    public function index() {
    $tasks = Task::where('user_id', Auth::id())->get();
    return view('tasks.index', compact('tasks'));
}

    public function create() {
        return view('tasks.create');
    }

    public function store(Request $request) {
        $request->validate(['title' => 'required|string|max:255']);
        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description
        ]);
        return redirect()->route('tasks.index');
    }

    public function edit($id) {
        try {
            $task = Task::where('user_id', Auth::id())->findOrFail($id);
            return view('tasks.edit', compact('task'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('tasks.index')->with('error', 'Task not found.');
        }
    }

    public function update(Request $request, $id) {
    try {
        // Kullanıcı kendi görevini güncelleyebilsin
        $task = Task::where('user_id', Auth::id())->findOrFail($id);

        // Validasyon işlemleri
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_completed' => 'required|boolean', // Tamamlandı alanı doğrulaması
        ]);

        // Görevi güncelle
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->is_completed,
        ]);

        return redirect()->route('tasks.index')->with('message', 'Görev başarıyla güncellendi.');
    } catch (ModelNotFoundException $e) {
        return redirect()->route('tasks.index')->with('error', 'Görev bulunamadı.');
    }
}


    public function destroy($id) {
        try {
            $task = Task::where('user_id', Auth::id())->findOrFail($id);
            $task->delete();
            return redirect()->route('tasks.index');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('tasks.index')->with('error', 'Task not found.');
        }
    }
}
