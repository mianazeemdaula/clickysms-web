<div>    
    <div class="p-6">
        <div class="flex justify-between items-center">
            <div class="mt-1">
                <x-jet-input id="searchText" class="block mt-1 w-full" placeholder="Search.." type="text" wire:model.debounce.800ms="searchText" />
                @error('searchText') <x-jet-input-error for="searchText" />@enderror
            </div>
            <div class="mt-1">
                <x-jet-secondary-button wire:click="openCreate" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </x-jet-secondary-button>
            </div>
        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs mt-4">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap mb-4">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">{{ __('Name') }}</th>
                            <th class="px-4 py-3">{{ __('Client Name') }}</th>
                            <th class="px-4 py-3">{{ __('Currency') }}</th>
                            <th class="px-4 py-3">{{ __('Charges') }}</th>
                            <th class="px-4 py-3">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($providers as $c)
                    <tr class="text-gray-700 dark:text-gray-400 border-b-2">
                        <td class="px-4 py-3 text-sm">{{ $c->name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $c->client_name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $c->currency }}</td>
                        <td class="px-4 py-3 text-sm">${{ $c->charges }}</td>
                        <td class="px-4 py-3">
                            <x-jet-button class="" wire:click="statusUpdate({{ $c->id}})" > @if($c->active) {{ __('Active') }} @else  {{ __('Inactive') }} @endif</x-jet-button>
                            <x-jet-button class="" wire:click="editProvider({{ $c->id }})" > {{ __('Edit') }} </x-jet-button>
                            <x-jet-button class="" wire:click="getBalance({{ $c->id }})" > {{ __('Balance') }} </x-jet-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                {!! $providers->links() !!}
            </div>
        </div>
    </div>
     <!-- Create Provider Modal -->
     <x-jet-dialog-modal wire:model="isCreateModelOpen" >
        <x-slot name="title">
            {{ __('Create Provider') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-1">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.defer="provider.name"  />
                @error('provider.name') <x-jet-input-error for="provider.name" />@enderror
            </div>

            <div class="mt-1">
                <x-jet-label for="client_name" value="{{ __('Client Name') }}" />
                <x-jet-input id="client_name" class="block mt-1 w-full" type="text" wire:model.defer="provider.client_name"  />
                @error('provider.client_name') <x-jet-input-error for="provider.client_name" />@enderror
            </div>

            <div class="mt-1">
                <x-jet-label for="currency" value="{{ __('Currency') }}" />
                <x-jet-input id="currency" class="block mt-1 w-full" type="text" wire:model.defer="provider.currency"  />
                @error('provider.currency') <x-jet-input-error for="provider.currency" />@enderror
            </div>
            
            <div class="mt-1">
                <x-jet-label for="charges" value="{{ __('Charges') }}" />
                <x-jet-input id="charges" class="block mt-1 w-full" type="number" wire:model.defer="provider.charges" />
                @error('provider.charges') <x-jet-input-error for="provider.charges" />@enderror
            </div>

            <div class="mt-1">
                <x-jet-label for="api_key" value="{{ __('API Key') }}" />
                <x-jet-input id="api_key" class="block mt-1 w-full" type="text" wire:model.defer="provider.api_key" />
                @error('provider.api_key') <x-jet-input-error for="provider.api_key" />@enderror
            </div>
            
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('isCreateModelOpen')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="createProvider" wire:loading.attr="disabled">
                {{ __('Create Provider') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Edit Provider Modal -->
    <x-jet-dialog-modal wire:model="isEditModelOpen" >
        <x-slot name="title">
            {{ __('Edit Provider') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-1">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.defer="provider.name"  />
                @error('provider.name') <x-jet-input-error for="provider.name" />@enderror
            </div>

            <div class="mt-1">
                <x-jet-label for="client_name" value="{{ __('Client Name') }}" />
                <x-jet-input id="client_name" class="block mt-1 w-full" type="text" wire:model.defer="provider.client_name"  />
                @error('provider.client_name') <x-jet-input-error for="provider.client_name" />@enderror
            </div>

            <div class="mt-1">
                <x-jet-label for="currency" value="{{ __('Currency') }}" />
                <x-jet-input id="currency" class="block mt-1 w-full" type="text" wire:model.defer="provider.currency"  />
                @error('provider.currency') <x-jet-input-error for="provider.currency" />@enderror
            </div>
            
            <div class="mt-1">
                <x-jet-label for="charges" value="{{ __('Charges') }}" />
                <x-jet-input id="charges" class="block mt-1 w-full" type="number" wire:model.defer="provider.charges" />
                @error('provider.charges') <x-jet-input-error for="provider.charges" />@enderror
            </div>

            <div class="mt-1">
                <x-jet-label for="api_key" value="{{ __('API Key') }}" />
                <x-jet-input id="api_key" class="block mt-1 w-full" type="text" wire:model.defer="provider.api_key" />
                @error('provider.api_key') <x-jet-input-error for="provider.api_key" />@enderror
            </div>
            
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('isEditModelOpen')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="updateProvider" wire:loading.attr="disabled">
                {{ __('Update Provider') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>