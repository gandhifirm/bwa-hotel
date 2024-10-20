<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Manage Cities') }}
            </h2>
            <a href="{{ route('cities.create') }}" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">
                @forelse ($cities as $city)
                    <div class="flex flex-row items-center justify-between item-card">
                        <div class="flex flex-row items-center gap-x-3 w-[20%]">
                            <div class="flex flex-col">
                                <p class="text-sm text-slate-500">Name</p>
                                <h3 class="text-xl font-bold text-indigo-950">
                                    {{ $city->name }}
                                </h3>
                            </div>
                        </div>

                        <div class="flex flex-row items-center gap-x-3">
                            <div class="flex flex-col">
                                <p class="text-sm text-slate-500">Date</p>
                                <h3 class="text-xl font-bold text-indigo-950">
                                    {{ $city->created_at }}
                                </h3>
                            </div>
                        </div>

                        <div class="flex-row items-center hidden md:flex gap-x-3">
                            <a href=" " class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                                Edit
                            </a>
                            <form action=" " method="POST">
                                <button type="submit" class="px-6 py-4 font-bold text-white bg-red-700 rounded-full">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <h3 class="mb-0 text-center">
                        Maaf data belum tersedia!
                    </h3>
                @endforelse

                <div class="mt-4">
                    {{ $cities->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
