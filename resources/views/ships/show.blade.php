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
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-8 text-2xl">
                Ships
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
                    <th class="w-1/4 px-4 py-2">{{ __('Asset') }}</th>
                    <th class="w-1/6 px-4 py-2">{{ __('Tag') }}</th>
                    <th class="w-1/6 px-4 py-2">{{ __('Name') }}</th>
                    <th class="w-1/2 px-4 py-2">{{ __('Description') }}</th>
                    <th class="w-1/6 py-2">{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ships as $ship)
                    <tr class="bg-white">
                        <td class="px-4 py-2 text-center"><img src="{{$ship->image}}" alt="{{$ship->name}}" width="360" height="123" class="rounded-md"/></td>
                        <td class="px-4 py-2 text-center">{{ $ship->manufacturer->tag }}</td>
                        <td class="px-4 py-2 text-center">{{ $ship->name }}</td>
                        <td class="px-4 py-2">{{ $ship->description }}</td>
                        <td class="px-4 py-2 text-center">
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

            <div class="py-4 text-right">
            <x-jet-secondary-button wire:click="dashboard()">⟵  {{ __('Administrative Dashboard') }}</x-jet-secondary-button>
            @can('create', \App\Models\Ship::class)
                <x-jet-button wire:click="create()">{{ __('Add Ship') }}</x-jet-button>
            @endcan
            </div>
        </div>
    </div>
</div>
</div>
