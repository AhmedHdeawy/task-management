<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"            =>  $this->id,
            "name"          =>  $this->name,
            "priority"      =>  $this->priority,
            "project_name"       => !empty($this->project) ? $this->project->name : null,
            "project_id"       =>  !empty($this->project) ? $this->project->id : null,
            'created_at'    =>  $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
