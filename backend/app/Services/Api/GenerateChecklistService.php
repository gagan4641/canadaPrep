<?php

namespace App\Services\Api;
use Illuminate\Http\Request;

class GenerateChecklistService
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function isValidQualificationYear($customErrors) {

        if(count($this->request['qualifications']) > 0) {

            $completionYearError = [];
            $currentYear = date("Y");
            foreach($this->request['qualifications'] as $qualificationId) {

                $qualificationYear = $this->request["completionYear".$qualificationId];

                if (!preg_match('/^\d{4}$/', $qualificationYear) || $qualificationYear < 1900 || $qualificationYear > $currentYear) {
                    $completionYearError[] = $qualificationYear." is not a valid year";
                }
            }

            $customErrors['completionYearError'] = $completionYearError;
        }

        return $customErrors;
    }

    public function isValidQualificationYearSequence($customErrors) {

        if(count($this->request['qualifications']) > 1) {

            $prevYear = null;
            $qualificationsIds = $this->request['qualifications'];
            sort($qualificationsIds);
        
            foreach($qualificationsIds as $qualification) {

                $completionYearInput = 'completionYear'.$qualification;
                $year = $this->request[$completionYearInput];

                if ($prevYear !== null && $year < $prevYear) {

                    $customErrors['completionYearError'][] = "The completion year of a lower education level cannot be greater than the completion year of a higher education level";
                    break;
                }

                $prevYear = $year;
            }
        }

        return $customErrors;
    }

}