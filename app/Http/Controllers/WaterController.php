<?php

namespace App\Http\Controllers;

use App\Models\Water;
use Illuminate\Http\Request;

class WaterController extends Controller
{
    // Get water plans for authenticated user

    public function index()
    {
        $waterTracking = auth()->user()->waterTracking;

        return response()->json(['water Tracking Plan' => $waterTracking], 200);
    }
    //================================================================================================

    // Create a water plan

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cup_size' => 'required|integer',
            'wake_up_time' => 'required|string',
            'sleep_time' => 'required|string',
            'water_target' => 'required|integer',
            'total_amount' => 'required|integer',
        ]);

        $waterTracking = auth()->user()->waterTracking()->create($validated);

        return response()->json([
            'message' => 'Water Tracking plan created successfully',
            'Water Tracking Plan' => $waterTracking], 201);
    }
    //================================================================================================

    // Update a water plan
    public function update(Request $request, $id)
    {
        $waterTracking = auth()->user()->waterTracking()->findOrFail($id);

//        $validated = $request->validate([
//            'cup_size' => 'required|integer',
//            'wake_up_time' => 'required|string',
//            'sleep_time' => 'required|string',
//            'water_target' => 'required|integer',
//        ]);

        $waterTracking->update($request->only('cup_size','wake_up_time','sleep_time','water_target','total_amount'));

        return response()->json(['message' => 'Water plan updated successfully',
            'waterPlan' => $waterTracking], 200);
    }
    //================================================================================================

    public function show($id)
    {
        $waterTracking = auth()->user()->waterTracking()->where('water_log_id', $id)->first();

        if (!$waterTracking) {
            return response()->json(['message' => 'Water Tracking plan not found'], 404);
        }

        return response()->json(['Water Tracking Plan' => $waterTracking], 200);
    }
    //================================================================================================

    // Delete a water plan
    public function destroy($id)
    {
        $waterTracking = auth()->user()->waterTracking()->findOrFail($id);

        $waterTracking->delete();

        return response()->json(['message' => 'Water plan deleted successfully'], 200);
    }
}
