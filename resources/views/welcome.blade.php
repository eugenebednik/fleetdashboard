<x-guest-layout>
    <x-jet-authentication-card>
        @if($errors->any())
            <div class="my-4 text-center bg-red-500 bg-opacity-50 rounded-sm">
                {{ $errors->first() }}
            </div>
        @endif
        <div class="my-4 text-center">
            @livewire('codegaming-main-logo')
        </div>
        <div class="my-4 text-center">
            @livewire('login-with-discord')
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
