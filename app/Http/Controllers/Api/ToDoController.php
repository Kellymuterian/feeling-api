<?php

namespace App\Http\Controllers\Api;

use App\Models\TODO;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ToDoController extends Controller
{
    public function index()
    {
        $todos = TODO::all();
        if ($todos->count() > 0) {
            return response()->json([
                'status' => 200,
                'Task' => $todos
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'No Task Found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:191',
            'description' => 'required|string|max:191',
            'is_completed' => 'boolean',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $todos = TODO::create([
                'title' => $request->title,
                'description' => $request->description,
                'is_completed' => $request->is_completed,
            ]);

            if ($todos) {
                return response()->json([
                    'status' => 200,
                    'message' => "Task added succesfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong"
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $todo = TODO::find($id);
        if ($todo) {
            return response()->json([
                'status' => 200,
                'member' => $todo
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such Task"
            ], 404);
        }
    }

    public function edit($id)
    {
        $todo = TODO::find($id);
        if ($todo) {
            return response()->json([
                'status' => 200,
                'Todo' => $todo
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such Task"
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:191',
            'description' => 'required|string|max:191',
            'is_completed' => 'boolean',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $todos = TODO::find($id);
            $todos->update([
                'title' => $request->title,
                'description' => $request->description,
                'is_completed' => $request->is_completed,
            ]);

            if ($todos) {
                return response()->json([
                    'status' => 200,
                    'message' => "Task Updated succesfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No such Task"
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $todo = TODO::find($id);
        if ($todo) {
            $todo->delete();
            return response()->json([
                'status' => 200,
                'message' => "Task deleted successfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such Task"
            ], 404);
        }
    }
}
