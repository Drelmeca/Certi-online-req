<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    
    public function index()
    {
        $users = User::all();

        return Inertia::render('User/Index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return inertia('User/Edit', [
            'person' => null,
            'mode' => 'create'
        ]);
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:25',
            'email' => 'required|email|max:25',
            'status' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',

        ]);

        if ($request->input('id')) {
            // Update existing record
            $users = User::findOrFail($request->input('id'));
            $users->name = $request->input('name');
            $users->email = $request->input('email');
            $users->status = $request->input('status');
            $users->role = $request->input('role');
            if ($request->input('password')) {
                $users->password = Hash::make($request->input('password'));
            }

            $users->save();
            return response()->json([ 
                'success' => true,
                'message' => 'Data updated successfully.',
            ]);
        }else {
            // Create new record
            $requestCert = new User();
            $requestCert->name = $request->input('name');
            $requestCert->email = $request->input('email');
            $requestCert->status = $request->input('status');
            $requestCert->role = $request->input('role');
            $requestCert->password = Hash::make($request->input('password'));
            $requestCert->save();
            return response()->json([
                'success' => true,
                'message' => 'Data saved successfully.',
            ]);
        }

    }

    public function edit($id)
    {
        //$person = User::findOrFail(id: $id);
        
        $user = User::where('id', $id)->first();
        return inertia('User/Edit', ['user' => $user, 'mode' => 'edit']);
    }

  

    public function destroy($id)
    {
        // Delete the record
        // Redirect or return a response
    }
}