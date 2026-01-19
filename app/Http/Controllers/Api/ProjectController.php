<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProjectApiResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);

        $projects = Project::orderByDesc('created_at')
            ->paginate($perPage);

        return ProjectApiResource::collection($projects);
    }

    public function show(Project $project){
        $project->load(['photos', 'techStacks']);

        return new ProjectApiResource($project);
    }
}
