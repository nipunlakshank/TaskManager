<?php

use Livewire\Volt\Component;
use App\Models\Task;

new class extends Component {
    public ?Task $task;
    public string $title = '';
    public string $description = '';

    protected array $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ];

    protected $listeners = ['openModal' => 'showModal'];

    public function showModal(Task $task): void
    {
        $this->task = $task;
        $this->title = $task->title;
        $this->description = $task->description;

        Flux::modal('edit-task')->show();
    }

    public function updateTask(): void
    {
        $this->validate();

        if ($this->task) {
            $this->task->update([
                'title' => $this->title,
                'description' => $this->description ?? '',
            ]);

            $this->dispatch('refreshTask')->to('tasks.item');
            Flux::modals()->close();
        }
    }
};

?>

<div>
    <flux:modal name="edit-task" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update task</flux:heading>
            </div>
            <flux:input wire:model="title" label="Title" placeholder="Title" />
            <flux:textarea wire:model="description" label="Description" placeholder="Title" />
            <div class="flex">
                <flux:spacer />
                <flux:button wire:click="updateTask" type="submit" variant="primary">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
