<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class KendaraanController extends Controller
{
    function index(Request $req){
        $datas = DB::table("m_vehicle")
                    ->leftjoin('rel_uservehicle', 'm_vehicle.id', 'rel_uservehicle.id_vehicle')
                    ->where('m_vehicle.flag_active', 1)
                    ->select('m_vehicle.*', 'rel_uservehicle.dateto')
                    ->get();

        return view('vehicle.management.index', compact(
            'datas'
        ));
    }

    function store(Request $req){
        try {
            DB::beginTransaction();
                DB::table('m_vehicle')->insert([
                    'merek'         => $req->merek,
                    'model'         => $req->model,
                    'nomor_plat'    => $req->nomor_plat,
                    'tarif'         => $req->tarif_sewa_perhari,
                    'createdBy'     => Auth::id(),
                    'created_at'    => date('Y-m-d H:i:s')
                ]);
            DB::commit();
            return redirect()->back();
        } catch (Exeption $e) {
            return redirect()->back();
        }
    }

    function rent(Request $req){
        try {
                $check = DB::table('m_vehicle')
                            ->where('m_vehicle.flag_active', 1)
                            ->where('m_vehicle.flag_used', 0)
                            ->where('m_vehicle.id', $req->id_vehicle)
                            ->select('m_vehicle.*')
                            ->first();

            if($check != null){
                DB::beginTransaction();
                    DB::table('m_vehicle')->where('id', $req->id_vehicle)->update([
                        'flag_used'   => 1,
                        'updatedBy'   => Auth::id(),
                        'updated_at'  => now()
                    ]);

                    DB::table('rel_uservehicle')->insert([
                        'id_vehicle'    => $req->id_vehicle,
                        'id_users'      => Auth::id(),
                        'datefrom'      => $req->datefrom,
                        'dateto'        => $req->dateto,
                        'createdBy'     => Auth::id(),
                        'created_at'    => now()
                    ]);
                DB::commit();
                return redirect()->back()->with('success', 'Tidak Tersedia');
            } else {
                return redirect()->back()->with('error', 'Tidak Tersedia');
            }
        } catch (Exeption $e) {
                DB::rollback();
                dd($e);
                return redirect()->back()->with('error', 'Gagal silahkan coba lagi');
        }
    }

    function return(Request $req){
        return redirect()->back();
    }

    function getListVehicle(Request $req){
        $datas = DB::table('m_vehicle')->where('merek', 'like', '%'. $req->merek . '%')->get();

        return response()->json($datas);
    }
}
