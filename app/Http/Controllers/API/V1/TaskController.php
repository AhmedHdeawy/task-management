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
     * store
     *
     * @param  CreateTaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateTaskRequest $request)
    {
        $data = $request->only(['name']);

        $task = $this->taskRepository->create($data);

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
        $data = $request->only(['name']);

        $task = $this->taskRepository->update($task->id, $data);

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
        $task = $this->taskRepository->delete($task->id);

        return $this->jsonResponse(200, "Task Deleted Successfully.");
    }
}
