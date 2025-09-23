<?php

use Livewire\Volt\Component;
use App\Models\Task;

new class extends Component {
    public string $title;
    public string $description;

    protected array $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ];

    public function createTask()
    {
        $this->validate();

        Task::create(['user_id' => auth()->id(), 'title' => $this->title, 'description' => $this->description ?? '']);

        $this->dispatch('refreshTasksList')->to('tasks.list');

        $this->reset(['title', 'description']);
        session()->flash('message', 'Task created successfully.');
    }
};

?>

<div class="p-4 flex flex-col w-full">
    <form wire:submit.prevent="createTask" class="flex flex-col gap-4">

        <flux:field>
            <flux:label badge="Required">Title</flux:label>
            <flux:input type="text" wire:model="title" required />
            <flux:error name="title" />
        </flux:field>

        <flux:field>
            <flux:label badge="Optional">Description</flux:label>
            <flux:textarea wire:model="description" rows="3" />
            <flux:error name="description" />
        </flux:field>

        <flux:button type="submit" variant="primary" class="self-start">Create Task</flux:button>
    </form>
</div>
