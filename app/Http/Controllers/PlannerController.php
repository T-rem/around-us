<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlannerStoreRequest;
use App\Http\Requests\PlannerUpdateRequest;
use App\Http\Resources\PlannerCollection;
use App\Http\Resources\PlannerResource;
use App\Models\Planner;
use Illuminate\Http\Request;

class PlannerController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\PlannerCollection
     */
    public function index(Request $request)
    {
        $planners = Planner::all();

        return new PlannerCollection($planners);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Planner $planner
     * @return \App\Http\Resources\PlannerResource
     */
    public function show(Request $request, Planner $planner)
    {
        return new PlannerResource($planner);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Planner $planner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Planner $planner)
    {
        $planner->delete();

        return response()->noContent();
    }
}
