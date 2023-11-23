<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\GenerateChecklistRepository;
use App\Services\Api\GenerateChecklistService;
use Illuminate\Http\Request;

class GenerateChecklistController extends Controller
{

    private GenerateChecklistRepository $generateChecklistRepository;

    public function __construct(GenerateChecklistRepository $generateChecklistRepository) 
    {
        $this->generateChecklistRepository = $generateChecklistRepository;
    }

    public function create(Request $request, GenerateChecklistService $generateChecklistService)
    {
        $customErrors = [];
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'country' => 'required|exists:country,id',
            'category' => 'required|exists:category,id',
            'dob' => 'required|date',
            'maritalStatus' => 'required',
            'crimeRecord' => 'boolean',
            'qualifications' => 'required|array',
            'workExperience' => 'array',
            'workExperience.*.company' => 'string',
            'workExperience.*.position' => 'string',
            'workExperience.*.from' => 'date',
            'workExperience.*.to' => 'date',
            'children' => 'boolean',
            'pastRefusals' => 'boolean',
        ];

        $messages = [
            'qualifications.required' => 'Please select at least one qualification.'
        ];

        $request->validate($rules, $messages);
        $customErrors = $generateChecklistService->isValidQualificationYear($customErrors);
        $result = response()->json(['status' => 'error', 'customErrors' => $customErrors]);

        if (!array_filter($customErrors)) {

            //dd($request);
            
            $groupDocuments = $this->generateChecklistRepository->getGroupDocuments($request);

            dd('here', $groupDocuments);

            $result = response()->json(['status' => 'success', 'message' => 'Form submitted successfully']);
        }

        return $result;
    }
}
