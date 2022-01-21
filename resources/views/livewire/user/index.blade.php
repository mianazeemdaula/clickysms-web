
<div class="p-6">
    <div class="flex justify-between items-center">
        <div class="mt-1">
            <x-jet-input id="searchText" class="block mt-1 w-full" placeholder="Search.." type="text" wire:model.debounce.800ms="searchText" />
            @error('searchText') <x-jet-input-error for="searchText" />@enderror
        </div>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs mt-4">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap mb-4">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">{{ __('Flag') }}</th>
                        <th class="px-4 py-3">{{ __('Dial Code') }}</th>
                        <th class="px-4 py-3">{{ __('Code') }}</th>
                        <th class="px-4 py-3">{{ __('name') }}</th>
                        <th class="px-4 py-3">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($countries as $c)
                <tr class="text-gray-700 dark:text-gray-400 border-b-2">
                    <td class="px-4 py-3 text-sm">
                        <svg width="35" height="35">       
                            <image xlink:href="{{ $c->flag }}" src="yourfallback.png" width="35" height="35"/>    
                        </svg>
                    </td>
                    <td class="px-4 py-3 text-sm">{{ $c->dial_code }}</td>
                    <td class="px-4 py-3 text-sm">{{ $c->iso_code }}</td>
                    <td class="px-4 py-3 text-sm">{{ $c->name }}</td>
                    <td class="px-4 py-3">
                        <x-jet-button class="" wire:click="goToService({{ $c->id }})" > {{ __('Select') }} </x-jet-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
    
            {!! $countries->links() !!}
        </div>
    </div>
</div>
