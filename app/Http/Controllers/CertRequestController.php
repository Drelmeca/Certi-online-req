<?php

namespace App\Http\Controllers;

use App\Models\CertRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
class CertRequestController extends Controller
{
    public function index()
    {
        $CertRequest = CertRequest::all();
        
        return Inertia::render('CertRequest/Index', [
            'CertRequest' => $CertRequest,
        ]);
    }
    public function create()
    {
        return inertia('CertRequest/Edit', [
            'person' => null,
            'mode' => 'create',
             'userType' => 'user',
        ]);
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:15',
            'middle_name' => 'nullable|string|max:15',
            'last_name' => 'required|string|max:15',
            'suffix' => 'nullable|string|max:15',
            'email' => 'required|email|max:25',
            'contact_number' => 'required|string|max:11',
            'request_type' => 'required|string|max:25',
            'request_purpose' => 'required|string|max:50',
        ]);

        try {
            if ($request->input('id')) {
                // Update existing record
                $CertRequest = CertRequest::findOrFail($request->input('id'));
                $CertRequest->first_name = $request->input('first_name');
                $CertRequest->middle_name = $request->input('middle_name');
                $CertRequest->last_name = $request->input('last_name');
                $CertRequest->suffix = $request->input('suffix');
                $CertRequest->email = $request->input('email');
                $CertRequest->request_type = $request->input('request_type');
                $CertRequest->request_purpose = $request->input('request_purpose');
                $CertRequest->contact_number = $request->input('contact_number');
                $CertRequest->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Data updated successfully.',
                ]);
            } else {
                // Create new record
                $requestCert = new CertRequest();
                $requestCert->first_name = $request->input('first_name');
                $requestCert->middle_name = $request->input('middle_name');
                $requestCert->last_name = $request->input('last_name');
                $requestCert->suffix = $request->input('suffix');
                $requestCert->email = $request->input('email');
                $requestCert->request_type = $request->input('request_type');
                $requestCert->request_purpose = $request->input('request_purpose');
                $requestCert->contact_number = $request->input('contact_number');
                $requestCert->status = 0;
                $requestCert->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Data saved successfully.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function edit($id)
    {
        $CertRequest = CertRequest::where('id', $id)->first();
        return Inertia::render('CertRequest/Edit', [
            'person' => $CertRequest,
            'mode' => 'edit',
            'userType' => 'user',
        ]);
    }

    public function destroy($id)
    {
        // Delete the record
        // Redirect or return a response
    }
}
