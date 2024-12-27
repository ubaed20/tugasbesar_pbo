<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $admins = Admin::all(); // Mengambil semua data dari tabel admins
        return response()->json($admins, 200); // Mengembalikan response JSON
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'jenis_gabah' => 'required|string|max:50',
            'berat_gabah' => 'required|numeric|min:0',
            'durasi_pengeringan' => 'required|integer|min:1',
            'status' => 'required|string|max:50',
        ]);

        $admin = Admin::create($validatedData);
        return response()->json($admin, 201); // Mengembalikan data yang baru dibuat
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Admin $admin)
    {
        return response()->json($admin, 200); // Mengembalikan data spesifik berdasarkan ID
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Admin $admin)
    {
        $validatedData = $request->validate([
            'nama_pelanggan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:15',
            'jenis_gabah' => 'nullable|string|max:50',
            'berat_gabah' => 'nullable|numeric|min:0',
            'durasi_pengeringan' => 'nullable|integer|min:1',
            'status' => 'nullable|string|max:50',
        ]);

        $admin->update($validatedData);
        return response()->json($admin, 200); // Mengembalikan data yang telah diperbarui
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->json(['message' => 'Alhamdulillah Data Telah Dihapus'], 200);
    }
}
