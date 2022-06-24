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

        <div class="card">
            <div class="card-body">
                <div class="accordion accordion-flush accordion-style-one">
                @foreach ($paymentMethods as $paymentMethod)
                    <!-- Single Accordion -->
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <a href="{{ route('detail_method_payment', [$paymentMethod->method, $id]) }}"
                                   class="d-flex align-items-center">
                                    <img
                                        style="margin: 10px; width: 50px; height: 50px"
                                        src="{{ url($paymentMethod->image)}}">

                                    <h6 style="border-color: white;">
                                        {{ $paymentMethod->label }} <i class="bi bi-chevron-left"></i>
                                    </h6>
                                </a>
                                <hr>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
            
        @push('custom-scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"
                    integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush
@endsection
