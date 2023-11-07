<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenerateChecklistController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'country' => 'required|exists:country,id',
            'category' => 'required|exists:categories,id',
            'dob' => 'required|date',
            'maritalStatus' => 'boolean',
            'crimeRecord' => 'boolean',
            'qualifications' => 'required|array', // At least one qualification is required.
            'qualifications.*' => 'exists:qualification,id',
            'qualifications.*.completionYear' => 'required|integer', // Completion year is required for all selected qualifications.
            'workExperience' => 'array',
            'workExperience.*.company' => 'string',
            'workExperience.*.position' => 'string',
            'workExperience.*.from' => 'date',
            'workExperience.*.to' => 'date',
        ];

        $messages = [
            'qualifications.required' => 'Please select at least one qualification.',
            'qualifications.*.completionYear.required' => 'Please provide a valid completion year for all selected qualifications.',
        ];
        
        $request->validate($rules, $messages);

        return response()->json('Test Response');
    }
}
