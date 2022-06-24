@extends('template.template')

@section('konten')


    <div class="container direction-rtl">
        <div class="card-shadow-primary">
            <div class="card-body">
                <div class="card-body">
                    <h2 class="text-white text-center mb-3 mt-2" style="font-weight: 600;">Metode Pembayaran</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="container form mt-5" style="margin-bottom: 100px;">
            <form action="javascript:void(0)" method="POST" id="myform">
                @csrf

                {{--                <div class="form-group">--}}
                {{--                    <label class="mb-2 ps-3">Email</label>--}}
                {{--                    <input class="form-control mb-3" type="email" name="email_info" id="email_info"--}}
                {{--                        placeholder="Masukkan Email">--}}
                {{--                    <span class="mb-2 ps-3" style="font-size: 11px;">Kami akan mengirimkan instruksi pembayaran melalui--}}
                {{--                        email</span>--}}
                {{--                </div>--}}
                {{--                <div class="container mb-5 mt-5">--}}
                {{--                    <div class="card">--}}
                {{--                        <div class="card-body">--}}
                {{--                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">--}}
                {{--                                <!-- Single Accordion -->--}}
                {{--                                <div class="accordion-item">--}}
                {{--                                    <div class="accordion-header" id="accordionOne">--}}
                {{--                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleOne"--}}
                {{--                                            aria-expanded="true" aria-controls="accordionStyleOne" class="text-primary">--}}
                {{--                                            Instruksi Pembayaran ATM Mandiri<i class="bi bi-chevron-down"></i></h6>--}}
                {{--                                    </div>--}}
                {{--                                    <div class="accordion-collapse collapse" id="accordionStyleOne"--}}
                {{--                                        aria-labelledby="accordionOne" data-bs-parent="#accordionStyle1">--}}
                {{--                                        <div class="accordion-body">--}}
                {{--                                            <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing--}}
                {{--                                                elit. Rerum, velit?</p>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}


                @if (@$actions)
                    @if(@$detailPaymentMethod->name == 'shopeepay')
                        <a target="_blank" href="{{ $actions['url'] }}">Klik disini untuk membayar</a>
                    @else
                        <div class="d-flex flex-row justify-content-center">
                            <img width="80%" src="{{ $actions['url'] }}"/>
                        </div>
                    @endif
                                <div class="container mb-5 mt-5">
                                   <div class="card">
                                        <div class="card-body">
                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                               <!-- Single Accordion -->
                                               <div class="accordion-item">
                                                    <div class="accordion-header" id="accordionOne">
                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleOne"
                                                           aria-expanded="true" aria-controls="accordionStyleOne" class="text-primary">
                                                           Instruksi Pembayaran E-Wallet<i class="bi bi-chevron-down"></i></h6>
                                                   </div>
                                                    <div class="accordion-collapse collapse" id="accordionStyleOne"
                                                        aria-labelledby="accordionOne" data-bs-parent="#accordionStyle1">
                                                       <div class="accordion-body">
                                                 
                                                                            <p class="mb-0">
                                                                            Buka aplikasi e-wallet lainnya.
                                                                            </p>
                                                                            <p class="mb-0">     
                                                                            Pindai kode QR di monitor Anda.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Konfirmasi pembayaran di aplikasi.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pembayaran selesai.
                                                                            </p>
                                                                           
                                                       </div>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                @elseif(!empty($biller_code))
                    <div class="d-flex flex-row justify-content-center align-items-center gap-4">
                        <span>Virtual Account</span>
                        <img style="width: 50px;" src="{{ url($detailPaymentMethod->image) }}"/>
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-center gap-4">
                        <span>Biller Code: 

                            {{--<span style="letter-spacing: 5px;">{{ $biller_code }}</span>--}}
                            {{--<img onclick="copyToClipboard({{$biller_code}})" style="width: 20px; cursor: pointer;" src="{{ url('img/copy-solid.svg') }}"/> --}}

                            <span id="item-desc-{{ $biller_code }}" style="letter-spacing: 5px;">{{ $biller_code }}</span>
                            <img data-desc-ref="item-desc-{{ $biller_code }}" onclick="status(this)" style="width: 20px; cursor: pointer;" src="{{ url('img/copy-solid.svg') }}"/>
                        </span>

                        <span>
                            Biller Key:

                            {{--<span style="letter-spacing: 5px;">{{ $bill_key }}</span>--}}
                            {{--<img onclick="copyToClipboard({{ $bill_key }})" style="width: 20px; cursor: pointer;" src="{{ url('img/copy-solid.svg') }}"/> --}}

                            <span id="item-desc-{{ $bill_key }}" style="letter-spacing: 5px;">{{ $bill_key }}</span>
                            <img data-desc-ref="item-desc-{{ $bill_key }}" onclick="status(this)" style="width: 20px; cursor: pointer;" src="{{ url('img/copy-solid.svg') }}"/>
                        </span>
                    </div>

                                <div class="container mb-5 mt-5">
                                   <div class="card">
                                        <div class="card-body">
                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                               <!-- Single Accordion -->
                                               <div class="accordion-item">
                                                    <div class="accordion-header" id="accordionOne">
                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleOne"
                                                           aria-expanded="true" aria-controls="accordionStyleOne" class="text-primary">
                                                           Instruksi Pembayaran Mandiri<i class="bi bi-chevron-down"></i></h6>
                                                   </div>
                                                    <div class="accordion-collapse collapse" id="accordionStyleOne"
                                                        aria-labelledby="accordionOne" data-bs-parent="#accordionStyle1">
                                                       <div class="accordion-body">
                                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                                                <div class="accordion-item">
                                                                    <div class="accordion-header" id="accordionTwo">
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleTwo"
                                                                        aria-expanded="true" aria-controls="accordionStyleTwo" class="text-primary">
                                                                        ATM Mandiri<i class="bi bi-chevron-down"></i></h6>
                                                                    </div>
                                                                    <div class="accordion-collapse collapse" id="accordionStyleTwo"
                                                                        aria-labelledby="accordionTwo" data-bs-parent="#accordionStyle2">
                                                                        <div class="accordion-body">
                                                                            <p class="mb-0">
                                                                            Pilih bayar/beli pada menu utama.
                                                                            </p>
                                                                            <p class="mb-0">     
                                                                            Pilih yang lain.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pilih multi pembayaran.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan kode perusahaan.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan kode pembayaran, lalu konfirmasi.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                                Pembayaran selesai
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                                                <div class="accordion-item">
                                                                    <div class="accordion-header" id="accordionThree">
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleThree"
                                                                        aria-expanded="true" aria-controls="accordionStyleThree" class="text-primary">
                                                                        Internet Banking<i class="bi bi-chevron-down"></i></h6>
                                                                    </div>
                                                                    <div class="accordion-collapse collapse" id="accordionStyleThree"
                                                                        aria-labelledby="accordionThree" data-bs-parent="#accordionStyle3">
                                                                        <div class="accordion-body">
                                                                            <p class="mb-0">
                                                                            Pilih pembayaran pada menu utama.
                                                                            </p>
                                                                            <p class="mb-0">     
                                                                            Pilih multi pembayaran.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pilih dari akun.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pilih Midtrans pada form penyedia layanan.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan kode pembayaran, lalu konfirmasi.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pembayaran selesai.
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>           
                                                       </div>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                @elseif($detailPaymentMethod->name == 'permata')
                <div class="d-flex flex-row justify-content-center align-items-center gap-4">
                        <span>Virtual Account</span>
                        <img style="width: 50px;" src="{{ url($detailPaymentMethod->image) }}"/>

                        {{--<span style="letter-spacing: 5px;">{{ $result['permata_va_number'] }}</span>--}}
                        {{--<img onclick="copyToClipboard({{ $result['permata_va_number'] }})" style="width: 20px; cursor: pointer;" src="{{ url('img/copy-solid.svg') }}"/> --}}

                        <span id="item-desc-{{ $result['permata_va_number'] }}" style="letter-spacing: 5px;">{{ $result['permata_va_number'] }}</span>
                        <img data-desc-ref="item-desc-{{ $result['permata_va_number'] }}" onclick="status(this)"
                             style="width: 20px; cursor: pointer;" src="{{ url('img/copy-solid.svg') }}"/>
                    </div>
                    <div class="container mb-5 mt-5">
                                   <div class="card">
                                        <div class="card-body">
                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                               <!-- Single Accordion -->
                                               <div class="accordion-item">
                                                    <div class="accordion-header" id="accordionOne">
                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleOne"
                                                           aria-expanded="true" aria-controls="accordionStyleOne" class="text-primary">
                                                           Instruksi Pembayaran Permata<i class="bi bi-chevron-down"></i></h6>
                                                   </div>
                                                    <div class="accordion-collapse collapse" id="accordionStyleOne"
                                                        aria-labelledby="accordionOne" data-bs-parent="#accordionStyle1">
                                                       <div class="accordion-body">
                                                 
                                                                            <p class="mb-0">
                                                                            Pilih transaksi lain pada menu utama.
                                                                            </p>
                                                                            <p class="mb-0">     
                                                                            Pilih pembayaran.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pilih pembayaran lainnya.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pilih akun virtual.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan nomor virtual account, lalu konfirmasi.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pembayaran selesai.
                                                                            </p>
                                                       </div>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                @else
                    <div class="d-flex flex-row justify-content-center align-items-center gap-4">
                        <span>Virtual Account</span>
                        <img style="width: 50px;" src="{{ url($detailPaymentMethod->image) }}"/>

                        {{--<span style="letter-spacing: 5px;">{{ $va_number['va_number'] }}</span>--}}
                        {{--<img onclick="copyToClipboard({{ $va_number['va_number'] }})" style="width: 20px; cursor: pointer;" src="{{ url('img/copy-solid.svg') }}"/>--}}

                        <span id="item-desc-{{ $va_number['va_number'] }}" style="letter-spacing: 5px;">{{ $va_number['va_number'] }}</span>
                        <img data-desc-ref="item-desc-{{ $va_number['va_number'] }}" onclick="status(this)"
                             style="width: 20px; cursor: pointer;" src="{{ url('img/copy-solid.svg') }}"/>
                    </div>
                    @if($va_number['bank'] == 'bca')
                                <div class="container mb-5 mt-5">
                                   <div class="card">
                                        <div class="card-body">
                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                               <!-- Single Accordion -->
                                               <div class="accordion-item">
                                                    <div class="accordion-header" id="accordionOne">
                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleOne"
                                                           aria-expanded="true" aria-controls="accordionStyleOne" class="text-primary">
                                                           Instruksi Pembayaran BCA<i class="bi bi-chevron-down"></i></h6>
                                                   </div>
                                                    <div class="accordion-collapse collapse" id="accordionStyleOne"
                                                        aria-labelledby="accordionOne" data-bs-parent="#accordionStyle1">
                                                       <div class="accordion-body">
                                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                                                <div class="accordion-item">
                                                                    <div class="accordion-header" id="accordionTwo">
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleTwo"
                                                                        aria-expanded="true" aria-controls="accordionStyleTwo" class="text-primary">
                                                                        ATM BCA<i class="bi bi-chevron-down"></i></h6>
                                                                    </div>
                                                                    <div class="accordion-collapse collapse" id="accordionStyleTwo"
                                                                        aria-labelledby="accordionTwo" data-bs-parent="#accordionStyle2">
                                                                        <div class="accordion-body">
                                                                            <p class="mb-0">
                                                                                Pilih Transaksi Lainnya pada menu utama.
                                                                            </p>
                                                                            <p class="mb-0">     
                                                                                Pilih Transfer.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                                Pilih Ke Rekening Virtual BCA.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                                 Masukkan Nomor Virtual Account BCA.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                                Masukkan jumlah yang harus dibayar. Dan konfirmasi pembayaran
                                                                            </p>
                                                                            <p class="mb-0">
                                                                                Pembayaran selesai
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                                                <div class="accordion-item">
                                                                    <div class="accordion-header" id="accordionThree">
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleThree"
                                                                        aria-expanded="true" aria-controls="accordionStyleThree" class="text-primary">
                                                                        Klik BCA<i class="bi bi-chevron-down"></i></h6>
                                                                    </div>
                                                                    <div class="accordion-collapse collapse" id="accordionStyleThree"
                                                                        aria-labelledby="accordionThree" data-bs-parent="#accordionStyle3">
                                                                        <div class="accordion-body">
                                                                            <p class="mb-0">
                                                                            Pilih Transfer Dana.
                                                                            </p>
                                                                            <p class="mb-0">     
                                                                            Pilih Transfer ke BCA Virtual Account.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan Nomor Virtual Account BCA.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan jumlah yang harus dibayar.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Konfirmasi pembayaran.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pembayaran selesai.
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                                                <div class="accordion-item">
                                                                    <div class="accordion-header" id="accordionFour">
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleFour"
                                                                        aria-expanded="true" aria-controls="accordionStyleFour" class="text-primary">
                                                                        M-BCA<i class="bi bi-chevron-down"></i></h6>
                                                                    </div>
                                                                    <div class="accordion-collapse collapse" id="accordionStyleFour"
                                                                        aria-labelledby="accordionFour" data-bs-parent="#accordionStyle4">
                                                                        <div class="accordion-body">
                                                                            <p class="mb-0">
                                                                            Pilih m-Transfer.
                                                                            </p>
                                                                            <p class="mb-0">     
                                                                            Pilih Virtual Account BCA.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan Nomor Virtual Account BCA.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan jumlah yang harus dibayar.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Konfirmasi pembayaran.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pembayaran selesai.
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>            
                                                       </div>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    @elseif($va_number['bank'] == 'bni')
                                <div class="container mb-5 mt-5">
                                   <div class="card">
                                        <div class="card-body">
                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                               <!-- Single Accordion -->
                                               <div class="accordion-item">
                                                    <div class="accordion-header" id="accordionOne">
                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleOne"
                                                           aria-expanded="true" aria-controls="accordionStyleOne" class="text-primary">
                                                           Instruksi Pembayaran BNI<i class="bi bi-chevron-down"></i></h6>
                                                   </div>
                                                    <div class="accordion-collapse collapse" id="accordionStyleOne"
                                                        aria-labelledby="accordionOne" data-bs-parent="#accordionStyle1">
                                                       <div class="accordion-body">
                                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                                                <div class="accordion-item">
                                                                    <div class="accordion-header" id="accordionTwo">
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleTwo"
                                                                        aria-expanded="true" aria-controls="accordionStyleTwo" class="text-primary">
                                                                        ATM BNI<i class="bi bi-chevron-down"></i></h6>
                                                                    </div>
                                                                    <div class="accordion-collapse collapse" id="accordionStyleTwo"
                                                                        aria-labelledby="accordionTwo" data-bs-parent="#accordionStyle2">
                                                                        <div class="accordion-body">
                                                                            <p class="mb-0">
                                                                            Pilih Lainnya pada menu utama.
                                                                            </p>
                                                                            <p class="mb-0">     
                                                                                Pilih Transfer.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pilih Dari Rekening Tabungan.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pilih Ke Rekening BNI.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan Nomor Rekening Pembayaran.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan jumlah yang harus dibayar.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pembayaran selesai.
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                                                <div class="accordion-item">
                                                                    <div class="accordion-header" id="accordionThree">
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleThree"
                                                                        aria-expanded="true" aria-controls="accordionStyleThree" class="text-primary">
                                                                        Internet Banking<i class="bi bi-chevron-down"></i></h6>
                                                                    </div>
                                                                    <div class="accordion-collapse collapse" id="accordionStyleThree"
                                                                        aria-labelledby="accordionThree" data-bs-parent="#accordionStyle3">
                                                                        <div class="accordion-body">
                                                                            <p class="mb-0">
                                                                            Pilih Transaksi > Info Administrasi Transfer.
                                                                            </p>
                                                                            <p class="mb-0">     
                                                                            Pilih Setel Akun Tujuan.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan info akun > Konfirmasi.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pilih Transfer > Transfer ke Rekening BNI.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan detail pembayaran > Konfirmasi.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pembayaran selesai.
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                                                <div class="accordion-item">
                                                                    <div class="accordion-header" id="accordionFour">
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleFour"
                                                                        aria-expanded="true" aria-controls="accordionStyleFour" class="text-primary">
                                                                        Mobile Banking<i class="bi bi-chevron-down"></i></h6>
                                                                    </div>
                                                                    <div class="accordion-collapse collapse" id="accordionStyleFour"
                                                                        aria-labelledby="accordionFour" data-bs-parent="#accordionStyle4">
                                                                        <div class="accordion-body">
                                                                            <p class="mb-0">
                                                                            Pilih Transfer.
                                                                            </p>
                                                                            <p class="mb-0">     
                                                                            Pilih Virtual Account .
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pilih rekening debit yang ingin Anda gunakan.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan Nomor Virtual Account.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Konfirmasi pembayaran.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pembayaran selesai.
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>            
                                                       </div>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    @elseif($va_number['bank'] == 'bri')
                                <div class="container mb-5 mt-5">
                                   <div class="card">
                                        <div class="card-body">
                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                               <!-- Single Accordion -->
                                               <div class="accordion-item">
                                                    <div class="accordion-header" id="accordionOne">
                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleOne"
                                                           aria-expanded="true" aria-controls="accordionStyleOne" class="text-primary">
                                                           Instruksi Pembayaran BRI<i class="bi bi-chevron-down"></i></h6>
                                                   </div>
                                                    <div class="accordion-collapse collapse" id="accordionStyleOne"
                                                        aria-labelledby="accordionOne" data-bs-parent="#accordionStyle1">
                                                       <div class="accordion-body">
                                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                                                <div class="accordion-item">
                                                                    <div class="accordion-header" id="accordionTwo">
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleTwo"
                                                                        aria-expanded="true" aria-controls="accordionStyleTwo" class="text-primary">
                                                                        ATM BRI<i class="bi bi-chevron-down"></i></h6>
                                                                    </div>
                                                                    <div class="accordion-collapse collapse" id="accordionStyleTwo"
                                                                        aria-labelledby="accordionTwo" data-bs-parent="#accordionStyle2">
                                                                        <div class="accordion-body">
                                                                            <p class="mb-0">
                                                                            Pilih Lainnya pada menu utama.
                                                                            </p>
                                                                            <p class="mb-0">     
                                                                            Pilih pembayaran.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pilih lainnya.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pilih BRIVA.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan nomor BRIVA, lalu konfirmasi.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pembayaran selesai.
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                                                <div class="accordion-item">
                                                                    <div class="accordion-header" id="accordionThree">
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleThree"
                                                                        aria-expanded="true" aria-controls="accordionStyleThree" class="text-primary">
                                                                        IB BRI<i class="bi bi-chevron-down"></i></h6>
                                                                    </div>
                                                                    <div class="accordion-collapse collapse" id="accordionStyleThree"
                                                                        aria-labelledby="accordionThree" data-bs-parent="#accordionStyle3">
                                                                        <div class="accordion-body">
                                                                            <p class="mb-0">
                                                                            Pilih pembayaran & pembelian.
                                                                            </p>
                                                                            <p class="mb-0">     
                                                                            Pilih BRIVA.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan Nomor BRIVA, lalu konfirmasi.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pembayaran selesai
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                                                                <div class="accordion-item">
                                                                    <div class="accordion-header" id="accordionFour">
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleFour"
                                                                        aria-expanded="true" aria-controls="accordionStyleFour" class="text-primary">
                                                                        BRImo<i class="bi bi-chevron-down"></i></h6>
                                                                    </div>
                                                                    <div class="accordion-collapse collapse" id="accordionStyleFour"
                                                                        aria-labelledby="accordionFour" data-bs-parent="#accordionStyle4">
                                                                        <div class="accordion-body">
                                                                            <p class="mb-0">
                                                                            Pilih pembayaran.
                                                                            </p>
                                                                            <p class="mb-0">     
                                                                            Pilih BRIVA.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Masukkan Nomor BRIVA, lalu konfirmasi.
                                                                            </p>
                                                                            <p class="mb-0">
                                                                            Pembayaran selesai
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>            
                                                       </div>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    @else
                    @endif
                @endif

                <div class="form-group">
                    <label class="mb-2 ps-3">Jumlah Pembayaran</label>
                    <input class="form-control mb-3" type="text" id="total" value="{{number_format($result['gross_amount'], 0)}}"
                           disabled>
                </div>

                <div class="form-group">
                    <label class="mb-2 ps-3">Order ID</label>
                    <input class="form-control mb-3" type="text" id="id" value="{{ $result['order_id'] }}" disabled>
                </div>
                 
                <!-- {{ route('finish', $result['transaction_id']) }} -->
                <a href="#" id="btn_submit"
                   class="btn btn-success2 mt-3 w-100" type="submit" style="border-radius: 50px;">
                    <strong style="font-size: 15px;">Bayar Sekarang</strong>
                </a>
            </form>
        </div>

        @push('custom-scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"
                    integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
            <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    
            <script>
            $('body').on('click', '#btn_submit', function (e) {
                var id = $(this).data('id');
                Swal.fire({
                title: "Terimakasih",
                text: "Segera selesaikan pembayaran dalam 1x24 jam. E-polis akan dikirimkan melalui email segera setelah anda menyelesaikan pembayaran.",
                icon: "success",
                button: "OK",
                }).then((value) => {
                    window.location.assign('https://tsel.retail.tugu.biz/');
                    
                });
            });
            //$('body').on('click', '#btn_submit', function (e) {
            //var id = $(this).data('id');
            //Swal.fire({
            //    title: 'Terima kasih',
            //    text: "Segera selesaikan pembayaran dalam 1x24 jam. E-polis akan dikirimkan melalui email segera setelah anda menyelesaikan pembayaran.",
            //    type: 'success',
            //    showCancelButton: false,
            //    }).then((result) => {
            //    if (result.value) {
            //        $.ajax({
            //            type: "POST",
            //            url: '{{url('finish')}}/'+id,
            //            data    : {
            //                "_token": "{{ csrf_token() }}",
            //                    id: id,
            //                },
            //            success: function(responseData, textStatus, jqXHR) {
            //                window.location.href = '{{ route('index') }}/';
            //            },
            //            error: function(jqXHR, textStatus, errorThrown) {
            //                console.log(errorThrown);
            //            }
            //        });
            //    }
          //  });
        //});

                //function copyToClipboard(text) {
                //    if (navigator.clipboard && window.isSecureContext) {
                //        return navigator.clipboard.writeText(text)
                //    } else {
                //        // text area method
                //        let textArea = document.createElement("textarea")
                //        textArea.value = text
                        // make the textarea out of viewport
                //        textArea.style.position = "fixed"
                //        textArea.style.left = "-999999px"
                //        textArea.style.top = "-999999px"
                //        document.body.appendChild(textArea)
                //        textArea.focus()
                //        textArea.select()
                //        return new Promise((res, rej) => {
                            // here the magic happens
                //            document.execCommand('copy') ? res() : rej()
                //            textArea.remove()
                //        })
                //    }
                //}

            function copyToClipboard(text) {
                if (window.clipboardData && window.clipboardData.setData) {
                    // IE specific code path to prevent textarea being shown while dialog is visible.
                    return clipboardData.setData("Text", text);

                } else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
                    var textarea = document.createElement("textarea");
                    textarea.textContent = text;
                    textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
                    document.body.appendChild(textarea);
                    textarea.select();
                    try {
                    return document.execCommand("copy"); // Security exception may be thrown by some browsers.
                    } catch (ex) {
                    console.warn("Copy to clipboard failed.", ex);
                    return false;
                    } finally {
                    document.body.removeChild(textarea);
                    }
                }
            }

            function status(clickedBtn) {
                var text = document.getElementById(clickedBtn.dataset.descRef).innerText;

                copyToClipboard(text);

                clickedBtn.value = "Copied";
                //clickedBtn.disabled = true;
                clickedBtn.style.color = 'white';
                clickedBtn.style.background = 'gray';
            }
            </script>
    @endpush
@endsection
