<x-layouts.app :title="__('Dashboard')">
    <div
        x-data="{ open: false }"
        class="relative flex h-full max-h-[92vh] w-full flex-col gap-4 rounded-xl">
        <div
            x-bind:class="{ 'min-h-[200px]': open, '': !open }"
            class="overflow-hidden overflow-y-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="flex justify-between border-b border-neutral-200 dark:border-neutral-700">
                <h2 class="my-4 px-4 text-xl font-semibold">Create Task</h2>
                <flux:button
                    icon="chevron-down"
                    variant="ghost"
                    class="m-4 p-2"
                    x-bind:class="{ 'rotate-180': open, 'rotate-0': !open }"
                    aria-haspopup="true"
                    aria-controls="create-task-form"
                    aria-expanded="open ? 'true' : 'false'"
                    aria-label="open ? 'Close create task form' : 'Open create task form'"
                    id="create-task-button"
                    x-on:click="open = !open"
                    x-bind:aria-expanded="open.toString()"
                    x-bind:aria-label="open ? 'Close create task form' : 'Open create task form'" />
            </div>
            <div x-show="open" id="create-task-form" aria-labelledby="create-task-button">
                <livewire:tasks.create />
            </div>
        </div>

        <div
            class="flex min-h-[300px] w-full flex-1 flex-col gap-2 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h4 class="my-4 px-4 text-xl font-semibold">My Tasks</h4>
            <div
                class="flex h-full flex-col overflow-hidden border-t border-neutral-200 dark:border-neutral-700">
                <livewire:tasks.list />
            </div>
        </div>

        @livewire('tasks.edit')

        @livewire('tasks.delete')

        @if (session('status'))
            <div class="fixed bottom-4 left-[70%] right-4 z-50 mx-auto">
                <flux:callout variant="success" icon="check-circle" heading="Success">
                    {{ session('status') }}
                </flux:callout>
            </div>
        @endif
    </div>
</x-layouts.app>
