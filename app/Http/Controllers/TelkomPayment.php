<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Insurance_telkom;
use App\Models\PaymentMethodsDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelkomPayment extends Controller
{

    public function index(Request $request, $method, $id)
    {
        $detailPaymentMethods = PaymentMethodsDetail::where('status', 1)->where('method', $method)->get();
        $result = Http::get(env('BASE_API') . '/api/get_detail_payment/' . $id);
        $data = $result->json()['data'];

        // Populating Data
        $data['id'] = $id;
        $data['data'] = $data;
        $data['method'] = $method;
        $data['detailPaymentMethods'] = $detailPaymentMethods;
        return view('telkom.detail_method', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'jns_kelamin' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'ktp_passpor' => 'required',
            'usia' => 'required',
            'tgl_keberangkatan' => 'required',
            'negara_tujuan' => 'required',
            'periode_polis_start' => 'required',
            'periode_polis_end' => 'required',
            'ahli_waris' => 'required',
            'status_hubungan' => 'required|string',
        ]);

        // Insurance_telkom::create($request->all());

        $data = Insurance_telkom::create([
            'nama_lengkap' => $request->nama_lengkap,
            'jns_kelamin' => $request->jns_kelamin,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'ktp_passpor' => $request->ktp_passpor,
            'usia' => $request->usia,
            'tgl_keberangkatan' => $request->tgl_keberangkatan,
            'negara_tujuan' => $request->negara_tujuan,
            'periode_polis_start' => $request->periode_polis_start,
            'periode_polis_end' => $request->periode_polis_end,
            'ahli_waris' => $request->ahli_waris,
            'status_hubungan' => $request->status_hubungan,
            'insurance_st' => 'waiting',
        ]);


        // return redirect()->route('telkom.payment_method')->with('succes','Data Berhasil di Input');

        if ($data) {
            return redirect()
                ->route('payment_method')
                ->with([
                    'success' => 'New data has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    public function payment_method()
    {
        return view('telkom.list_method');
    }

    public function checkout($method, $id, $token=null)
    {
        $detailPaymentMethod = PaymentMethodsDetail::where('name', $method)->first();

        // Get Detail Payment
        $result = Http::get(env('BASE_API') . '/api/get_detail_payment/' . $id);
        $data = $result->json()['data'];

        $fee = @$detailPaymentMethod->fee;
        if (empty($detailPaymentMethod->percentage)) $fee += $data['total_bayar'] * $detailPaymentMethod->percentage / 100;
        $totalBayar = $data['total_bayar'];
        $totalTagihan = round($fee + $totalBayar);

        // Checkout
        $result = Http::post(env('BASE_API') . '/api/payment', [
            'paymentMethod' => $detailPaymentMethod->method,
            'paymentMethodName' => $detailPaymentMethod->name,

            'id' => $id,
            'total' => $totalTagihan,
            'token_id' => @$token
        ]);

        $resultJson = $result->json();

        //dd($result, $resultJson, $result->body(), $detailPaymentMethod->name);

        if ($detailPaymentMethod->method == 'gopay') {
            $data['actions'] = array_filter($resultJson['actions'], function ($e) {
                return $e['name'] == 'generate-qr-code';
            })[0];
        } else if ($detailPaymentMethod->method == 'shopeepay') {
            $data['actions'] = array_filter($resultJson['actions'], function ($e) {
                return $e['name'] == 'deeplink-redirect';
            })[0];
        } elseif ($detailPaymentMethod->name == 'mandiri') {
            $data['bill_key'] = $resultJson['bill_key'];
            $data['biller_code'] = $resultJson['biller_code'];
        } elseif ($detailPaymentMethod->name == 'credit_card') {
            //return $this->finish($resultJson['transaction_id']);
            return redirect()->route('index')->with(['message' => 'New data has been created successfully']);
        } else {
            if (!empty($resultJson['permata_va_number'])) {
                $data['va_number'] = [
                    'va_number' => $resultJson['permata_va_number']
                ];
            } else {
                $data['va_number'] = $resultJson['va_numbers'][0];
            }
        }

        $data['detailPaymentMethod'] = $detailPaymentMethod;
        $data['result'] = $resultJson;

        return view('telkom.checkout', $data);
    }

    public function finish($transaction_id)
    {
        $result = Http::get(env('BASE_API') . '/api/payment/' . $transaction_id);
        $data = $result->json();
        $transaction_status = $data['transaction_status'];

        if ($transaction_status == 'pending')
            return redirect()
                ->route('index')
                ->with([
                    'message' => 'New data has been created successfully'
                ]);
        else if (in_array($transaction_status, ['settlement', 'capture']))
            return redirect('/')->with('error', 'Pembayaran belum kami terima. Mohon selesaikan pembayaran');
    }

}
