<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Asset_history;
use App\Models\Divisi;
use App\Models\Cabang;
use App\Models\Pegawai;
use App\Exports\ExportAsset;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;


class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asset = DB::table('asset')
                    ->select('asset.id_asset','asset.kode_asset','asset.tanggal_beli','asset.nama_asset','asset.sfesifikasi','pegawai.nama as nama_pegawai', 'divisi.divisi', 'cabang.nama as cabang')
                    ->join('pegawai', 'pegawai.kode_pegawai', '=', 'asset.kode_pegawai')
                    ->join('divisi', 'divisi.kode', '=', 'asset.kode_divisi')
                    ->join('cabang', 'cabang.kode', '=', 'asset.kode_cabang')
                    ->get();
        $cabang = Cabang::all();
        $divisi = Divisi::all();
        return view('pages.asset.data',compact('asset','cabang','divisi'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function getCari(Request $request)
    {
       
        if ($request->ajax()) {
            $assets = DB::table('asset')
                            ->select('asset.id_asset','asset.kode_asset','asset.tanggal_beli','asset.nama_asset','asset.sfesifikasi','pegawai.nama as nama_pegawai', 'divisi.divisi', 'cabang.nama as cabang')
                            ->join('pegawai', 'pegawai.kode_pegawai', '=', 'asset.kode_pegawai')
                            ->join('divisi', 'divisi.kode', '=', 'asset.kode_divisi')
                            ->join('cabang', 'cabang.kode', '=', 'asset.kode_cabang')
                            ->OrderByDesc('asset.kode_asset')
                            ->get();

            return DataTables::of($assets)
                ->addColumn('action', function ($row) {
                    return '';
                })
                ->addColumn('divisi', function ($row) {
                    return $row->divisi; // Add column for the dropdown filter
                })
                ->addColumn('cabang', function ($row) {
                    return $row->cabang; // Add column for the dropdown filter
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getData(Request $request)
{
    if ($request->ajax()) {
        $query = DB::table('asset')
                    ->select('asset.id_asset', 'asset.kode_asset', 'asset.tanggal_beli', 'asset.nama_asset', 'asset.sfesifikasi', 'asset.id_kategori' ,'pegawai.nama as nama_pegawai', 'divisi.divisi', 'cabang.nama as cabang')
                    ->join('pegawai', 'pegawai.kode_pegawai', '=', 'asset.kode_pegawai')
                    ->join('divisi', 'divisi.kode', '=', 'asset.kode_divisi')
                    ->join('cabang', 'cabang.kode', '=', 'asset.kode_cabang');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('asset.nama_asset', 'like', "%$search%")
                  ->orWhere('pegawai.nama', 'like', "%$search%")
                  ->orWhere('divisi.divisi', 'like', "%$search%")
                  ->orWhere('cabang.nama', 'like', "%$search%");
            });
        }

        if ($request->has('divisi') && $request->input('divisi') != '') {
            $query->where('divisi.divisi', $request->input('divisi'));
        }

        if ($request->has('cabang') && $request->input('cabang') != '') {
            $query->where('cabang.nama', $request->input('cabang'));
        }

        if ($request->has('id_kategori') && $request->input('id_kategori') != '') {
            $query->where('asset.id_kategori', $request->input('id_kategori'));
        }

        $assets = $query->paginate(10);

        // Fetch divisi and cabang data
        $divisiOptions = Divisi::pluck('divisi')->toArray();
        $cabangOptions = Cabang::pluck('nama')->toArray();

        return response()->json([
            'assets' => $assets,
            'divisiOptions' => $divisiOptions,
            'cabangOptions' => $cabangOptions,
        ]);
    }
}



    public function DataPegawai(Request $request)
    {
        $kode_pegawai = $request->get('kode_pegawai');
        $details = Pegawai::where('kode_pegawai', $kode_pegawai)->first();

        return response()->json($details);
    }

    public function DataPegawaiSelect(Request $request)
    {
        $pegawai = Pegawai::where('nama','like','%'.$request->q.'%')->get();
        return response()->json($pegawai, 200);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $pegawai = Pegawai::get();
        $year = date('Y');
        $date = date('d-m-y');
        return view('pages.asset.tambah', compact('pegawai','year','date'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'tanggal_beli' => 'required',
            'tgl_musnah' => 'required',
            'expire_date' => 'required',
            'kode_pegawai' => 'required',
            'nama_asset' => 'required',
            'id_kategori' => 'required',
            'merk' => 'required',
            'sfesifikasi' => 'required',
            'kelengkapan' => 'required',
            'lokasi' => 'required',
            'keterangan_kondisi' => 'required',
            'kondisi' => 'required',
            'status' => 'required',
        ]);
        $request['diupdate'] = 'dibuat';
        $request['tgl_update'] = 'tgl_buat';
        Asset::create($request->all());
        
         
        return redirect()
        ->route('asset.cari')
        ->with('success','Asset Berhasil di Tambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asset = DB::table('asset')
                    ->select('asset.id_asset','asset.foto','asset.kode_asset','asset.kondisi','asset.lokasi','asset.tgl_musnah','asset.expire_date','asset.tanggal_beli','asset.id_kategori','asset.nama_asset','asset.merk','asset.sfesifikasi','asset.kelengkapan','pegawai.nama as nama_pegawai','pegawai.kode_pegawai','pegawai.nik','asset.keterangan_kondisi','cabang.nama as nama_cabang','divisi.divisi as nama_divisi')
                    ->join('pegawai', 'pegawai.kode_pegawai', '=', 'asset.kode_pegawai')
                    ->join('cabang','asset.kode_cabang','=','cabang.kode')
                    ->join('divisi','asset.kode_divisi','=','divisi.kode')
                    ->where('asset.id_asset',$id)
                    ->first();

        $history = DB::table('asset_history')
                    ->select('asset_history.tanggal','a.nama as dari_pegawai','b.nama as ke_pegawai')
                    ->join('pegawai as a', 'a.kode_pegawai', '=', 'asset_history.dari')
                    ->join('pegawai as b','b.kode_pegawai','=','asset_history.ke')
                    ->where('asset_history.id_asset',$id)
                    ->get();

        return view('pages.asset.detail',compact('asset','history'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(asset $asset)
    {
        return view('pages.asset.edit',compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal_beli' => 'required',
            'kode_pegawai' => 'required',
            'kode_divisi' => 'required',
            'kode_cabang' => 'required',
            'nama_asset' => 'required',
            'id_kategori' => 'required',
            'merk' => 'required',
            'sfesifikasi' => 'required',
            'kelengkapan' => 'required',
            'lokasi' => 'required',
            'keterangan_kondisi' => 'required',
            'kondisi' => 'required',
            'status' => 'required',
        ]);
        
        
        $input = $request->except(['_token', '_method']);
        Asset::where('id_asset', $id)->update($input);
        
        return redirect()
        ->route('asset.cari')
        ->with('success','Asset Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_asset' => 'required|exists:asset,id_asset', 
        ]);

        if ($request->file('image')) {
            $imageName = $request->file('image')->getClientOriginalName();

            $asset = Asset::find($request->id_asset);

            if ($asset) {
                $oldImagePath = public_path('storage/asset/images/foto/' . $asset->foto);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
    
                $imagePath = $request->file('image')->storeAs('asset/images/foto/', $imageName, 'public');
                $asset->foto = $imageName;
                $asset->save();
            } else {
                $imagePath = $request->file('image')->storeAs('asset/images/foto/', $imageName,'public');
                $asset->foto = $imageName;
                $asset->save();
            }

            return response()->json(['success' => true, 'path' => $imagePath]);
        }

        return response()->json(['success' => false]);
    
    }

    public function resetupload(Request $request)
    {
        $request->validate([
            'id_asset' => 'required|exists:asset,id_asset', 
        ]);

        

            $asset = Asset::find($request->id_asset);

            if ($asset) {
                // Delete the image file if it exists
                if ($asset->foto) {
                    $oldImagePath = public_path('storage/asset/images/' . $asset->foto);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
    
                    // Update the asset with default image path or nullify 'foto' attribute
                    $asset->foto = 'nofoto.png'; // Assuming 'nofoto.png' is your default image path
                    $asset->save();
                }
    
                return response()->json(['success' => 'Image reset successfully.']);
            } else {
                // Handle the case when the asset is not found
                return response()->json(['error' => 'Asset not found.'], 404);
            }
    }

    public function destroy(asset $asset)
    {
        $asset->delete();
         
        return redirect()->route('asset.index')
                        ->with('success','Asset Berhasil Dihapus');
    }

    public function cari()
    {
        $divisi = Divisi::get(); // Fetch all divisions (adjust as per your model)
        $cabang = Cabang::get(); // Fetch all branches (adjust as per your model)
        return view('pages.asset.cari',compact('divisi','cabang'));
    }

    public function laporan_view()
    {
        $cabang = Cabang::get();
        $divisi = Divisi::get();
        return view('pages.asset.laporan',compact('cabang','divisi'));
    }

    public function maintenance()
    {
        $maintenance = DB::table('v_asset')->get();
        return view('pages.reminder.maintenance.reminder',compact('maintenance'));
    }

    public function pindah_asset(string $id)
    {
        $asset = DB::table('asset')
                    ->select('asset.id_asset','asset.kode_asset','asset.kondisi','asset.lokasi','asset.kode_pegawai','asset.kode_divisi','asset.kode_cabang','asset.tgl_musnah','asset.expire_date','asset.tanggal_beli','asset.id_kategori','asset.nama_asset','asset.merk','asset.sfesifikasi','asset.kelengkapan','pegawai.nama as nama_pegawai','pegawai.kode_pegawai','pegawai.nik','asset.keterangan_kondisi','cabang.nama as nama_cabang','divisi.divisi as nama_divisi')
                    ->join('pegawai', 'pegawai.kode_pegawai', '=', 'asset.kode_pegawai')
                    ->join('cabang','asset.kode_cabang','=','cabang.kode')
                    ->join('divisi','asset.kode_divisi','=','divisi.kode')
                    ->where('asset.id_asset',$id)
                    ->first();

        $history = DB::table('asset_history')
                    ->select('asset_history.tanggal','a.nama as dari_pegawai','b.nama as ke_pegawai')
                    ->join('pegawai as a', 'a.kode_pegawai', '=', 'asset_history.dari')
                    ->join('pegawai as b','b.kode_pegawai','=','asset_history.ke')
                    ->where('asset_history.id_asset',$id)
                    ->get();

        $Date_now = date("Y-m-d");

        return view('pages.asset.pindah',compact('asset','history','Date_now'));
    }

    public function pindah_update(Request $request, string $id)
    {
        $request->validate([
            'kode_pegawai' => 'required',
            'tanggal_pindah' => 'required',
            'kondisi' => 'required',
            'lokasi' => 'required',
        ]);
        
        $asset = Asset::findOrFail($id);
        $asset->update([
            'kode_pegawai'     => $request->kode_pegawai,
            'kode_divisi'     => $request->kode_divisi,
            'kode_cabang'   => $request->kode_cabang,
            'tanggal_pindah'   => $request->tanggal_pindah,
            'lokasi'   => $request->lokasi,
            'kondisi'   => $request->kondisi,
            'diupdate'   => $request->dibuat,
            'tgl_update'   => $request->tgl_buat,
        ]);

        Asset_history::create([
            'id_asset'     => $request->id_asset,
            'dari'     => $request->dari,
            'ke'   => $request->kode_pegawai,
            'tanggal'   => $request->tanggal_pindah,
            'dibuat'   => $request->dibuat,
            'tgl_buat'   => $request->tgl_buat,
        ]);
        
        return redirect()
        ->route('asset.show',$id)
        ->with('success','Aset Berhasil di Pindah');
    }

    public function export(Request $request)
    {
        return Excel::download(new ExportAsset($request), 'report-asset.xlsx');
    }
}
