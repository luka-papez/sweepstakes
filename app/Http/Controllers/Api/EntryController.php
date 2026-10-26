<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntryRequest;
use App\Http\Resources\EntryResource;
use App\Models\Contest;
use App\Services\SponsorCrm;
use Illuminate\Http\JsonResponse;

class EntryController extends Controller
{
    public function store(StoreEntryRequest $request, Contest $contest, SponsorCrm $crm): JsonResponse
    {
        abort_unless($contest->isOpen(), 422, 'This contest is not open for entries.');

        $entry = $contest->entries()->create($request->validated());

        $crm->push($entry);

        return (new EntryResource($entry))->response()->setStatusCode(201);
    }
}
