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

    public function isValidQualificationYear($customErrors)
    {

        if (count($this->request['qualifications']) > 0) {

            $completionYearError = [];
            $currentYear = date("Y");
            foreach ($this->request['qualifications'] as $qualificationId) {

                $qualificationYear = $this->request["completionYear" . $qualificationId];

                if (!preg_match('/^\d{4}$/', $qualificationYear) || $qualificationYear < 1900 || $qualificationYear > $currentYear) {
                    $completionYearError[] = $qualificationYear . " is not a valid year";
                }
            }

            $customErrors['completionYearError'] = $completionYearError;
        }

        return $customErrors;
    }

    public function isValidQualificationYearSequence($customErrors)
    {

        if (count($this->request['qualifications']) > 1) {

            $prevYear = null;
            $qualificationsIds = $this->request['qualifications'];
            sort($qualificationsIds);

            foreach ($qualificationsIds as $qualification) {

                $completionYearInput = 'completionYear' . $qualification;
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

    public function checkGapAfterLastQualificationOrWorkExp()
    {
        $profileGapYears = 0;
        $maxQualificationYear = $this->getMaxQualificationYear();
        $maxWorkExpYear = $this->getMaxWorkExperienceYear();
        $maxYearValue = max($maxQualificationYear, $maxWorkExpYear);
        $currentYear = date('Y');

        if ($maxYearValue < $currentYear) {

            $profileGapYears = $currentYear - $maxYearValue;
        }

        return $profileGapYears;
    }

    public function getMaxQualificationYear()
    {
        $maxQualificationYear = 0;

        if (count($this->request['qualifications']) > 0) {

            $qualificationYearsArr = [];
            $maxQualificationYearMax = "";
            $qualificationsIds = $this->request['qualifications'];

            foreach ($qualificationsIds as $qualification) {

                $completionYearInput = 'completionYear' . $qualification;
                $qualificationYearsArr[] = $this->request[$completionYearInput];
            }

            $maxQualificationYear = max($qualificationYearsArr);
        }

        return $maxQualificationYear;
    }

    public function getMaxWorkExperienceYear()
    {
        $maxWorkExpYear = 0;

        if ($this->request['workExperienceStatus'] == true) {

            $maxWorkExpArr = $this->request['workExperience'];

            foreach ($maxWorkExpArr as $item) {
                $toDate = strtotime($item['to']);
                $yearTo = date('Y', $toDate);

                if ($yearTo > $maxWorkExpYear) {
                    $maxWorkExpYear = $yearTo;
                }
            }
        }

        return $maxWorkExpYear;
    }
}
