<?php

namespace App\Http\Controllers;
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $requestData = $request->all();
            $gudang = Gudang::create($requestData);
    
            return response()->json([
                "message" => "Gudang created successfully",
                "data" => new GudangResource($gudang),
            ], 201);
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
        try {
            $gudang = Gudang::findOrFail($id);
            $gudang->update($request->all());
    
            return response()->json([
                "message" => "Gudang updated successfully",
                "data" => new GudangResource($gudang),
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
            $gudang = Gudang::findOrFail($id);
            $gudang->delete();
    
            return response()->json([
                "message" => "Gudang deleted successfully",
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
