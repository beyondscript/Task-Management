<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Todo;
use Auth;

class StuffController extends Controller
{
    public function getAssigneeTodoReports(){
        $currentYear = Carbon::now()->format('Y');

        $todos = Todo::whereYear('created_at', $currentYear)->where('stuff_id', Auth::user()->id)->select('id', 'created_at')->get()->groupBy(function($todos){
            return Carbon::parse($todos->created_at)->format('M');
        });

        $completedTodos = Todo::whereYear('created_at', $currentYear)->where('stuff_id', Auth::user()->id)->where('completed', true)->select('id', 'created_at')->get()->groupBy(function($todos){
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

        $assigneeTodoReports = [
            [
                'lebels' => $lebels,
                'datas' => $datas,
                'completedDatas' => $completedDatas
            ]
        ];

        return response()->json([
            'assigneeTodoReports' => $assigneeTodoReports
        ],200);
    }

    public function assignedTodos(){
        return view('stuff.todo.assigned');
    }

    public function assigneeTodos(){
        $todos = Todo::with('assignor')->where('stuff_id', Auth::user()->id)->get();

        return response()->json([
            'todos' => $todos
        ],200);
    }
}
