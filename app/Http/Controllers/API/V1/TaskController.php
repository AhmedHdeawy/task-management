<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Task;
use App\Http\Traits\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Repositories\TaskRepository;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    use JsonResponse;

    /**
     * This Is Variable For Article Repository For Using Here.
     * @var $projectRepository
     */
    protected $projectRepository;

    public function __construct(TaskRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Get All Tasks.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $projects = $this->projectRepository->all();
        return $this->jsonResponse(200, __('Tasks Retrieved Successfully.'), TaskResource::collection($projects));
    }
    
    
    /**
     * Get All Tasks.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Task $project)
    {
        $projects = $this->projectRepository->all();
        return $this->jsonResponse(200, __('Tasks Retrieved Successfully.'), TaskResource::collection($projects));
    }

    /**
     * store
     *
     * @param  CreateTaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateTaskRequest $request)
    {
        $data = $request->only(['name']);

        $project = $this->projectRepository->create($data);

        return $this->jsonResponse(200, __('Tasks Retrieved Successfully.'), new TaskResource($project));
        
    }
    
    
    /**
     * Update
     *
     * @param  UpdateTaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Task $project, UpdateTaskRequest $request)
    {
        $data = $request->only(['name']);

        $project = $this->projectRepository->update($project->id, $data);

        return $this->jsonResponse(200, __('Tasks Retrieved Successfully.'), new TaskResource($project));
        
    }
}
