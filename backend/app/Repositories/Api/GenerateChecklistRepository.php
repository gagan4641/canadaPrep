<?php

namespace App\Repositories\Api;

use App\Interfaces\Api\GenerateChecklistInterface;
use Illuminate\Support\Facades\DB;

class GenerateChecklistRepository implements GenerateChecklistInterface
{
    public function getGroupDocuments($request)
    {
        // Fetch document groups with associated documents
        $documentGroups = DB::table('document_group')
            ->select(
                'document_group.id as document_group_id',
                'document_group.title as document_group_title',
                'document.id as document_id',
                'document.title as document_title'
            )
            ->leftJoin('common_document', 'document_group.id', '=', 'common_document.document_group_id')
            ->leftJoin('document', 'common_document.document_id', '=', 'document.id')
            ->where('document_group.status', true)
            ->orderBy('document_group.id')
            ->get()
            ->groupBy('document_group_id')
            ->map(function ($group) {
                return [
                    'document_group_id' => $group->first()->document_group_id,
                    'document_group_title' => $group->first()->document_group_title,
                    'documents' => $group->map(function ($doc) {
                        return [
                            'document_id' => $doc->document_id,
                            'document_title' => $doc->document_title,
                        ];
                    })->toArray(),
                ];
            })->values()->toArray();


        foreach ($documentGroups as &$group) {

            // Fetch qualifications documents
            $group['qualifications'] = $this->getQualificationsUnderDocumentGroup($group['document_group_id'], $request['qualifications']);

            // Fetch workExperience documents
            if ($request['workExperienceStatus'] == true) {

                $workExperienceDocuments = $this->fetchWorkExperienceDocuments($group['document_group_id']);

                $group['workExperience'] = $workExperienceDocuments->map(function ($item) {
                    return (array) $item;
                })->toArray();
            }

            // Fetch marital status documents
            $group['maritalStatus'] = $this->fetchMaritalStatusDocuments($group['document_group_id'], $request['maritalStatus']);

        }

        return $documentGroups;
    }

    public function getQualificationsUnderDocumentGroup($documentGroupId, $checkedQualifications)
    {
        $qualifications = DB::table('qualification')
            ->select(
                'qualification.id as qualification_id',
                'qualification.title as qualification_title',
                'qualification.status',
                'document.id as document_id',
                'document.title as document_title'
            )
            ->where('qualification.document_group_id', $documentGroupId)
            ->whereIn('qualification.id', $checkedQualifications)
            ->where('qualification.status', true)
            ->where('document.status', true)
            ->leftJoin('qualification_document', 'qualification.id', '=', 'qualification_document.qualification_id')
            ->leftJoin('document', 'qualification_document.document_id', '=', 'document.id')
            ->get()
            ->groupBy('qualification_id')
            ->map(function ($qualificationGroup) {
                return [
                    'qualification_id' => $qualificationGroup->first()->qualification_id,
                    'qualification_title' => $qualificationGroup->first()->qualification_title,
                    'status' => $qualificationGroup->first()->status,
                    'documents' => $qualificationGroup->map(function ($doc) {
                        return [
                            'document_id' => $doc->document_id,
                            'document_title' => $doc->document_title,
                        ];
                    })->toArray(),
                ];
            })->values()->toArray();

        return $qualifications;
    }

    protected function fetchWorkExperienceDocuments($documentGroupId)
    {
        $workExperienceDocuments = DB::table('work_experience_document')
            ->select(
                'work_experience_document.document_id',
                'work_experience_document.document_group_id',
                'work_experience_document.status',
                'document.status as document_status',
                'work_experience_document.created_at as created_at',
                'work_experience_document.updated_at as updated_at',
                'document.title as document_title',
                'document.created_at as document_created_at',
                'document.updated_at as document_updated_at'
            )
            ->where('work_experience_document.document_group_id', $documentGroupId)
            ->where('work_experience_document.status', true)
            ->where('document.status', true)
            ->leftJoin('document', 'work_experience_document.document_id', '=', 'document.id')
            ->get();

        return $workExperienceDocuments;
    }

    public function fetchMaritalStatusDocuments($documentGroupId, $maritalStatusId)
    {
        $maritalStatusDocs = DB::table('marital_status')
            ->select(
                'marital_status.id as marital_status_id',
                'marital_status.title as marital_status_title',
                'marital_status.status',
                'document.id as document_id',
                'document.title as document_title'
            )
            ->where('marital_status.document_group_id', $documentGroupId)
            ->where('marital_status.id', $maritalStatusId)
            ->where('marital_status.status', true)
            ->where('marital_status_document.status', true)
            ->where('document.status', true)
            ->leftJoin('marital_status_document', 'marital_status.id', '=', 'marital_status_document.marital_status_id')
            ->leftJoin('document', 'marital_status_document.document_id', '=', 'document.id')
            ->get()
            ->groupBy('marital_status_id')
            ->map(function ($marital_statusGroup) {
                return [
                    'marital_status_id' => $marital_statusGroup->first()->marital_status_id,
                    'marital_status_title' => $marital_statusGroup->first()->marital_status_title,
                    'status' => $marital_statusGroup->first()->status,
                    'documents' => $marital_statusGroup->map(function ($doc) {
                        return [
                            'document_id' => $doc->document_id,
                            'document_title' => $doc->document_title,
                        ];
                    })->toArray(),
                ];
            })->values()->toArray();

        return $maritalStatusDocs;
    }
}
