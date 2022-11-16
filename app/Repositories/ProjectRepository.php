<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

class ProjectRepository
{

    /**
     * model
     *
     * @var Model
     */
    protected $model;

    public function __construct()
    {
        $this->model = new Project();
    }

    /**
     * Create New Project In DB.
     * @param $data
     * @return Model
     */
    public function all()
    {
        return $this->model->all();
    }
    
    
    /**
     * Create New Project In DB.
     * @param $data
     * @return Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    
    /**
     * Update Project Data
     * @return Model
     */
    public function show(int $id)
    {
        return $this->model->find($id);
    }
    
    
    /**
     * Update Project Data
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
     * Deleet Project
     * @param $id
     * @return void
     */
    public function delete(int $id)
    {
        $this->model->find($id)->delete();
    }
}
