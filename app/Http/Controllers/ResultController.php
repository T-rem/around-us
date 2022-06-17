<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultStoreRequest;
use App\Http\Requests\ResultUpdateRequest;
use App\Http\Resources\ResultCollection;
use App\Http\Resources\ResultResource;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ResultCollection
     */
    public function index(Request $request)
    {
        $results = Result::all();

        return new ResultCollection($results);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Result $result
     * @return \App\Http\Resources\ResultResource
     */
    public function show(Request $request, Result $result)
    {
        return new ResultResource($result);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Result $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Result $result)
    {
        $result->delete();

        return response()->noContent();
    }
}
