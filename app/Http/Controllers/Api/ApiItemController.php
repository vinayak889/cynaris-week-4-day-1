<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiItem;
use App\Http\Resources\ApiItemResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiItemController extends Controller
{
    // GET /api/items (Index)
    public function index()
    {
        $items = ApiItem::latest()->paginate(10);
        return ApiItemResource::collection($items);
    }

    // POST /api/items (Store - Status 201 Created)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'is_active' => 'sometimes|boolean',
        ]);

        $item = ApiItem::create($validated);

        return (new ApiItemResource($item))
                ->additional(['message' => 'Item created successfully'])
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
    }

    // GET /api/items/{id} (Show - Status 404 handled by Route Model Binding)
    public function show(ApiItem $item)
    {
        return new ApiItemResource($item);
    }

    // PUT/PATCH /api/items/{id} (Update)
    public function update(Request $request, ApiItem $item)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'is_active' => 'sometimes|boolean',
        ]);

        $item->update($validated);

        return (new ApiItemResource($item))
                ->additional(['message' => 'Item updated successfully']);
    }

    // DELETE /api/items/{id} (Destroy - Status 204 No Content or JSON success)
    public function destroy(ApiItem $item)
    {
        $item->delete();

        return response()->json([
            'message' => 'Item deleted successfully'
        ], Response::HTTP_OK);
    }
}
