<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Task;
use App\Models\Project;
use App\Http\Traits\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
     * @var $taskRepository
     */
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Get All Tasks.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tasks = $this->taskRepository->all();
        return $this->jsonResponse(200, "Tasks Retrieved Successfully.", TaskResource::collection($tasks));
    }


    /**
     * Get All Tasks.
     * @param  Task $task
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Task $task)
    {
        $tasks = $this->taskRepository->all();
        return $this->jsonResponse(200, "Task Retrieved Successfully.", TaskResource::collection($tasks));
    }
    
    
    /**
     * Get All Tasks.
     * @param  Project $task
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function tasksByProjects(Project $project)
    {
        $tasks = $this->taskRepository->allByProject($project->id);

        return $this->jsonResponse(200, "Task Retrieved Successfully.", ['tasks' => TaskResource::collection($tasks), 'project' => $project]);
    }

    /**
     * store
     *
     * @param  CreateTaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateTaskRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['name', 'project_id', 'priority']);

            $task = $this->taskRepository->create($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error("Error While Creating New Task", ['data' => $request->all(), 'msg' => $th->getMessage(), 'trace' => $th->__toString()]);

            throw new \Exception("Error Processing Request", 1);
        }

        return $this->jsonResponse(200, "Task Created Successfully.", new TaskResource($task));
    }

    /**
     * Update
     *
     * @param  Task $task
     * @param  UpdateTaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Task $task, UpdateTaskRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['name', 'project_id', 'priority']);

            $task = $this->taskRepository->update($task->id, $data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error("Error While Updating a Task", ['id' => $task->id, 'msg' => $th->getMessage(), 'trace' => $th->__toString()]);

            throw new \Exception("Error Processing Request", 1);
        }

        return $this->jsonResponse(200, "Task Updated Successfully.", new TaskResource($task));
    }


    /**
     * Delete
     *
     * @param  UpdateTaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Task $task)
    {
        DB::beginTransaction();
        try {
            $this->taskRepository->delete($task->id);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error("Error While Deleting a Task", ['id' => $task->id, 'msg' => $th->getMessage(), 'trace' => $th->__toString()]);

            throw new \Exception("Error Processing Request", 1);
        }

        return $this->jsonResponse(200, "Task Deleted Successfully.");
    }
}
