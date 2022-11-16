<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Traits\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        return $this->jsonResponse(200, "Projects Retrieved Successfully.", ProjectResource::collection($projects));
    }


    /**
     * Get All Projects.
     * @param  Project $project
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Project $project)
    {
        $projects = $this->projectRepository->all();
        return $this->jsonResponse(200, "Project Retrieved Successfully.", ProjectResource::collection($projects));
    }

    /**
     * store
     *
     * @param  CreateProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProjectRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['name']);

            $project = $this->projectRepository->create($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error("Error While Creating New Project", ['data' => $request->all(), 'msg' => $th->getMessage(), 'trace' => $th->__toString()]);

            throw new \Exception("Error Processing Request", 1);
            
        }

        return $this->jsonResponse(200, "Project Created Successfully.", new ProjectResource($project));
        
    }

    /**
     * Update
     *
     * @param  Project $project
     * @param  UpdateProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Project $project, UpdateProjectRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['name']);

            $project = $this->projectRepository->update($project->id, $data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error("Error While Updating a Project", [ 'id' => $project->id, 'msg' => $th->getMessage(), 'trace' => $th->__toString()]);

            throw new \Exception("Error Processing Request", 1);
        }

        return $this->jsonResponse(200, "Project Updated Successfully.", new ProjectResource($project));
        
    }
   
   
    /**
     * Delete
     *
     * @param  UpdateProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Project $project)
    {
        DB::beginTransaction();
        try {
            $project = $this->projectRepository->delete($project->id);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error("Error While Deleting a Project", ['id' => $project->id, 'msg' => $th->getMessage(), 'trace' => $th->__toString()]);

            throw new \Exception("Error Processing Request", 1);
        }

        return $this->jsonResponse(200, "Project Deleted Successfully.");
        
    }
}
