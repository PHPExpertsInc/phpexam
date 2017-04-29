<?php

namespace App\Models\Repositories;

use App\Models\Submission;
use Illuminate\Support\Facades\File;

class SubmissionRepository
{
    public static function listGradedSubmissions()
    {
        $gradedFiles = [];

        foreach (File::files(Submission::getSubmissionsPath(true)) as $file) {
            $gradedFiles[] = basename($file, '.md');
        }

        return $gradedFiles;
    }

    public static function listUngradedSubmissions()
    {
        $ungradedFiles = [];
        foreach (File::files(Submission::getSubmissionsPath(false)) as $file) {
            $ungradedFiles[] = basename($file, '.md');
        }

        return $ungradedFiles;
    }
}
