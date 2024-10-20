<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Details Hotel') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">
                <div class="flex flex-row items-center justify-between item-card">
                    <div class="flex flex-row items-center gap-x-3">
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
                    <div  class="flex-col hidden md:flex">
                        <p class="text-sm text-slate-500">Price</p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            Rp {{ number_format($hotel->getLowerRoomPrice(), 0, ',', '.') }}/night
                        </h3>
                    </div>
                    <div  class="flex-col hidden md:flex">
                        <p class="text-sm text-slate-500">Star</p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            {{ $hotel->star_level }} star
                        </h3>
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

                <hr class="my-5">
                <h3 class="text-xl font-bold text-indigo-950">Gallery Photos</h3>

                <div class="flex flex-row gap-x-5">
                    @forelse ($latestPhotos as $photo)
                        <img src="{{ Storage::url($photo->photo) }}" alt="{{ $hotel->name }}" class="rounded-2xl object-cover w-[120px] h-[90px]">
                    @empty
                        <h3>Data belum tersedia!</h3>
                    @endforelse
                </div>

                <div>
                    <h3 class="text-xl font-bold text-indigo-950">Address</h3>
                    <p>
                        {{ $hotel->address }}
                    </p>
                </div>

                <hr class="my-5">
                <div class="flex flex-row items-center justify-between">
                    <h3 class="text-xl font-bold text-indigo-950">Rooms Available</h3>
                    <a href="{{ route('hotel_rooms.create', $hotel->slug) }}" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                        Add New Room
                    </a>
                </div>

                @forelse ($hotel->hotel_rooms as $room)
                    <div class="flex flex-row items-center justify-between item-card">
                        <div class="flex flex-row items-center gap-x-3 w-[35%]">
                            <img src="{{ Storage::url($room->photo) }}" alt="{{ $room->name }}" class="rounded-2xl object-cover w-[120px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-xl font-bold text-indigo-950">
                                    {{ $room->name }}
                                </h3>
                            <p class="text-sm text-slate-500">
                                {{ $room->total_people }} people
                            </p>
                            </div>
                        </div>
                        <div  class="flex flex-row items-center gap-x-3">
                            <p class="text-sm text-slate-500">Price</p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                Rp {{ number_format($room->price, 0, ',', '.') }}/night
                            </h3>
                        </div>
                        <div class="flex-row items-center hidden md:flex gap-x-3">
                            <a href="" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                                Edit
                            </a>
                            <form action="" method="POST">
                                <button type="submit" class="px-6 py-4 font-bold text-white bg-red-700 rounded-full">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <h3 class="mb-0">Data Belum Tersedia!</h3>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
