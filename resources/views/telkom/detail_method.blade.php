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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @else
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif


        <div class="container mt-5 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="accordion accordion-flush accordion-style-one" id="accordionStyle1">
                        <!-- Single Accordion -->
                        @foreach ($detailPaymentMethods as $detail)
                            <div class="accordion-item">
                                <div class="accordion-header d-flex align-items-center"
                                     id="accordion-{{$detail->name}}">
                                    <img style="margin:5px; width: 50px;" src="{{ url($detail->image) }}"><h6
                                        style="font-size: 16px" class="collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#accordionStyle-{{$detail->name}}" aria-expanded="false"
                                        aria-controls="accordionStyle-{{$detail->name}}" style="border-color: white;">
                                        {{ $detail->label}} <i class="bi bi-chevron-down"></i></h6>
                                </div>

                                <div class="accordion-collapse collapse" id="accordionStyle-{{$detail->name}}"
                                     aria-labelledby="accordion-{{$detail->name}}" data-bs-parent="#accordionStyle1">
                                    <div class="accordion-body">
                                        <table width="100%" class="text-primary" style="font-size: 18px">
                                            <tr>
                                                <td>Total Pembayaran</td>
                                                <td><strong class="total">Rp</strong></td>
                                                <td class=""><strong>{{number_format($data['total_bayar'], 0)}}</strong></td>
                                                {{--<td class="text-end">
                                                    <strong>{{number_format($data['total_bayar'], 0)}}</strong></td>--}}
                                            </tr>
                                            <tr>
                                                <?php
                                                $fee = $detail->fee;
                                                if (!empty($detail->percentage)) $fee += $data['total_bayar'] * $detail->percentage / 100;
                                                ?>
                                                <td>Biaya Layanan</td>
                                                <td><strong class="layanan">Rp</strong></td>
                                                <td class=""><strong>{{number_format($fee)}}</strong></td>
                                                {{--<td class="text-end"><strong>{{number_format($fee)}}</strong></td>--}}
                                            </tr>
                                            <tr>
                                                <td>Total Tagihan</td>
                                                <td><strong class="tagihan">Rp</strong></td>
                                                <td class=""><strong>{{number_format((@$fee + @$data['total_bayar']), 0)}}</strong></td>
                                                {{--<td class="text-end">
                                                    <strong>{{number_format((@$fee + @$data['total_bayar']), 0)}}</strong>
                                                </td>--}}
                                            </tr>
                                        </table>
                                    </div>
                                    @if($method == 'credit_card')
                                        <div class="form-group">
                                            <label class="mb-3">Card Number</label>
                                            <input type="text" maxlength="19" name="card_number"
                                                   class="form-control cc-number-input">
                                        </div>
                                        <div class="form-group d-flex flex-row gap-4">
                                            <div>
                                                <label class="mb-3">Expiration Date</label>
                                                <input name="card_exp_month_year" type="text" maxlength="5" placeholder="MM/YY" class="form-control cc-expiry-input">
                                            </div>
                                            <div>
                                                <label class="mb-3">CVV</label>
                                                <input name="card_cvv" type="password" maxlength="3" placeholder="xxx" class="form-control cc-cvc-input">
                                            </div>
                                        </div>

                                        <a id="btnCheckout" class="btn btn-success2 mt-3 w-100"
                                           href="#"
                                           style="border-radius: 50px;">
                                            <strong style="font-size: 15px;">Bayar dengan {{ $detail->label }}</strong>
                                        </a>
                                    @else
                                    <a class="btn btn-success2 mt-3 w-100"
                                       href="{{ route('checkout', ['method'=>$detail->name, 'id'=>$id]) }}"
                                       style="border-radius: 50px;" onclick="this.disabled = true;">
                                        <strong style="font-size: 15px;" onclick="this.disabled = true;">Bayar dengan {{ $detail->label }}</strong>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        @push('custom-scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"
                    integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script type="text/javascript">
                function checkout(tipe) {
                    window.location.replace(`{{ url("checkout/`+tipe+`/$id/`+total+`")}}`)
                }
            </script>
            @if($method == 'credit_card')
                <script src="{{asset('js/credit.js')}}"></script>
                <script id="midtrans-script" type="text/javascript"
                        src="https://api.midtrans.com/v2/assets/js/midtrans-new-3ds.min.js"
                        data-environment="sandbox"
                        data-client-key="SB-Mid-client-HmYTNhht1de678IW"></script>

                <script>
                    var i = 0;
                    let options = {
                        onSuccess: function (response) {
                            var token_id = response.token_id
                            Swal.fire({
                            title: "Terimakasih",
                            text: "Segera selesaikan pembayaran dalam 1x24 jam. E-polis akan dikirimkan melalui email segera setelah anda menyelesaikan pembayaran.",
                            icon: "success",
                            button: "OK",
                            }).then((value) => {
                                location.href = '{{ url('checkout/'.$method.'/' . $id) }}/' + token_id;   
                            });
                            
                        },
                        onFailure: function (response) {
                            console.log('Fail to get card token_id, response:', response)
                            Swal.fire(
                                'Error !',
                                'Fail to get credit card : ' + JSON.stringify(response.validation_messages),
                                'error'
                            )
                        }
                    }

                    $("#btnCheckout").click(() => {
                        let exp = $("[name=card_exp_month_year]").val().toString();
                        let month = exp.split('/')[0]
                        let year = exp.split('/')[1]
                        let cardData = {
                            "card_number": $("[name=card_number]").val(),
                            "card_exp_month": month,
                            "card_exp_year": year,
                            "card_cvv": $("[name=card_cvv]").val()
                        }
                        console.log(cardData, options);
                        MidtransNew3ds.getCardToken(cardData, options)
                    })
                    $('body').on('click', '#btn_submit', function (e) {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Terima kasih',
                text: "Cek email untuk melihat status pembayaran Credit Card. E-polis akan dikirimkan melalui email.",
                type: 'success',
                showCancelButton: false,
                }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: '{{url('finish')}}/'+id,
                        data    : {
                            "_token": "{{ csrf_token() }}",
                                id: id,
                            },
                        success: function(responseData, textStatus, jqXHR) {
                            window.location.href = '{{ route('index') }}/';
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown);
                        }
                    });
                }
            });
        });
                </script>
    @endif
    @endpush
@endsection
