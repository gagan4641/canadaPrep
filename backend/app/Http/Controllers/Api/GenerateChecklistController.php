<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenerateChecklistController extends Controller
{
    public function create(Request $request)
    {
        $customErrors = [];
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'country' => 'required|exists:country,id',
            'category' => 'required|exists:categories,id',
            'dob' => 'required|date',
            'maritalStatus' => 'required',
            'crimeRecord' => 'boolean',
            'qualifications' => 'required|array',
            'workExperience' => 'array',
            'workExperience.*.company' => 'string',
            'workExperience.*.position' => 'string',
            'workExperience.*.from' => 'date',
            'workExperience.*.to' => 'date',
        ];

        $messages = [
            'qualifications.required' => 'Please select at least one qualification.'
        ];

        $request->validate($rules, $messages);




        
        
        if(count($request['qualifications']) > 0) {

            $completionYearError = [];
            $currentYear = date("Y");
            foreach($request['qualifications'] as $qualificationId) {

                $qualificationYear = $request["completionYear".$qualificationId];

                if (!preg_match('/^\d{4}$/', $qualificationYear) || $qualificationYear < 1900 || $qualificationYear > $currentYear) {
                    $completionYearError[] = $qualificationYear." is not a valid year";
                }
            }

            $customErrors['completionYearError'] = $completionYearError;
        }






        $result = response()->json(['status' => 'error', 'customErrors' => $customErrors]);

        if (!array_filter($customErrors)) {

            $result = response()->json(['status' => 'success', 'message' => 'Form submitted successfully']);
        }

        return $result;
    }
}
