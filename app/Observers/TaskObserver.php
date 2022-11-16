<?php

namespace App\Observers;

use App\Models\Task;


class TaskObserver
{
    public function creating(Task $task)
    {
        if (is_null($task->priority)) {
            $task->priority = Task::where('project_id', $task->project_id)->max('priority') + 1;
            return;
        }

        $lowerPriority = Task::where('project_id', $task->project_id)
            ->where('priority', '>=', $task->priority)
            ->get();

        foreach ($lowerPriority as $lowerPriorityTask) {
            $lowerPriorityTask->priority = $lowerPriorityTask->priority + 1;
            $lowerPriorityTask->saveQuietly();
        }
    }

    public function updating(Task $task)
    {
        if ($task->getOriginal('priority') > $task->priority) {
            $priorityRange = [
                $task->priority, $task->getOriginal('priority')
            ];
        } else {
            $priorityRange = [
                $task->getOriginal('priority'), $task->priority
            ];
        }

        $lowerPriorityTasks = Task::where('project_id', $task->project_id)
            ->whereBetween('priority', $priorityRange)
            ->where('id', '!=', $task->id)  // Exclude current task
            ->get();

        foreach ($lowerPriorityTasks as $lowerPriorityTask) {
            if ($task->getOriginal('priority') < $task->priority) {
                $lowerPriorityTask->priority = $lowerPriorityTask->priority - 1;
            } else {
                $lowerPriorityTask->priority = $lowerPriorityTask->priority + 1;
            }
            $lowerPriorityTask->saveQuietly();
        }
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        $lowerPriorityTasks = Task::where('project_id', $task->project_id)
            ->where('priority', '>', $task->priority)
            ->get();

        foreach ($lowerPriorityTasks as $lowerPriorityTask) {
            $lowerPriorityTask->priority = $lowerPriorityTask->priority - 1;
            $lowerPriorityTask->saveQuietly();
        }
    }
}
