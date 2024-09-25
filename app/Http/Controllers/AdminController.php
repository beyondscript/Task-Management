<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function addASupervisor(){
        return view('admin.supervisor.add');
    }

    public function createASupervisor(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $supervisor = new User;
        $supervisor->name = $request->name;
        $supervisor->email = $request->email;
        $supervisor->type = 'supervisor';
        $supervisor->password = Hash::make($request->password);
        $supervisor->save();

        $supervisor->sendEmailVerificationNotification();

        $notification = array(
            'message' => 'Supervisor successfully added',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function manageSupervisors(){
        return view('admin.supervisor.manage');
    }

    public function allSupervisors(){
        $supervisors = User::where('type', 'supervisor')->get();

        return response()->json([
            'supervisors' => $supervisors
        ],200);
    }

    public function revokeSupervisor(Request $request){
        $supervisor = User::findorfail($request->id);
        $supervisor->revoked = true;
        $supervisor->save();

        return response()->json([
            'revoked' => true
        ],200);
    }

    public function approveSupervisor(Request $request){
        $supervisor = User::findorfail($request->id);
        $supervisor->revoked = false;
        $supervisor->save();

        return response()->json([
            'approved' => true
        ],200);
    }

    public function adminManageTodos(){
        return view('admin.todo.manage');
    }

    public function allTodos(){
        $todos = Todo::with('assignor', 'assignee')->get();

        return response()->json([
            'todos' => $todos
        ],200);
    }

    public function getTodoReports(){
        $currentYear = Carbon::now()->format('Y');

        $todos = Todo::whereYear('created_at', $currentYear)->select('id', 'created_at')->get()->groupBy(function($todos){
            return Carbon::parse($todos->created_at)->format('M');
        });

        $completedTodos = Todo::whereYear('created_at', $currentYear)->where('completed', true)->select('id', 'created_at')->get()->groupBy(function($todos){
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

        $todoReports = [
            [
                'lebels' => $lebels,
                'datas' => $datas,
                'completedDatas' => $completedDatas
            ]
        ];

        return response()->json([
            'todoReports' => $todoReports
        ],200);
    }
}
