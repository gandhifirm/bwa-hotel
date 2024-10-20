<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Manage Hotels') }}
            </h2>
            <a href="{{ route('hotels.create') }}" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">
                @forelse ($hotels as $hotel)
                <div class="flex flex-row items-center justify-between item-card">
                    <div class="flex flex-row items-center gap-x-3 w-[35%]">
                        <img src="{{ Storage::url($hotel->thumbnail) }}" alt="{{ $hotel->name }}" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $hotel->name }}
                            </h3>
                            <p class="text-sm text-slate-500">
                                {{ $hotel->country->name }}, {{ $hotel->city->name }}
                            </p>
                        </div>
                    </div>

                    <div  class="flex flex-row items-center gap-x-3">
                        <p class="text-sm text-slate-500">Price</p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            Rp {{ number_format($hotel->getLowerRoomPrice(), 0, ',', '.') }}/night
                        </h3>
                    </div>

                    <div class="flex-row items-center hidden md:flex gap-x-3">
                        <a href="{{ route('hotel_manage.show',$hotel->slug) }}" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            Manage
                        </a>
                    </div>
                </div>
                @empty
                <h3>Data Belum Tersedia!</h3>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
