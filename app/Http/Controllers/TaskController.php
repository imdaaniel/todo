<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all()->sortByDesc('created_at');;

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        DB::beginTransaction();

        try {
            Task::create($request->validated());
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('tasks.index')->withErrors(['error' => 'Task creation failed']);
        } finally {
            DB::commit();
            return redirect()->route('tasks.index')->with('message', 'Task created successfully');
        }
    }

    public function edit(string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->route('tasks.index')->withErrors(['error' => 'Task not found']);
        }

        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->route('tasks.index')->withErrors(['error' => 'Task not found']);
        }

        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('message', 'Task updated successfully');
    }

    public function changeStatus(ChangeStatusTaskRequest $request, string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->route('tasks.index')->withErrors(['error' => 'Task not found']);
        }

        $task->is_completed = $request->has('is_completed');
        $task->update();

        return redirect()->route('tasks.index')->with('message', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('message', 'Task deleted successfully');
    }
}
