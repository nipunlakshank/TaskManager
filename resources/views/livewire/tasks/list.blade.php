<?php

use Livewire\Volt\Component;
use App\Models\Task;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    protected $listeners = ['refreshTasksList' => '$refresh'];

    public function with()
    {
        return ['tasks' => Task::where('user_id', auth()->id())->orderBy('created_at', 'desc')->paginate(5)];
    }
};

?>

<div class="relative flex flex-col w-full h-full overflow-y-auto p-4">
    @if ($tasks->isEmpty())
        <p>No tasks available.</p>
    @else
        <ul class="flex flex-col gap-2 w-full">
            @foreach ($tasks as $task)
                <li class="p-4 border border-neutral-200 dark:border-neutral-700 rounded-lg">
                    <h3 class="text-lg font-semibold">{{ $task->title }}</h3>
                    @if ($task->description)
                        <p class="mt-2 truncate text-neutral-600 dark:text-neutral-400">{{ $task->description }}</p>
                    @endif
                    <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-500">Created
                        at: {{ $task->created_at->format('H:i A M d, Y') }}</p>
                </li>
            @endforeach
        </ul>
        <div
            class="sticky -bottom-4 mt-2 bg-white dark:bg-neutral-800 py-2 border-t border-neutral-200 dark:border-neutral-700">
            {{ $tasks->links() }}
        </div>
    @endif
</div>
