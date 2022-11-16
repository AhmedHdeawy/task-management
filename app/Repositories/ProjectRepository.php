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
     * @return array|Application|Translator|string|null
     */
    public function all()
    {
        return $this->model->all();
    }
    
    
    /**
     * Create New Project In DB.
     * @param $data
     * @return array|Application|Translator|string|null
     */
    public function create(array $data)
    {
        $model = $this->model->create($data);
        
        return $model;
    }
    
    
    /**
     * Update Project Data
     * @param $data
     * @return array|Application|Translator|string|null
     */
    public function update(int $id, array $data)
    {
        $model = $this->model->find($id)->update($data);
        
        return $model;
    }
}
