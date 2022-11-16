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
     * @return array|Application|Translator|string|null
     */
    public function all()
    {
        return $this->model->all();
    }
    
    
    /**
     * Create New Task In DB.
     * @param $data
     * @return array|Application|Translator|string|null
     */
    public function create(array $data)
    {
        $model = $this->model->create($data);
        
        return $model;
    }
    
    
    /**
     * Update Task Data
     * @return array|Application|Translator|string|null
     */
    public function show(int $id)
    {
        return $this->model->find($id);
    }
    
    
    /**
     * Update Task Data
     * @param $id
     * @param $data
     * @return array|Application|Translator|string|null
     */
    public function update(int $id, array $data)
    {
        $model = $this->model->find($id)->update($data);
        
        return $model;
    }
}
