<?php

namespace App\Http\Controllers;

use App\Models\Prayers;
use Illuminate\Http\Request;


class PrayerController extends Controller
{
    // Get Prayer logs for authenticated user

    public function index()
    {
        $prayers = auth()->user()->prayers;

        return response()->json(['prayers' => $prayers], 200);
    }
//================================================================================================

    // Create a Prayer log

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prayer_name'=> 'required|in:fajr,dhuhr,asr,maghrib,isha,duha,tahajjud,quranic_recitation',
            'in_mosque' => 'required|boolean',
            'with_nawafil' => 'required|boolean',
            'is_prayer_done' => 'required|boolean',
        ]);

        $prayer = auth()->user()->prayers()->create($validated);

        return response()->json(['message' => 'Prayer log created successfully', 'prayer' => $prayer], 201);
    }
//================================================================================================

    // Update a Prayer Log
    public function update(Request $request, $id)
    {
        $prayer = auth()->user()->prayers()->findOrFail($id);

        $prayer->update($request->only('prayer_name','in_mosque','with_nawafil'));

        return response()->json(['message' => 'Prayers log updated successfully', 'prayer' => $prayer], 200);
    }
//================================================================================================

    public function show($id)
    {
        $prayer = auth()->user()->prayers()->where('prayer_log_id', $id)->first();

        if (!$prayer) {
            return response()->json(['message' => 'Prayer Data not found'], 404);
        }

        return response()->json(['Prayer Data' => $prayer], 200);
    }


//================================================================================================
    // Delete a Prayer log
    public function destroy($id)
    {
        $prayer = auth()->user()->prayers()->findOrFail($id);

        $prayer->delete();

        return response()->json(['message' => 'Prayer log deleted successfully'], 200);
    }
}

