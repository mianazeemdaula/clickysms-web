
<div class="p-6">
    <div class="w-full overflow-hidden rounded-lg shadow-xs mt-4">
        <div class="w-full overflow-x-auto">
            {{ $response2 }}
            <table class="w-full whitespace-no-wrap mb-4">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">{{ __('Service') }}</th>
                        <th class="px-4 py-3">{{ __('Phone') }}</th>
                        <th class="px-4 py-3">{{ __('Price') }}</th>
                        <th class="px-4 py-3">{{ __('Remaining Time') }}</th>
                        <th class="px-4 py-3">{{ __('SMS CODE') }}</th>
                        <th class="px-4 py-3">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400 border-b-2">
                        <td class="px-4 py-3 text-sm">{{ $order->service->name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $order->mobile }}</td>
                        <td class="px-4 py-3 text-sm">${{ $order->price }}</td>
                        <td class="px-4 py-3 text-sm">
                            @if ($order->status == 'WAITING' || $order->status == 'READY')
                                {{ \Carbon\Carbon::parse($this->order->expire_time)->diffInMinutes(\Carbon\Carbon::parse($this->order->crated_at)) }} minutes</td>
                            @else
                                EXPIRE
                            @endif 
                        <td class="px-4 py-3 text-sm"> 
                            @if ($order->code == null)
                                <img src="https://sms-activate.org/assets/ico/loading.gif" alt="" srcset="">
                            @else
                            {{ $order->code }}
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($order->status == 'READY') <x-jet-button wire:loading.attr="disabled"  class="" wire:click="setStatus(1)" > {{ __('Ready') }} </x-jet-button> @endif
                            @if($order->status == 'WAITING') <x-jet-button wire:loading.attr="disabled"  class="" wire:click="setStatus(8)" > {{ __('Cancel') }} </x-jet-button> @endif
                            @if($order->status == 'CANCELED') {{ __('Cancel/Expire') }}  @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            var intervalId;
            if(@this.status == 'READY' || @this.status == 'WAITING'){
                intervalId = window.setInterval(function(){
                    @this.checkSms();
                }, 10000);
            }
            @this.on('stopInterval', () => {
                clearInterval(intervalId);
            })
        })
    </script>
</div>
