<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {


        return view('pages.home', [
            'tasks' => Task::query()->paginate(10),
            'doneTasks' => Task::query()->select('id')->where('completed', true)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required'
        ]);

        Task::query()->create($request->all());

        return redirect()->route('tasks.index')->with("success", "Task created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function edit($id)
    {
        $task = Task::query()->where('id', $id)->firstOrFail();
        if ($task['completed'] == false){
            Task::query()->where('id', $id)->update([
                'completed' => true
            ]);
        }else{
            Task::query()->where('id', $id)->update([
                'completed' => false
            ]);
        }
        return redirect()->route('tasks.index')->with("success", "Task status changed successfully");

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy($id)
    {

    }

}
