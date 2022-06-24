<?php
namespace App\Http\Controllers;
use App\Models\PaymentMethods;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Fee;

class Telkom extends Controller
{

    public function index()
    {
        // var_dump($baseApi);
        //$feeGet = Fee::latest()->get();
        return view('telkom.index');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama_lengkap' => 'required|string',
    //         'jns_kelamin' => 'required',
    //         'no_telp' => 'required',
    //         'email' => 'required|email',
    //         'ktp_passpor' => 'required',
    //         'usia' => 'required',
    //         'tgl_keberangkatan' => 'required',
    //         'negara_tujuan' => 'required',
    //         'ahli_waris' => 'required',
    //         'status_hubungan' => 'required|string',
    //         'kode_penerbangan' => 'required',
    //     ]);

    //     // Insurance_telkom::create($request->all());

    //     $data = Insurance_telkom::create([
    //         'nama_lengkap' => $request->nama_lengkap,
    //         'jns_kelamin' => $request->jns_kelamin,
    //         'no_telp' => $request->no_telp,
    //         'email' => $request->email,
    //         'ktp_passpor' => $request->ktp_passpor,
    //         'usia' => $request->usia,
    //         'tgl_keberangkatan' => $request->tgl_keberangkatan,
    //         'negara_tujuan' => $request->negara_tujuan,
    //         'kode_penerabangan' => $request->kode_penerabangan,
    //         'ahli_waris' => $request->ahli_waris,
    //         'status_hubungan' => $request->status_hubungan,
    //         'insurance_st' => 'waiting',
    //     ]);



    //     // return redirect()->route('telkom.payment_method')->with('succes','Data Berhasil di Input');

    //     if ($data) {
    //         return redirect()
    //             ->route('payment_method')
    //             ->with([
    //                 'success' => 'New data has been created successfully'
    //             ]);
    //     } else {
    //         return redirect()
    //             ->back()
    //             ->withInput()
    //             ->with([
    //                 'error' => 'Some problem occurred, please try again'
    //             ]);
    //     }
    // }

    public function payment_method(Request $request)
    {
        $id = $request->id;
        $paymentMethods = PaymentMethods::where('status', 1)->get();
        return view('telkom.list_method', compact('id', 'paymentMethods'));
    }

}
