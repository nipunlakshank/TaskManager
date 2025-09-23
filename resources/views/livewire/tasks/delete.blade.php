<?php

use Livewire\Volt\Component;
use App\Models\Task;

new class extends Component {
    public Task $task;
    protected $listeners = ['openModal' => 'showModal'];

    public function showModal(Task $task): void
    {
        $this->task = $task;
        Flux::modal('delete-task')->show();
    }

    public function deleteTask(): void
    {
        $this->task->delete();
        $this->dispatch('refreshTasksList')->to('tasks.list');
        Flux::modals()->close();
    }
}; ?>

<div>
    <flux:modal name="delete-task" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete task?</flux:heading>
                <flux:text class="mt-2">
                    <p>You're about to delete this task.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="deleteTask">Delete task</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
