<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Status;
use App\Models\Priority;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
class TaskController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $statuses = Status::all();
        $priorities = Priority::all();

        $query = Task::query();

        if ($request->has('filter_status_id') && $request->filter_status_id !== null) {
            $query->where('status_id', $request->filter_status_id);
        }
        $selected_status = $request->filter_status_id;

        if ($request->has('filter_priority_id') && $request->filter_priority_id !== null) {
            $query->where('priority_id', $request->filter_priority_id);
        }
        $selected_priority = $request->filter_priority_id;

        if ($request->has('filter_due_date') && $request->filter_due_date !== null) {
            $query->where('due_date', $request->filter_due_date);
        }
        $selected_due_date = $request->filter_due_date;

        $query->where('user_id', auth()->id());

        $tasks = $query->get();
        return view('tasks.index', compact('tasks', 'statuses', 'priorities', 'selected_status', 'selected_priority', 'selected_due_date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'due_date' => 'required|nullable|date',
        ]);

        $task = new Task();
        $task->name = $validated['name'];
        $task->description = $validated['description'] ?? null;
        $task->due_date = $validated['due_date'] ?? null;
        $task->status_id = 1;
        $task->priority_id = 1;
        $task->user_id = auth()->id();
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task) {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to view this record.');
        }
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task) {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to view this record.');
        }
        
        $statuses = Status::all();
        $priorities = Priority::all();
        return view('tasks.edit', compact('task', 'statuses', 'priorities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task) {

        if ($task->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to view this record.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'due_date' => 'required|nullable|date',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task) {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to view this record.');
        }
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
