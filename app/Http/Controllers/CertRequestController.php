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
          $appSettings = [
            'barangay' => 'Guinacot',
            'province' => 'Cebu',
            'city' => 'Danao City',
          ];
        return inertia('CertRequest/Edit', [
            'person' => null,
            'mode' => 'create',
             'userType' => 'user',
            'appSettings' => $appSettings,
        ]);
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:25',
            'middle_name' => 'nullable|string|max:25',
            'last_name' => 'required|string|max:25',
            'suffix' => 'nullable|string|max:25',
            'contact_number' => 'required|string|max:11',
            'request_type' => 'required|string|max:25',
            'request_purpose' => 'required|string|max:25',
            'purok' => 'required|string|max:25',

            // add other fields as needed
        ]);

        if ($request->input('id')) {
            // Update existing record
            $CertRequest = CertRequest::findOrFail($request->input('id'));
            $CertRequest->first_name = $request->input('first_name');
            $CertRequest->middle_name = $request->input('middle_name');
            $CertRequest->last_name = $request->input('last_name');
            $CertRequest->suffix = $request->input('suffix');
            $CertRequest->request_type = $request->input('request_type');
            $CertRequest->request_purpose = $request->input('request_purpose');
            $CertRequest->purok = $request->input('purok');
            $CertRequest->contact_number = $request->input('contact_number');;
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
            $requestCert->request_type = $request->input('request_type');
            $requestCert->request_purpose = $request->input('request_purpose');
            $requestCert->purok = $request->input('purok');
            $requestCert->contact_number = $request->input('contact_number');
            $requestCert->save();
            return response()->json([
                'success' => true,
                'message' => 'Data saved successfully.',
            ]);
        }
        // .
    }


    public function edit($id)
    {
        $appSettings = [
            'barangay' => 'Guinacot',
            'province' => 'Cebu',
            'city' => 'Danao City',
        ];
        $CertRequest = CertRequest::where('id', $id)->first();
        return Inertia::render('CertRequest/Edit', [
            'person' => $CertRequest,
            'mode' => 'edit',
            'userType' => 'user',
            'appSettings' => $appSettings,
        ]);
    }

    public function destroy($id)
    {
        // Delete the record
        // Redirect or return a response
    }
}
