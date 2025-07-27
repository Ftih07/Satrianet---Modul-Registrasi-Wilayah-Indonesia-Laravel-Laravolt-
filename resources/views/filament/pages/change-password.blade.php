<x-filament::page>
    {{ $this->form }}

    <div class="mt-4">
        <x-filament::button wire:click="changePassword" color="success">
            Ganti Password
        </x-filament::button>
    </div>
</x-filament::page>