<?php

namespace App\Repositories\Api;

use App\Interfaces\Api\GenerateChecklistInterface;
use Illuminate\Support\Facades\DB;

class GenerateChecklistRepository implements GenerateChecklistInterface
{
    public function getGroupDocuments()
    {
        $documentGroups = DB::table('document_group')
            ->select(
                'document_group.id as document_group_id',
                'document_group.title as document_group_title',
                'document.id as document_id',
                'document.title as document_title'
            )
            ->join('common_document', 'document_group.id', '=', 'common_document.document_group_id')
            ->join('document', 'common_document.document_id', '=', 'document.id')
            ->orderBy('document_group.id')
            ->get()
            ->groupBy('document_group_id')
            ->map(function ($group) {
                return [
                    'document_group_id' => $group->first()->document_group_id,
                    'document_group_title' => $group->first()->document_group_title,
                    'document' => $group->map(function ($doc) {
                        return [
                            'document_id' => $doc->document_id,
                            'document_title' => $doc->document_title,
                        ];
                    })->toArray(),
                ];
            })->values()->toArray();


        return $documentGroups;
    }
}
