<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Village;
use App\Models\VillageInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VillageInfoController extends Controller
{
    /**
     * Display a listing of village information.
     */
    public function index()
    {
        $village = Village::first();
        $villageInfos = VillageInfo::with('createdBy')
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('staff.village-info.index', compact('village', 'villageInfos'));
    }

    /**
     * Store a newly created village information.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:sejarah,geografis,demografis,ekonomi,sosial_budaya,fasilitas,potensi,pemerintahan,lainnya',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->only(['title', 'type', 'description']);
            $data['is_featured'] = $request->boolean('is_featured');
            $data['created_by'] = Auth::id();

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('village-info', 'public');
                $data['image_path'] = $imagePath;
            }

            // If this is featured, unfeature others
            if ($data['is_featured']) {
                VillageInfo::where('is_featured', true)->update(['is_featured' => false]);
            }

            $villageInfo = VillageInfo::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Informasi desa berhasil ditambahkan',
                'data' => $villageInfo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified village information.
     */
    public function show($id)
    {
        try {
            $villageInfo = VillageInfo::with('createdBy')->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $villageInfo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified village information.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:sejarah,geografis,demografis,ekonomi,sosial_budaya,fasilitas,potensi,pemerintahan,lainnya',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $villageInfo = VillageInfo::findOrFail($id);
            
            $data = $request->only(['title', 'type', 'description']);
            $data['is_featured'] = $request->boolean('is_featured');

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image
                if ($villageInfo->image_path) {
                    Storage::disk('public')->delete($villageInfo->image_path);
                }
                
                $image = $request->file('image');
                $imagePath = $image->store('village-info', 'public');
                $data['image_path'] = $imagePath;
            }

            // If this is featured, unfeature others
            if ($data['is_featured']) {
                VillageInfo::where('id', '!=', $id)
                    ->where('is_featured', true)
                    ->update(['is_featured' => false]);
            }

            $villageInfo->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Informasi desa berhasil diperbarui',
                'data' => $villageInfo->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified village information.
     */
    public function destroy($id)
    {
        try {
            $villageInfo = VillageInfo::findOrFail($id);
            
            // Delete image if exists
            if ($villageInfo->image_path) {
                Storage::disk('public')->delete($villageInfo->image_path);
            }
            
            $villageInfo->delete();

            return response()->json([
                'success' => true,
                'message' => 'Informasi desa berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update village profile.
     */
    public function updateVillage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'regency' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'area' => 'nullable|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->only(['name', 'district', 'regency', 'province', 'postal_code', 'area']);
            
            $village = Village::first();
            if ($village) {
                $village->update($data);
            } else {
                $village = Village::create($data);
            }

            return response()->json([
                'success' => true,
                'message' => 'Profil desa berhasil diperbarui',
                'data' => $village
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui profil desa: ' . $e->getMessage()
            ], 500);
        }
    }
}