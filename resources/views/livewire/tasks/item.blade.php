<?php

use Livewire\Volt\Component;
use App\Models\Task;

new class extends Component {
    public Task $task;
    protected $listeners = ['refreshTask' => '$refresh'];

    public function changeStatus(bool $isCompleted): void
    {
        $this->task->is_completed = $isCompleted;
        $this->task->save();

        $this->dispatch('refreshTask')->self();
    }

    public function editTask(): void
    {
        $this->dispatch('openModal', ['task' => $this->task])->to('tasks.edit');
    }

    public function deleteTask(): void
    {
        $this->dispatch('openModal', ['task' => $this->task])->to('tasks.delete');
    }

    public function mount($task): void
    {
        $this->task = $task;
    }
};

?>

<div>
    <flux:callout
        :class="$task->is_completed ? 'border-green-500/30 bg-green-50/10' : 'border-yellow-500/30 bg-yellow-50/10'"
        inline="true">

        <x-slot name="actions">
            <div class="flex flex-col w-full gap-2">
                <flux:switch
                    :checked="$task->is_completed"
                    wire:change="changeStatus($event.target.checked)"
                    label="Completed"
                    label-position="after"
                    size="sm"
                />
                <button
                    type="button"
                    class="text-sm text-amber-500 border border-amber-500 rounded-md px-2 py-1 hover:bg-amber-500 hover:text-white transition"
                    wire:click="editTask()"
                >
                    Edit
                </button>

                <button
                    type="button"
                    class="text-sm text-red-500 border border-red-500 rounded-md px-2 py-1 hover:bg-red-500 hover:text-white transition"
                    wire:click="deleteTask()"
                >
                    Delete
                </button>
            </div>
        </x-slot>

        <flux:callout.heading class="self-start">
            <x-slot name="icon">
                @if( $task->is_completed )
                    <flux:icon.clipboard-document-check class="h-6 w-6 text-green-500" />
                @else
                    <flux:icon.clipboard-document-list class="h-6 w-6 text-yellow-500" />
                @endif
            </x-slot>

            {{ $task->title }}
        </flux:callout.heading>
        <flux:callout.text
            class="text-sm opacity-75">{{ $task->created_at->format('H:i A | M d, Y') }}</flux:callout.text>

        @if( $task->description )
            <flux:callout.text>{{ $task->description }}</flux:callout.text>
        @endif
    </flux:callout>
</div>
