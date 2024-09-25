<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;
use Auth;
use Carbon\Carbon;

class SupervisorController extends Controller
{
    public function addATodo(){
        $stuffs = User::where('type', 'stuff')->get();

        return view('supervisor.todo.add', compact('stuffs'));
    }

    public function createATodo(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'stuff' => ['required', 'integer'],
        ]);

        $todo = new Todo;
        $todo -> name = $request -> name;
        $todo -> description = $request -> description;
        $todo -> supervisor_id = Auth::user()->id;
        $todo -> stuff_id = $request -> stuff;
        $todo->save();

        $notification = array(
            'message' => 'Todo successfully added',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function manageTodos(){
        return view('supervisor.todo.manage');
    }

    public function assignorTodos(){
        $todos = Todo::with('assignee')->where('supervisor_id', Auth::user()->id)->get();

        return response()->json([
            'todos' => $todos
        ],200);
    }

    public function markTodoAsCompleted(Request $request){
        $todo = Todo::findorfail($request->id);
        $todo->completed = true;
        $todo->save();

        return response()->json([
            'completed' => true
        ],200);
    }

    public function destroyTodo(Request $request){
        $todo = Todo::findorfail($request->id);
        $todo->delete();

        return response()->json([
            'destroyed' => true
        ],200);
    }

    public function getAssignorTodoReports(){
        $currentYear = Carbon::now()->format('Y');

        $todos = Todo::whereYear('created_at', $currentYear)->where('supervisor_id', Auth::user()->id)->select('id', 'created_at')->get()->groupBy(function($todos){
            return Carbon::parse($todos->created_at)->format('M');
        });

        $completedTodos = Todo::whereYear('created_at', $currentYear)->where('supervisor_id', Auth::user()->id)->where('completed', true)->select('id', 'created_at')->get()->groupBy(function($todos){
            return Carbon::parse($todos->created_at)->format('M');
        });

        $lebels = [];
        $datas = [];
        $completedDatas = [];

        for($m = 1; $m <= 12; $m++){
            $monthName = Carbon::parse($currentYear. '-' .$m. '-01 00:00:00')->format('M');

            $numberOfTodos = 0;
            $numberOfCompletedTodos = 0;

            array_push($lebels, $monthName);

            foreach($todos as $todoMonthName => $monthlyTodos){
                if($todoMonthName == $monthName){
                    $numberOfTodos = $monthlyTodos->count();

                    break;
                }
            }

            array_push($datas, $numberOfTodos);

            foreach($completedTodos as $completedTodoMonthName => $monthlyCompletedTodos){
                if($completedTodoMonthName == $monthName){
                    $numberOfCompletedTodos = $monthlyCompletedTodos->count();

                    break;
                }
            }

            array_push($completedDatas, $numberOfCompletedTodos);
        }

        $assignorTodoReports = [
            [
                'lebels' => $lebels,
                'datas' => $datas,
                'completedDatas' => $completedDatas
            ]
        ];

        return response()->json([
            'assignorTodoReports' => $assignorTodoReports
        ],200);
    }
}
