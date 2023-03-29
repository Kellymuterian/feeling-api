<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        if ($members->count() > 0) {
            return response()->json([
                'status' => 200,
                'member' => $members
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'No Records Found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $members = Member::create([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if ($members) {
                return response()->json([
                    'status' => 200,
                    'message' => "Member added succesfully"
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
        $member = Member::find($id);
        if ($member) {
            return response()->json([
                'status' => 200,
                'member' => $member
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such member"
            ], 404);
        }
    }

    public function edit($id)
    {
        $member = Member::find($id);
        if ($member) {
            return response()->json([
                'status' => 200,
                'member' => $member
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such member"
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $members = Member::find($id);
            $members->update([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if ($members) {
                return response()->json([
                    'status' => 200,
                    'message' => "Member Updated succesfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No such member"
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $member = Member::find($id);
        if ($member) {
            $member->delete();
            return response()->json([
                'status' => 200,
                'message' => "Member deleted successfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such member"
            ], 404);
        }
    }
}
