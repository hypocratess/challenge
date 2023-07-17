<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\Request;

class CouriersController extends Controller
{
    public function index(Request $request)
    {
        $query = Courier::query();

        // Filter By Name
        $sortBy = $request->input('sort', 'name');
        if ($sortBy === 'registered_at') {
            $query->orderBy('created_at');
        } else {
            $query->orderBy('name', 'ASC');
        }

        // Search By Name
        $search = $request->input('search');
        if($search) {
            $query->where('name', 'like',  '%' . $search . '%');
        }

        // Filter By Level
        $levels = $request->input('level');
        if($levels) {
            $levels = explode(',', $levels);
            $query->whereIn('level', $levels);
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $courier = $query->paginate($perPage);

        return response()->json($courier);
    }

    public function show($id)
    {
        $couriers = Courier::find($id);

        if (!$couriers) {
            return response()->json(['message' => 'Id of Courier not found'], 404);
        }

        return response()->json($couriers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique',
            'alamat' => 'required|string',
            'telp' => 'required|string',
            'level' => 'required|integer'
        ]);

        $couriers = Courier::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
            'telp' => $request->input('telp'),
            'level' => $request->input('level'),
        ]);

        return response()->json($couriers, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'level' => 'integer'
        ]);

        $couriers = Courier::find($id);
        if (!$couriers) {
            return response()->json(['message' => 'Id of Courier not found'], 404);
        }

        $couriers->level = $request->input('level', $couriers->level);
        $couriers->save();

        return response()->json($couriers);
    }

    public function delete($id)
    {
        $couriers = Courier::find($id);

        if (!$couriers) {
            return response()->json(['message' => 'Id of Courier not found'], 404);
        }

        $couriers->delete();
        return response()->json(['message' => 'Deleted Courier Success']);
    }
}
