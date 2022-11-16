<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Traits\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Repositories\ProjectRepository;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    use JsonResponse;

    /**
     * This Is Variable For Article Repository For Using Here.
     * @var $projectRepository
     */
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Get All Projects.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $projects = $this->projectRepository->all();
        return $this->jsonResponse(200, __('Projects Retrieved Successfully.'), ProjectResource::collection($projects));
    }

    /**
     * store
     *
     * @param  CreateProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProjectRequest $request)
    {
        $data = $request->only(['name']);

        $project = $this->projectRepository->create($data);

        return $this->jsonResponse(200, __('Projects Retrieved Successfully.'), new ProjectResource($project));
        
    }
    
    
    /**
     * Update
     *
     * @param  UpdateProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Project $project, UpdateProjectRequest $request)
    {
        $data = $request->only(['name']);

        $project = $this->projectRepository->update($project->id, $data);

        return $this->jsonResponse(200, __('Projects Retrieved Successfully.'), new ProjectResource($project));
        
    }
}
