<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Hotel Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg">

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
                </div>

                <hr class="my-5">

                <form method="POST" action="{{ route('hotel_rooms.update', $hotelRoom) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block w-full mt-1" type="text" name="name" value="{{ $hotelRoom->name }}"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="photo" :value="__('photo')" />
                        <img src="{{ Storage::url($hotelRoom->photo) }}" alt="{{ $hotel->name }}" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <x-text-input id="photo" class="block w-full mt-1" type="file" name="photo"/>
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="price" :value="__('price')" />
                        <x-text-input id="price" class="block w-full mt-1" type="number" name="price" value="{{ $hotelRoom->price }}"/>
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="total_people" :value="__('total_people')" />
                        <x-text-input id="total_people" class="block w-full mt-1" type="number" name="total_people" value="{{ $hotelRoom->total_people }}"/>
                        <x-input-error :messages="$errors->get('total_people')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            Edit Hotel Room
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
