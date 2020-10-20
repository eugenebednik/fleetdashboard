<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Allowed Roles') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-8 text-2xl">
                {{ __('Discord Roles Allowed To Login') }}
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

            <table class="table-auto w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">{{ __('Role Name') }}</th>
                    <th class="px-4 py-2">{{ __('Allowed To Login') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($discordRoles as $role)
                    <tr>
                        <td class="border px-4 py-2">
                            <span class="{{ \App\Models\AllowedRole::where('role_id', $role['id'])->exists() ? 'text-indigo-500' : 'text-gray-500' }}">{{ $role['name'] }}</span>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            @can('create', \App\Models\AllowedRole::class)
                                @if(\App\Models\AllowedRole::where('role_id', $role['id'])->exists())
                                    <x-jet-secondary-button wire:click="addOrRemove('{{ $role['id'] }}', '{{ $role['name'] }}')" class="bg-green-500"><i class="fa fa-check"></i></x-jet-secondary-button>
                                @else
                                    <x-jet-button wire:click="addOrRemove('{{ $role['id'] }}', '{{ $role['name'] }}')" class="bg-red-500"><i class="fa fa-close"></i></x-jet-button>
                                @endif
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="py-4 text-right">
                <x-jet-secondary-button wire:click="dashboard()">⟵  {{ __('Administrative Dashboard') }}</x-jet-secondary-button>
            </div>
        </div>
    </div>
</div>
