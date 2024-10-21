<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;

class HotelRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Hotel $hotel)
    {
        return view('admin.hotel_rooms.create', compact('hotel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request, Hotel $hotel)
    {
        DB::transaction(function() use ($request, $hotel){
            $validated = $request->validated();

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photo-rooms', 'public');
                $validated['photo'] = $photoPath;
            }

            $validated['hotel_id'] = $hotel->id;

            $room = HotelRoom::create($validated);
        });

        return redirect()->route('hotel_manage.show',$hotel->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(HotelRoom $hotelRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel, HotelRoom $hotelRoom)
    {
        return view('admin.hotel_rooms.edit', compact('hotel', 'hotelRoom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, HotelRoom $hotelRoom)
    {
        DB::transaction(function() use ($request, $hotelRoom) {
             $validated = $request->validated();

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photo-rooms', 'public');
                $validated['photo'] = $photoPath;
            }

            $hotelRoom->update($validated);
        });

        return redirect()->route('hotel_manage.show', $hotelRoom->hotel->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel, HotelRoom $hotelRoom)
    {
        DB::transaction(function() use ($hotelRoom, $hotel) {
            $hotelRoom->delete();
        });

        return redirect()->route('hotel_manage.show',$hotel->slug);
    }
}