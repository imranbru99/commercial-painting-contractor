<x-filament-panels::page>
    <form wire:submit="generate" class="space-y-6">
        {{ $this->form }}
        <x-filament::button type="submit">Generate</x-filament::button>
    </form>

    @if($output)
        <div class="mt-8 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-200">Output</h3>
            <pre class="whitespace-pre-wrap text-sm text-gray-800 dark:text-gray-100">{{ $output }}</pre>
        </div>
    @endif
</x-filament-panels::page>
