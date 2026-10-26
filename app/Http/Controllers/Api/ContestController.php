<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContestResource;
use App\Models\Contest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ContestController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $contests = Contest::query()->orderBy('ends_at')->get();

        return ContestResource::collection($contests);
    }

    public function show(Contest $contest): ContestResource
    {
        return new ContestResource($contest);
    }
}
