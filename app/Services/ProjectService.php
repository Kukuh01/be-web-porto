<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    public function getProjects(int $perPage = 4)
    {
        return Project::orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function getProjectDetail(Project $project)
    {
        return $project->load(['photos', 'techStacks']);
    }
}