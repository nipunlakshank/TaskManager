<?php

use Livewire\Volt\Component;
use App\Models\Task;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    protected $listeners = ['refreshTasksList' => '$refresh'];

    public function with(): array
    {
        return [
            'tasks' => Task::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(5),
        ];
    }
};

?>

<div class="relative flex flex-col justify-between w-full overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
    <div class="flex h-full w-full flex-col overflow-y-auto p-4">
        @if ($tasks->isEmpty())
            <p>No tasks available.</p>
        @else
            <ul class="flex w-full flex-col gap-2" wire:key="tasks-list">
                @foreach ($tasks as $task)
                    @livewire('tasks.item', ['task' => $task], key($task->id))
                @endforeach
            </ul>
        @endif
    </div>
    <div
        class="w-full p-4  border-t border-neutral-200 py-2 dark:border-neutral-700">
        {{ $tasks->links() }}
    </div>
</div>
