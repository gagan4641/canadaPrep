<?php

namespace App\Interfaces\Api;

interface GenerateChecklistInterface 
{
    public function getGroupDocuments($request, $profileGap);
}