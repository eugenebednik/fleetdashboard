<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Ships') }}
    </h2>
</x-slot>

<div class="py-12">
    @if($isOpen)
        @include('ships.create')
    @endif

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if(session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <table class="table-auto w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Manufacturer Tag</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ships as $ship)
                    <tr>
                        <td class="border px-4 py-2">{{ $ship->manufacturer->tag }}</td>
                        <td class="border px-4 py-2">{{ $ship->name }}</td>
                        <td class="border px-4 py-2">{{ $ship->description }}</td>
                        <td class="border px-4 py-2 text-center">
                            @can('update', $ship)
                                <x-jet-button wire:click="edit({{ $ship->id }})" ><i class="fa fa-edit"></i></x-jet-button>
                            @endcan
                            @can('delete', $ship)
                                <x-jet-button wire:click="delete({{ $ship->id }})"><i class="fa fa-trash"></i></x-jet-button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @can('create', \App\Models\Ship::class)
                <div class="py-4 text-right">
                    <x-jet-button wire:click="create()">{{ __('Add Ship') }}</x-jet-button>
                </div>
            @endcan
        </div>
    </div>
</div>
</div>
