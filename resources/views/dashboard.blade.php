<x-layouts.app :title="__('Dashboard')">
    <div class="relative flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div
            class=" overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <livewire:tasks.create />
        </div>

        <div
            class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-2xl font-bold my-4 px-4">My Tasks</h2>
            <div
                class="flex h-full max-h-[600px] flex-col overflow-hidden border-t  border-neutral-200 dark:border-neutral-700">
                <livewire:tasks.list />
            </div>
        </div>

        @if (session()->has('message'))
            <div class="absolute bottom-4 right-4 z-50">
                <flux:callout variant="success" icon="check-circle" heading="Success">
                    {{ session('message') }}
                </flux:callout>
            </div>
        @endif
    </div>
</x-layouts.app>
