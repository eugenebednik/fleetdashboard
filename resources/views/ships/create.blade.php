<x-jet-dialog-modal>
    <x-slot name="title">
        {{ __('Create or update a ship') }}
    </x-slot>

    <x-slot name="content">
        <form>
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mb-6">
                    <x-jet-label for="manufacturer" value=" {{ __('Manufacturer') }}" />
                    <select id="manufacturer" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="manufacturer">
                        <option value="0">{{ __('Make a selection...') }}</option>
                        @foreach($manufacturers as $manufacturer)
                        <option value="{{$manufacturer->id}}">{{ $manufacturer->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="manufacturer" class="mt-2" />
                </div>
                <div class="mb-6">
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input type="text" id="name" placeholder="Enter Name" wire:model="name" />
                    <x-jet-input-error for="name" class="mt-2" />

                </div>
                <div class="mb-6">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <textarea class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" id="description" wire:model="description" placeholder="Enter Description"></textarea>
                    <x-jet-input-error for="description" class="mt-2" />
                </div>
            </div>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-jet-button wire:click.prevent="store()">Save</x-jet-button>
        <x-jet-button wire:click="closeModal()">Cancel</x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
