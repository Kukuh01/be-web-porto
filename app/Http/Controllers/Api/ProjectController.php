<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProjectApiResource;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectService $projectService
    ) {}

    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 5);

        $projects = $this->projectService->getProjects($perPage);

        return ProjectApiResource::collection($projects);
    }

    public function show(Project $project)
    {
        $project = $this->projectService->getProjectDetail($project);

        return new ProjectApiResource($project);
    }
}
