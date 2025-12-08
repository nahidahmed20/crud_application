<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskService
{
    public function listForUser($user, array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        $query = Task::where('user_id', $user->id);

        if (isset($filters['completed'])) {
            $query->where('completed', (bool)$filters['completed']);
        }

        return $query->latest()->paginate($perPage);
    }

    public function createForUser($user, array $data): Task
    {
        $data['user_id'] = $user->id;
        return Task::create($data);
    }

    public function update(Task $task, array $data): Task
    {
        $task->update($data);
        return $task;
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }
}
