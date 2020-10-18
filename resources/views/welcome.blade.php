<x-guest-layout>
    <x-jet-authentication-card>
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div><a href="{{ route('discord.login') }}" class="btn btn-primary"/>Login With Discord</div>

    </x-jet-authentication-card>
</x-guest-layout>
