<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Tasks::all();

        return response()->json($tasks, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $task = new Tasks();
        $task->fill($request->validated());
        $task->save();

        return response()->json($task, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Tasks::findOrFail($id);

        return response()->json($task, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {

        $task = Tasks::findOrFail($id);
        $task->update($request->validated());

        return response()->json($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Tasks::findOrFail($id);
        $task->delete();

        $message = ['message' => "Task with id $id removed"];

        return response()->json($message, 200);
    }
}
