<?php

use Livewire\Volt\Component;
use App\Models\Task;

new class extends Component {
    public $tasks;
    protected $listeners = ['refreshTasksList' => 'mount'];

    public function mount()
    {
        $this->tasks = Task::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
    }

    public function render(): mixed
    {
        return view('livewire.tasks.list');
    }
};

?>

<div class="h-full">
    @if ($tasks->isEmpty())
        <p>No tasks available.</p>
    @else
        <div class="h-full overflow-y-auto p-4">
            <ul class="space-y-4">
                @foreach ($tasks as $task)
                    <li class="p-4 border border-neutral-200 dark:border-neutral-700 rounded-lg">
                        <h3 class="text-xl font-semibold">{{ $task->title }}</h3>
                        @if ($task->description)
                            <p class="mt-2 text-neutral-600 dark:text-neutral-400">{{ $task->description }}</p>
                        @endif
                        <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-500">Created
                            at: {{ $task->created_at->format('M d, Y') }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
