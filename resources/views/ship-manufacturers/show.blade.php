<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Ship Manufacturers') }}
    </h2>
</x-slot>

<div class="py-12">
    @if($isOpen)
        @include('ship-manufacturers.create')
    @endif

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-8 text-2xl">
                {{ __('Ship Manufacturers') }}
            </div>
        </div>

        <div class="bg-gray-100 overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if(session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="w-1/4 px-5 py-2">{{__('Asset')}}</th>
                        <th class="w-1/6 px-4 py-2">{{__('Tag')}}</th>
                        <th class="w-1/6 px-4 py-2">{{__('Name')}}</th>
                        <th class="w-1/6 px-4 py-2">{{__('Hangar XPLORer Tag')}}</th>
                        <th class="w-1/4 px-4 py-2">{{__('Description')}}</th>
                        <th class="w-1/6 px-4 py-2">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($manufacturers as $manufacturer)
                    <tr class="bg-white">
                        <td class="px-4 py-2 text-center"><img src="{{ $manufacturer->image }}" alt="{{ $manufacturer->name }}" width="150" height="150" /></td>
                        <td class="px-4 py-2 text-center">{{ $manufacturer->tag }}</td>
                        <td class="px-4 py-2 text-center">{{ $manufacturer->name }}</td>
                        <td class="px-4 py-2 text-center">{{ $manufacturer->xplorer_tag }}</td>
                        <td class="px-4 py-2">{{ $manufacturer->description }}</td>
                        <td class="px-4 py-2 text-center">
                            @can('update', $manufacturer)
                            <x-jet-button wire:click="edit({{ $manufacturer->id }})" ><i class="fa fa-edit"></i></x-jet-button>
                            @endcan
                            @can('delete', $manufacturer)
                            <x-jet-button wire:click="delete({{ $manufacturer->id }})"><i class="fa fa-trash"></i></x-jet-button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="py-4 text-right">
            <x-jet-secondary-button wire:click="dashboard()">⟵  {{ __('Administrative Dashboard') }}</x-jet-secondary-button>
            @can('create', \App\Models\ShipManufacturer::class)
                <x-jet-button wire:click="create()">{{ __('Add Manufacturer') }}</x-jet-button>
            @endcan
            </div>
        </div>
    </div>
</div>
