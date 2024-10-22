<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryaController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data karyas beserta informasi user dengan role_id 3
        $karyas = DB::table('karyas')
            ->join('users', 'users.id', '=', 'karyas.user_id')
            ->select('karyas.*', 'users.name as user_name')
            ->where('users.role_id', 3)
            ->get();

        // Jika ada filter tanggal, gunakan di query
        if ($request->has('startDate') && $request->has('endDate')) {
            $startDate = $request->startDate;
            $endDate = $request->endDate;

            $karyas->whereBetween('created_at', [$startDate, $endDate]);
        }

        return view('admin.karya.index', compact('karyas'));
    }

    // Mengubah status karya
    public function updateStatus(Request $request, $id)
    {
        $status = $request->status;

        DB::table('karyas')
            ->where('id', $id)
            ->update(['status' => $status]);

        return response()->json(['success' => 'Status updated successfully']);
    }

    // Mendapatkan detail karya untuk modal
    public function getKaryaDetail($id)
    {
        $karya = DB::table('karyas')->where('id', $id)->first();
        return response()->json($karya);
    }
}
