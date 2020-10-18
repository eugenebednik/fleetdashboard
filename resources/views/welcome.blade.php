<x-guest-layout>
    <x-jet-authentication-card>
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        @livewire('login-with-discord')

    </x-jet-authentication-card>
</x-guest-layout>
