
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
                        <th class="px-4 py-3">{{ __('Service') }}</th>
                        <th class="px-4 py-3">{{ __('Price') }}</th>
                        <th class="px-4 py-3">{{ __('Stock') }}</th>
                        <th class="px-4 py-3">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($providers as $c)
                <tr class="text-gray-700 dark:text-gray-400 border-b-2">
                    <td class="px-4 py-3 text-sm">{{ $c->client_name }}</td>
                    <td class="px-4 py-3 text-sm">0.25$</td>
                    <td class="px-4 py-3 text-sm">250</td>
                    <td class="px-4 py-3">
                        <x-jet-button class="" wire:click="placeOrder({{ $c->id }})" > {{ __('Order') }} </x-jet-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
    
            {!! $providers->links() !!}
        </div>
    </div>
</div>
