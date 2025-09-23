<x-layouts.app :title="__('Dashboard')">
    <div class="relative flex h-full max-h-[92vh] w-full flex-col gap-4 rounded-xl">
        <div
            class="overflow-hidden min-h-[200px] overflow-y-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="px-4 my-4 text-xl font-semibold">Create Task</h2>
            <livewire:tasks.create />
        </div>

        <div
            class="flex flex-col flex-1 max-h-[600px] min-h-[300px]  gap-2 w-full overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h4 class="px-4 my-4 text-xl font-semibold">My Tasks</h4>
            <div
                class="flex h-full flex-col overflow-hidden border-t border-neutral-200 dark:border-neutral-700">
                <livewire:tasks.list />
            </div>
        </div>

        @livewire('tasks.edit')

        @livewire('tasks.delete')

        @if (session('status'))
            <div class="fixed mx-auto left-[70%] bottom-4 right-4 z-50">
                <flux:callout variant="success" icon="check-circle" heading="Success">
                    {{ session('status') }}
                </flux:callout>
            </div>
        @endif
    </div>
</x-layouts.app>
