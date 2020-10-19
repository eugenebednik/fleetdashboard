<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div class="mt-8 text-2xl">
        Welcome to Codegaming Administration Dashboard
    </div>

    <div class="mt-6 text-gray-500">
        Here you are able to perform administrative functions for the Organization Dashboard
    </div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6">
        <div class="flex items-center">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="{{ route('admin.ship-manufacturers') }}">Ship Manufacturers</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Create and edit the Ship Manufacturers as new ones are added to the game.
            </div>

            <a href="{{ route('admin.ship-manufacturers') }}">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                    <div>Ship manufacturers</div>
                    <div class="ml-1 text-indigo-500">⟶</div>
                </div>
            </a>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="{{ route('admin.ships') }}">Ships</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Add or edit ships currently supported by CIG.
            </div>

            <a href="{{ route('admin.ships') }}">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                    <div>Go to Ships</div>
                    <div class="ml-1 text-indigo-500">⟶</div>
                </div>
            </a>
        </div>
    </div>
</div>
