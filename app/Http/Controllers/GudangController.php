<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGudangRequest;
use App\Models\Gudang;
use App\Http\Resources\GudangResource;
use Illuminate\Http\Request;
use Exception;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $queryData = Gudang::all();
            // $formattedDatas = new GudangResource($queryData);
            $formattedDatas = GudangResource::collection($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGudangRequest $request)
{
    $validatedRequest = $request->validated();
    try {
        $queryData = Gudang::create($validatedRequest);
        $formattedDatas = new GudangResource($queryData);
        return response()->json([
            "message" => "success",
            "data" => $formattedDatas
        ], 200);
    } catch (Exception $e) {
        return response()->json($e->getMessage(), 400);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $queryData = Gudang::findOrFail($id);
            $formattedDatas = new GudangResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedRequest = $request->validated();
        try {
            $queryData = Gudang::findOrFail($id);
            $queryData->update($validatedRequest);
            $queryData->save();
            $formattedDatas = new GudangResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $queryData = Gudang::findOrFail($id);
            $queryData->delete();
            $formattedDatas = new GudangResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
