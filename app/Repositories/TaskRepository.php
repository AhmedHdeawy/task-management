<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;

class TaskRepository
{

    /**
     * model
     *
     * @var Model
     */
    protected $model;

    public function __construct()
    {
        $this->model = new Task();
    }

    /**
     * Create New Task In DB.
     * @param $data
     * @return Model
     */
    public function all()
    {
        return $this->model->orderBy('priority')->get();
    }
    
    
    /**
     * Create New Task In DB.
     * @param $data
     * @return Model
     */
    public function allByProject($id)
    {
        return $this->model->where('project_id', $id)->orderBy('priority')->get();
    }


    /**
     * Create New Task In DB.
     * @param $data
     * @return Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update Task Data
     * @return Model
     */
    public function show(int $id)
    {
        return $this->model->find($id);
    }


    /**
     * Update Task Data
     * @param $id
     * @param $data
     * @return Model
     */
    public function update(int $id, array $data)
    {
        $this->model->find($id)->update($data);

        return $this->model->find($id);
    }


    /**
     * Deleet Task
     * @param $id
     * @return void
     */
    public function delete(int $id)
    {
        $this->model->find($id)->delete();
    }
    
    
    /**
     * Deleet Task
     * @param $id
     * @return void
     */
    public function deleteForProjects(int $id)
    {
        $this->model->where('project_id', $id)->delete();
    }
}
