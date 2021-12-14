<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksDeleteController extends Controller
{
    public function deleteAll(Request $request){

        $ids = json_decode($request->input('ids'));

        foreach ($ids as $id){
            $deleteId = $id->id;
            Task::query()->where('id', $deleteId)->delete();
        }

        return redirect()->route('tasks.index')->with('success', 'All tasks were deleted successfully');
    }
}
