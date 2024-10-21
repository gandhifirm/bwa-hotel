<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Hotel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('hotel_manage.store', $hotel->slug) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block w-full mt-1" type="text" name="name" value="{{ $hotel->name }}"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('thumbnail')" />
                        <img src="{{ Storage::url($hotel->thumbnail) }}" alt="{{ $hotel->name }}" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <x-text-input id="thumbnail" class="block w-full mt-1" type="file" name="thumbnail"  autofocus autocomplete="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="country" :value="__('country')" />
                        <select name="country_id" id="country_id" class="w-full py-3 pl-3 border rounded-lg border-slate-300">
                            <option value="{{ $hotel->country->id }}">{{ $hotel->country->name }}</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="city" :value="__('city')" />
                        <select name="city_id" id="city_id" class="w-full py-3 pl-3 border rounded-lg border-slate-300">
                            <option value="{{ $hotel->city->id }}">{{ $hotel->city->name }}</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="gmaps" :value="__('gmaps')" />
                        <x-text-input id="gmaps" class="block w-full mt-1" type="text" name="gmaps" value="{{ $hotel->gmaps }}"/>
                        <x-input-error :messages="$errors->get('gmaps')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="address" :value="__('address')" />
                        <textarea name="address" id="address" cols="30" rows="5" class="w-full border border-slate-300 rounded-xl"">{{ $hotel->address }}</textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="star_level" :value="__('star_level')" />
                        <x-text-input id="star_level" class="block w-full mt-1" type="number" name="star_level" value="{{ $hotel->star_level }}"/>
                        <x-input-error :messages="$errors->get('star_level')" class="mt-2" />
                    </div>

                    <hr class="my-5">
                    @foreach ($hotel->hotel_photos as $photo)
                        <div class="mt-4">
                            <x-input-label for="photo" :value="__('photo')" />
                            <img src="{{ Storage::url($photo->photo) }}" alt="{{ $hotel->name }}" class="rounded-2xl object-cover w-[120px] h-[90px]">
                            <x-text-input id="photo" class="block w-full mt-1" type="file" name="photos[]"  autofocus autocomplete="photo" />
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>
                    @endforeach

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            Update Hotel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
