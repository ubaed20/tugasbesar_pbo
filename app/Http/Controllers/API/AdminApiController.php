<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminApiController extends Controller
{
    /**
     * Display a listing of the resource with pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $admins = Admin::paginate(10); // Mengambil data dengan pagination (10 per halaman)
        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil diambil',
            'data' => $admins,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_pelanggan' => 'required|string|max:255',
                'alamat' => 'required|string',
                'no_hp' => 'required|string|max:15',
                'jenis_gabah' => 'required|string|max:50',
                'berat_gabah' => 'required|numeric|min:0',
                'durasi_pengeringan' => 'required|integer|min:1',
                'status' => 'required|string|in:Menunggu,Proses,Selesai',
            ]);

            $admin = Admin::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Data pelanggan berhasil dibuat',
                'data' => $admin,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi data gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Admin $admin)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil ditemukan',
            'data' => $admin,
        ], 200);
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
        try {
            $validatedData = $request->validate([
                'nama_pelanggan' => 'nullable|string|max:255',
                'alamat' => 'nullable|string',
                'no_hp' => 'nullable|string|max:15',
                'jenis_gabah' => 'nullable|string|max:50',
                'berat_gabah' => 'nullable|numeric|min:0',
                'durasi_pengeringan' => 'nullable|integer|min:1',
                'status' => 'nullable|string|in:Menunggu,Proses,Selesai',
            ]);

            $admin->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Data pelanggan berhasil diperbarui',
                'data' => $admin,
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi data gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Admin $admin)
    {
        try {
            $admin->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data pelanggan berhasil dihapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data',
            ], 500);
        }
    }
}
