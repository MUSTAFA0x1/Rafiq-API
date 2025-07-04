<?php

namespace App\Http\Controllers;

use App\Models\Steps;
use Illuminate\Http\Request;


class StepsController extends Controller
{
    // Get step plans for authenticated user

    public function index()
    {
        $stepPlans = auth()->user()->stepPlans;

        return response()->json(['Step Tracking Plan' => $stepPlans], 200);
    }

    // Create a step plan

    public function store(Request $request)
    {
        $validated = $request->validate([
            'step_target' => 'required|integer',
            'step_count' => 'required|integer',
        ]);

        $stepPlan = auth()->user()->stepPlans()->create($validated);

        return response()->json(['message' => 'Step plan created successfully',
            'Steps Tracking Plan' => $stepPlan], 201);
    }

    // Update a step plan
    public function update(Request $request, $id)
    {
        $stepPlan = auth()->user()->stepPlans()->findOrFail($id);

        $stepPlan->update($request->only('step_target','step_count'));

        return response()->json(['message' => 'Step plan updated successfully', 'Step Tracking Plan' => $stepPlan], 200);
    }

    // Delete a step plan
    public function destroy($id)
    {
        $stepPlan = auth()->user()->stepPlans()->findOrFail($id);

        $stepPlan->delete();

        return response()->json(['message' => 'Step plan deleted successfully'], 200);
    }
}

