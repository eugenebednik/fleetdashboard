<x-jet-dialog-modal>
    <x-slot name="title">
        {{ __('Create or update manufacturer') }}
    </x-slot>

    <x-slot name="content">
        <form>
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="mb-6">
                <x-jet-label for="tag" value=" {{ __('Tag') }}" />
                <x-jet-input type="text" id="tag" placeholder="{{__('Enter tag...')}}" wire:model="tag" />
                <x-jet-input-error for="tag" class="mt-2" />
            </div>
            <div class="mb-6">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input type="text" id="name" placeholder="{{__('Enter name...')}}" wire:model="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>
            <div class="mb-6">
                <x-jet-label for="xplorer_tag" value="{{ __('Hangar XPLORer Tag (Name)') }}" />
                <x-jet-input type="text" id="xplorer_tag" placeholder="{{__('Enter Hangar XPLORer tag...')}}" wire:model="xplorer_tag" />
                <x-jet-input-error for="xplorer_tag" class="mt-2" />
            </div>
            <div class="mb-6">
                <x-jet-label for="asset" value="{{ __('Asset') }}" />
                <x-jet-input type="file" id="asset" placeholder="{{__('Select an image...')}}" wire:model="asset" />
                <x-jet-input-error for="asset" class="mt-2" />
            </div>
            @if ($asset)
                <div class="mb-6">
                    {{ __('Image Preview:') }}
                    <img src="{{ $asset->temporaryUrl() }}" width="80" height="80" />
                </div>
            @endif
            <div class="mb-6">
                <x-jet-label for="description" value="{{ __('Description') }}" />
                <textarea class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" id="description" wire:model="description" placeholder="{{__('Enter Description')}}"></textarea>
                <x-jet-input-error for="description" class="mt-2" />
            </div>
        </div>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-jet-button wire:click.prevent="store()">Save</x-jet-button>
        <x-jet-secondary-button wire:click="closeModal()">Cancel</x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>
