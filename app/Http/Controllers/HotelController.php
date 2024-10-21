<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::with('hotel_photos')->orderByDesc('id')->get();
        return view('admin.hotels.index', compact(['hotels']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        return view('admin.hotels.create', compact(['countries', 'cities']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHotelRequest $request)
    {
        DB::transaction(function() use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('hotel-thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $hotel = Hotel::create($validated);

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $photoPath = $photo->store('hotel-photos', 'public');
                    $validated['photo'] = $photoPath;
                    $hotel->hotel_photos()->create([
                        'photo' => $photoPath
                    ]);
                }
            }
        });

        return redirect()->route('hotels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        $latestPhotos = $hotel->hotel_photos()->orderByDesc('id')->take(3)->get();
        return view('admin.hotels.show', compact(['latestPhotos', 'hotel']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        $countries = Country::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        return view('admin.hotels.edit', compact('countries', 'cities', 'hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {
        DB::transaction(function() use ($request, $hotel) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('hotel-thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $hotel->update($validated);

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $photoPath = $photo->store('hotel-photos', 'public');
                    $validated['photo'] = $photoPath;
                    $hotel->hotel_photos()->create([
                        'photo' => $photoPath
                    ]);
                }
            }
        });

        return redirect()->route('hotels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        //
    }
}