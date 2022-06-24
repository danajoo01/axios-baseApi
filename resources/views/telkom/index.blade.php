@extends('template.template')

@section('konten')
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  /*padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 100%;
  /*height: 100%; */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: #000;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: white;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: white;
  color: white;
}
</style>
    <div class="container direction-rtl">
        <div class="pb-5"></div>
        <div class="element-heading d-flex align-items-center">
            <div class="user-profile"><img src="img/icons/illustrasi-traveling.png"></div>
            <div class="user-info">
                <div class="d-flex align-items-center">
                    <h2 class="ps-3 text-primary" style="font-weight:700;">Asuransi Perjalanan (Travel)</h2>
                </div>
            </div>
        </div>

        <div class="card-primary">
            <div class="card-body">
                <div class="card-body">
                    <h6 class="text-white text-center mb-3 mt-2" style="font-weight: 600;">Masukkan Kode Voucher
                        Kamu</h6>
                    <div class="chat-footer-content h-100 d-flex align-items-center mb-2">
                        <form action="#">
                            <!-- Message -->
                            <input class="form-control" type="text" name="kode_voucher" id="kode_voucher"
                                placeholder="Masukkan kode voucher...">
                            <button class="btn btn-success2" type="button" onclick="cekVoucher()"
                                style="border-radius: 50px;">
                                <b style="font-size: 15px;">Gunakan</b>
                            </button>
                        </form>
                    </div>
                    <div class="col s6" id="sukses_voucher">
                        <div class="alert alert-success mt-4">
                            <ul>
                                Sukses, Voucher berhasil digunakan.
                            </ul>
                        </div>
                    </div>

                    <div class="col s6" id="gagal_voucher">
                        <div class="alert alert-danger mt-4">
                            <ul>
                                Gagal, kode voucher salah atau expired!
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>






    <div class="container form mt-5" style="margin-bottom: 100px;">
        <form id="myform" method="POST" action="javascript:void(0)">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="mb-2 ps-3">Nama Lengkap</label>
                <input class="form-control mb-3 @error('nama_lengkap') is-invalid @enderror" type="text"
                    value="{{ old('nama_lengkap') }}" id="nama_lengkap" name="nama_lengkap"
                    placeholder="Masukkan Nama Lengkap">
                <!-- error message untuk title -->
                @error('nama_lengkap')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="mb-2 ps-3">Jenis Kelamin</label>
                <div class="h-100 d-flex align-items-center mb-2">
                    <div class="form-check ps-5  me-4">
                        <input class="form-check-input form-check-success2 jns_kelamin" type="radio" checked
                            name="jns_kelamin" value="L" id="laki">
                        <label class="form-check-label ps-2" for="laki">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input form-check-success2 jns_kelamin" type="radio" name="jns_kelamin"
                            value="P" id="perempuan">
                        <label class="form-check-label ps-2" for="perempuan">Perempuan</label>
                    </div>
                    @error('jns_kelamin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="mb-2 ps-3">No. Telp</label>
                <input class="form-control mb-3 @error('no_telp') is-invalid @enderror" type="text"
                    value="{{ old('no_telp') }}" id="no_telp" name="no_telp" placeholder="Masukkan Nomor Telepon">
                @error('no_telp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mb-2 ps-3">Email</label> <i class="text-mute" hidden>*Jadikan email ini untuk mengirim polish</i><input class="form-check-input form-check-primary mt-0" checked id="email_send_info" name="email_send_info" type="checkbox" value=""
                style="border-radius: 50%; margin-left:2%" hidden>
                <input class="form-control mb-3 @error('email') is-invalid @enderror" type="email"
                    value="{{ old('email') }}" id="email" name="email" placeholder="Masukkan Email">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group" id="email_send_info_input">
                <label class="mb-2 ps-3">Email Pengiriman Polish</label>
                <input class="form-control mb-3 @error('email_send_info') is-invalid @enderror" type="email" id="email_send_info_input_text"
                    value="{{ old('email_send_info') }}" name="email_send_info" placeholder="Masukkan email untuk mengirim file polish">
                @error('email_send_info')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mb-2 ps-3">Nomor KTP/Paspor</label>
                <input class="form-control mb-3 @error('ktp_passpor') is-invalid @enderror"
                    value="{{ old('ktp_passpor') }}" id="ktp_passpor" name="ktp_passpor" type="text"
                    placeholder="Masukkan Nomor KTP / Paspor">
                @error('ktp_passpor')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mb-2 ps-3">Alamat</label>
                <input class="form-control mb-3 @error('alamat') is-invalid @enderror" type="text"
                    value="{{ old('alamat') }}" id="alamat" name="alamat"
                    placeholder="Masukkan Nama Lengkap">
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mb-2 ps-3">Tanggal Lahir</label>
                <input class="form-control mb-3 @error('tgl_lahir') is-invalid @enderror"
                    value="{{ old('tgl_lahir') }}" id="tgl_lahir" name="tgl_lahir" type="date"
                    placeholder="Masukkan Tanggal Lahir">
                @error('tgl_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mb-2 ps-3">Usia</label>
                <input class="form-control mb-3 @error('usia') is-invalid @enderror dateusia" value="{{ old('usia') }}"
                    name="usia" id="usia" type="number" placeholder="Masukkan Usia" disabled>
                @error('usia')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mb-2 ps-3">Pekerjaan</label>
                <input class="form-control mb-3 @error('pekerjaan') is-invalid @enderror"
                    value="{{ old('pekerjaan') }}" id="pekerjaan" name="pekerjaan" type="text"
                    placeholder="Masukkan Pekerjaan">
                @error('pekerjaan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mb-2 ps-3">Tanggal Keberangkatan</label>
                <input class="form-control mb-3 @error('tgl_keberangkatan') is-invalid @enderror"
                    value="{{ old('tgl_keberangkatan') }}" id="tgl_keberangkatan" name="tgl_keberangkatan" type="date"  placeholder="dd/mm/yyyy">
                @error('tgl_keberangkatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{--
            <div class="form-group">
                <label class="mb-2 ps-3">Kota Keberangkatan</label>
                <input class="form-control mb-3 @error('kota_asal') is-invalid @enderror"
                    value="{{ old('kota_asal') }}" id="kota_asal" name="kota_asal" type="text"
                    placeholder="Masukkan Kota Keberangkatan">
                @error('kota_asal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>--}}
            <div class="form-group">
                <label class="mb-2 ps-3">Negera Tujuan</label>
                <input class="form-control mb-3 @error('negara_tujuan') is-invalid @enderror"
                    value="{{ old('negara_tujuan') }}" id="negara_tujuan" name="negara_tujuan" type="text"
                    placeholder="Masukkan Negara Tujuan">
                @error('negara_tujuan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mb-2 ps-3">Mode Angkutan</label>
                <input class="form-control mb-3 @error('mode_angkutan') is-invalid @enderror"
                    value="{{ old('mode_angkutan') }}" id="mode_angkutan" name="mode_angkutan" type="text"
                    placeholder="Masukkan Mode Angkutan">
                @error('mode_angkutan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mb-2 ps-3">Ahli Waris</label>
                <input class="form-control mb-3 @error('ahli_waris') is-invalid @enderror"
                    value="{{ old('ahli_waris') }}" id="ahli_waris" name="ahli_waris" type="text"
                    placeholder="Masukkan Ahli Waris">
                @error('ahli_waris')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="mb-2 ps-3">Status Hubungan</label>
                <input class="form-control mb-3 @error('status_hubungan') is-invalid @enderror"
                    value="{{ old('status_hubungan') }}" id="status_hubungan" name="status_hubungan" type="text"
                    placeholder="Masukkan Status Hubungan">
                @error('status_hubungan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="mb-2 ps-3">Limit</label>
                <div id="fill_limit">

                </div>
            </div>

            <div class="form-group">
                <label class="mb-2 ps-3">Periode</label>
                <div class="h-100 d-flex align-items-center mb-2" id="fill_periode"></div>
            </div>

            <div class="d-flex">
                <div class="form-group" id="tanggal_periode_dari">
                    <label class="mb-2 ps-3">Dari :</label>
                    <input class="form-control mb-3"
                        id="periode_polis_start" value="" name="periode_polis_start"
                        type="date" placeholder="Masukkan Range Periode" disabled>
                    @error('periode_polis_start')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group ps-3" id="tanggal_periode_sampai">
                    <label class="mb-2 ps-3">Sampai :</label>
                    <input class="form-control mb-3 "
                        value="" id="periode_polis_end" name="periode_polis_end"
                        type="date" placeholder="Masukkan Range Periode" disabled>
                    @error('periode_polis_end')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="mb-2 ps-3">Keterangan Produk</label>
                <div class="card-secondary">
                    <div class="card-body">
                        <div class="card-body">
                            {{--<p class="text-primary" style="line-height: normal;" id="keterangan_produk">--}}
                            <p class="text-primary" style="line-height: normal;">
                            <a id="myBtn" data-toggle="modal" data-target="#myModal"><strong> Klik disini</strong></a>  preview slip quotation 
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-check ps-5">
                <input class="form-check-input form-check-primary termCheck" id="termCheck_1" type="checkbox" value=""
                    style="border-radius: 50%;">
                <label class="form-check-label ps-2" for="termCheck">Saya Menyetujui <a id="ToCFile"
                        target="_blank"><strong>Syarat dan Ketentuan yang
                            terlaku</strong></a></label>
            </div>
            <div class="form-check ps-5 mt-3">
                <input class="form-check-input form-check-primary termCheck" id="termCheck_2" type="checkbox" value=""
                    style="border-radius: 50%;">
                <label class="form-check-label ps-2" for="termCheck">Saya telah mengisi data dengan jujur dan sesuai dengan keadaan sebenarnya</label>
            </div>

            <div class="container mt-4 mb-5 ps-4">
                <table width="100%" class="text-primary" style="font-size: 16px">
                    <tr>
                        <td>Premi</td>
                        <input type="hidden" name="premi" id="premi">
                        <td><strong id="value_premi">Rp 0</strong></td>
                    </tr>
                    <tr>
                        <td>Diskon</td>
                        <input type="hidden" name="diskon" id="diskon" value="0">
                        <td><strong id="value_diskon">Rp 0</strong></td>
                    </tr>
                    <tr>
                        <td>Biaya Admin & Materai</td>
                        <input type="hidden" name="materai" id="materai" value="12500">
                        <td><strong id="value_materai">Rp 0</strong></td>
                    </tr>
                    <tr>
                        <td>Total Bayar</td>
                        <input type="hidden" name="total" id="total">
                        <td><strong id="value_total">Rp 0</strong></td>
                    </tr>
                </table>
            </div>

            <div class="form-check ps-5">
                <input class="form-check-input form-check-primary termCheck" id="termCheck_3" type="checkbox" value=""
                    style="border-radius: 50%;">
                {{--<label class="form-check-label ps-2" for="termCheck"><a id="myBtn" data-toggle="modal" data-target="#myModal"><strong> Klik disini</strong></a> apabila tertanggung setuju untuk menerima polis hanya dalam bentuk digital (E-Polis)</label>--}}
                <label class="form-check-label ps-2" for="termCheck">Setuju untuk menerima polis hanya dalam bentuk digital (E-Polis)</label>
            </div>

            <button type="button" href="javascript:void(0)" onclick="postData()" id="btn_submit"
                class="btn btn-success2 mt-3 w-100" type="submit" style="border-radius: 50px;"><b
                    style="font-size: 15px;">Setuju & Lanjutkan Pembayaran</b></button>
        </form>
    </div>
            <!-- Modal -->
            <!-- The Modal -->
            <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                <span class="close">&times;</span>
                <h6>Draft Quotation Slip Ttravela Telkomsel</h6>
                </div>
                <div class="modal-body" style="color: black;">
               

                <p style="text-align: center;font-size: 12px;"><strong>SLIP PENAWARAN / <em>QUOTATION SLIP</em></strong></p>
			<p style="text-align: center;font-size: 12px;"><strong>ASURANSI PERJALANAN / <em>TRAVEL INSURANCE</em></strong></p>
			<p style="text-align: center;font-size: 12px;"><strong>T TRAVELLA</strong></p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p style="text-align: right;font-size: 10px;"><strong>NEW BUSINESS</strong></p>
			<table style="font-size: 10px;border-collapse: collapse; width:100%; text-align: left" width="">
			   <tbody>

				  <tr>
				 
					 <td width="216" style="border-top: 1px solid;">
						<p style="margin: auto;"><strong>Nama Tertanggung</strong></p>
						<p style="margin-top: 0px;"><strong>Name of Insured</strong></p>
					 </td>
					 <td width="19" style="border-top: 1px solid;">
						<p style="margin: auto;">:</p>
					 </td>
					 <td width="" style="border-top: 1px solid;">
						<p style="margin: auto;">Bapak/Ibu <span id="nama_lengkap_t"></span> </p>
					 </td>
					
				  </tr>
				  <tr>
			
					 <td width="216" style="border-top: 1px solid;">
						<p style="margin: auto;"><strong>Alamat Tertanggung</strong></p>
						<p style="margin-top: 0px;"><strong>Address of Insured</strong></p>
					 </td>
					 <td width="19" style="border-top: 1px solid;">
						<p style="margin: auto;">:</p>
					 </td>
					 <td width="" style="border-top: 1px solid;">
						<p style="margin: auto;" id="alamat_t"></p>
					 </td>
					 
				  </tr>
				  <tr>
				 
					 <td width="216" style="border-top: 1px solid;">
						<p style="margin: auto;"><strong>Tempat/Tanggal Lahir</strong></p>
						<p style="margin-top: 0px;"><strong>Place/Date of Birth</strong></p>
					 </td>
					 <td width="19" style="border-top: 1px solid;">
						<p style="margin: auto;">:</p>
					 </td>
					 <td width="" style="border-top: 1px solid;">
						<p style="margin: auto;" id="tgl_lahir_t"></p>
					 </td>
				  </tr>
				  <tr>
				  
					 <td width="216" style="border-top: 1px solid;">
						<p style="margin: auto;"><strong>Tanda Pengenal</strong></p>
						<p style="margin-top: 0px;"><strong>Identification</strong></p>
					 </td>
					 <td width="19" style="border-top: 1px solid;">
						<p style="margin: auto;">:</p>
					 </td>
					 <td width="" style="border-top: 1px solid;">
						<p style="margin: auto;" id="ktp_passpor_t"></p>
					 </td>
				  </tr>
				  <tr>
				 
					 <td width="216" style="border-top: 1px solid;">
						<p style="margin: auto;"><strong>Pekerjaan</strong></p>
						<p style="margin-top: 0px;"><strong>Occupation</strong></p>
					 </td>
					 <td width="19" style="border-top: 1px solid;">
						<p style="margin: auto;">:</p>
					 </td>
					 <td width="" style="border-top: 1px solid;">
						<p style="margin: auto;" id="pekerjaan_t"></p>
					 </td>
				  </tr>
				  <tr>
				  
					 <td width="216" style="border-top: 1px solid;">
						<p style="margin: auto;"><strong>Ahli Waris / Hubungan</strong></p>
						<p style="margin-top: 0px;"><strong>Beneficiary Name / Relation</strong></p>
					 </td>
					 <td width="19" style="border-top: 1px solid;">
						<p style="margin: auto;">:</p>
					 </td>
					 <td width="" style="border-top: 1px solid;">
						<p style="margin: auto;"><span id="ahli_waris_t"></span> - <span id="status_hubungan_t"></p>  
					 </td>
				  </tr>
				  <tr>
				 
					 <td width="216" style="border-top: 1px solid;">
						<p style="margin: auto;"><strong>Periode Pertanggungan</strong></p>
						<p style="margin-top: 0px;"><strong>Period of Insurance</strong></p>
					 </td>
					 <td width="19" style="border-top: 1px solid;">
						<p style="margin: auto;">:</p>
					 </td>
					 <td width="" style="border-top: 1px solid;">
                        <p style="margin: auto;">Mulai dari <span id="start"></span> s.d <span id="end"></span></p>
						<p style="margin: auto;">Start from <span id="start_eng"></span> to <span id="end_eng"></span></p>
					 </td>
				  </tr>
				  <tr>
				
					 <td width="216" style="border-top: 1px solid;">
						<p style="margin: auto;"><strong>Mata Uang</strong></p>
						<p style="margin-top: 0px;"><strong>Currency</strong></p>
					 </td>
					 <td width="19" style="border-top: 1px solid;">
						<p style="margin: auto;">:</p>
					 </td>
					 <td width="" style="border-top: 1px solid;">
						<p style="margin-top: 0px;">Indonesian Rupiah (IDR)</p>
					 </td>
				  </tr>
				  <tr>
			
					 <td width="216" style="border-top: 1px solid;">
						<p style="margin: auto;"><strong>Batas Ganti Rugi</strong></p>
						<p style="margin-top: 0px;"><strong>Limit of Indemnity</strong></p>
					 </td>
					 <td width="19" style="border-top: 1px solid;">
						<p style="margin: auto;">:</p>
					 </td>
					 <td width="" style="border-top: 1px solid;">
						<p style="margin: auto;" id="limit_t"></p>
					 </td>
				  </tr>
				  <tr>
		
					 <td width="216" style="border-top: 1px solid;">
						<p style="margin: auto;"><strong>Negara Tujuan </strong></p>
						<p style="margin-top: 0px;"><strong>Destination</strong></p>
					 </td>
					 <td width="19" style="border-top: 1px solid;">
						<p style="margin: auto;">:</p>
					 </td>
					 <td width="" style="border-top: 1px solid;">
						<p style="margin: auto;" id="negara_tujuan_t"></p>
					 </td>
				  </tr>
				  <tr>
					 <td width="216" style="border-top: 1px solid;">
						<p style="margin: auto;"><strong>Moda Angkutan</strong></p>
						<p style="margin-top: 0px;"><strong>Transportation</strong></p>
					 </td>
					 <td width="19" style="border-top: 1px solid;">
						<p style="margin: auto;">:</p>
					 </td>
					 <td width="" style="border-top: 1px solid;">
						<p style="margin: auto;" id="mode_angkutan_t"></p>
					 </td>
				  </tr>
			   </tbody>
			</table>
       </center>
		
		<p style="font-size: 10px;margin: auto;border-top: 1px solid;"><strong>Premi</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="premi_t"></span> IDR</p>
		<p style="font-size: 10px;margin: auto;"><strong>Premium</strong></p>
		<p style="font-size: 10px;margin: auto;"><strong>Biaya Admin dan Materai</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="adm"> - </span> IDR</p>
		<p style="font-size: 10px;margin: auto;"><strong>Adm & Materai fee</strong></p>
        <p style="font-size: 10px;margin: auto;"><strong>Diskon</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="diskons"></span> IDR</p>
		<p style="font-size: 10px;margin: auto;"><strong>Discount</strong></p>
		<p style="font-size: 10px;margin: auto;"><strong>Premi Neto</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="total_bayar_t"></span> IDR</p>
		<p style="font-size: 10px;margin: auto;"><strong>Net Premium</strong></p>
		<br><br><br><br><br><br><br><br><br>
		
			<p style="text-align: center;font-size: 11px;"><strong>TABEL MANFAAT PRODUK STANDAR / <em>STANDARD PRODUCT BENEFIT TABLE</em></strong></p>
			<p style="text-align: center;font-size: 11px;"><strong>ASURANSI ASURANSI PERJALANAN / <em>TRAVEL INSURANCE</em></strong></p>
			<p style="text-align: center;font-size: 11px;"><strong>T TRAVELLA - INTERNASIONAL STANDAR</strong></p>
			<p>&nbsp;</p>

    <table id="opsi1" style="font-size: 10px;border-collapse: collapse; width:100%;" cellspacing=0 border=1>
    <tbody style="border-color: black;border-style: none;border-width: 0;">
					<tr>

						<td colspan="4" style="min-width:50px;background-color: #D9E1F2;">Opsi 1</td>
			
					</tr>
					<tr>

						<td colspan="4" style="min-width:50px;background-color: #FFE699;border-bottom: none;">Period of cover : 30 days (as per Telkomsel Package)</td>
	
					</tr>
					<tr>

						<td colspan="4" style="min-width:50px;background-color: #FFE699;border-top: none;border-bottom: none;">Premium : Rp. 436.000</td>

					</tr>
					<tr>
						<td colspan="4" style="min-width:50px;background-color: #FFE699;border-top: none;">Administration cost : Rp. 12.500</td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #D9E1F2;"></td>
						<td style="min-width:50px;background-color: #D9E1F2;">LUAS JAMINAN / COVERAGE</td>
						<td style="min-width:50px;background-color: #D9E1F2;">MANFAAT / BENEFIT</td>
						<td style="min-width:50px;background-color: #D9E1F2;">BATASAN GANTI RUGI / LIMIT OF LIABILITY</td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="5">A</td>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="5">Biaya Pengobatan & Layanan Darurat / Emergency Service Expenses</td>
						<td style=min-width:50px>Biaya Pengobatan dan Rawat Inap / Medical and hospitalization expenses</td>
						<td style=min-width:50px>Rp 500.000.000</td>
					</tr>
					<tr>
						
						
						<td style=min-width:50px>Biaya Transportasi atau Repatriasi Ketika Sakit atau Kecelakaan / Transport or repatriation in the event of illness or accident expenses</td>
						<td style=min-width:50px>Rp 500.000.000</td>
					</tr>
					<tr>
						
						
						<td style=min-width:50px>Biaya Repatriasi Jenazah / Repatriation of Mortal Remain expenses</td>
						<td style=min-width:50px>Rp 500.000.000</td>
					</tr>
					<tr>
						
						
						<td style=min-width:50px>Biaya Perjalanan Salah Satu Anggota Keluarga Dekat / Travel of one immediate family member expenses</td>
						<td style=min-width:50px>Rp 25.000.000</td>
					</tr>
					<tr>
						
						
						<td style=min-width:50px>Biaya penjagaan/pedampingan anak / Child Guard expenses</td>
						<td style=min-width:50px>Rp 1.500.000</td>
					</tr>
					<tr>
						
						
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #C6E0B4;">B</td>
						<td style="min-width:50px;background-color: #C6E0B4;">Biaya Pembatalan atau Pengurangan Perjalanan / Travel Cancellation or Curtailment Expenses</td>
						<td style=min-width:50px>Biaya pembatalan atau pengurangan perjalanan / Travel cancellation or curtailment expenses</td>
						<td style=min-width:50px>Rp 10.000.000</td>
					</tr>
					<tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="4">C</td>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="4">Manfaat Atas Kehilangan dan Penundaan / Benefits for Losses dan Delay</td>
						<td style=min-width:50px>Gangguan perjalanan / Travel disruption</td>
						<td style=min-width:50px>Rp 5.000.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Penundaan perjalanan / Travel postponement</td>
						<td style=min-width:50px>Rp 5.000.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Tertinggal perjalanan lanjutan / Travel misconnection</td>
						<td style=min-width:50px>Rp 2.500.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Keterlambatan keberangkatan / Delayed Departure</td>
						<td style=min-width:50px>Rp 2.500.000</td>
					</tr>
					<tr>

						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="4">D</td>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="4">Manfaat Untuk Barang Bawaan / Benefits For Luggage</td>
						<td style=min-width:50px>Kompensasi kehilangan di dalam pesawat, perampokan atau perusakan bagasi / Compensation for in-flight loss, robbery or destruction of baggage checked-in</td>
						<td style=min-width:50px>Rp 5.000.000 (max. Rp 1.000.000 per item)</td>
					</tr>
					<tr>

						<td style=min-width:50px>Keterlambatan kedatangan bagasi / Delay in the arrival of luggage</td>
						<td style=min-width:50px>Rp 2.500.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Kehilangan paspor, SIM atau KTP / Loss of passport, driving license or ID Card</td>
						<td style=min-width:50px>Rp 2.500.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Penemuan dan pengiriman bagasi dan barang pribadi / Discovery & delivery of luggage and personal effects</td>
						<td style=min-width:50px>Rp 1.000.000</td>
					</tr>
					<tr>

						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="4">E</td>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="4">Manfaat Tambahan / Additional Benefit</td>
						<td style=min-width:50px>Pengiriman obat-obatan / Drugs delivery</td>
						<td style=min-width:50px>Rp 1.000.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Pembajakan pesawat terbang / Aircraft Hijacking</td>
						<td style=min-width:50px>Rp 500.000 per hari (max. Rp 5.000.000)</td>
					</tr>
					<tr>

						<td style=min-width:50px>Biaya telepon darurat / Emergency phone call</td>
						<td style=min-width:50px>Rp 1.000.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Perpanjangan periode pertanggungan otomatis / Automatic of extension period</td>
						<td style=min-width:50px>Ya / Yes</td>
					</tr>
					<tr>

						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="2">F</td>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="2">Manfaat Kecelakaan Diri dan Cacat Tetap / Benefits For Personal Accident and Disability</td>
						<td style=min-width:50px>Santunan Kematian dan Cacat Tetap Akibat Kecelakaan / Death & Permanent Disablement due to accident</td>
						<td style=min-width:50px>Rp 500.000.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Cacat Tetap Sebagian / Partial Permanent Disablement</td>
						<td style=min-width:50px>Sesuai tabel skala benefit</td>
					</tr>
					<tr>

						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #C6E0B4;">G</td>
						<td style="min-width:50px;background-color: #C6E0B4;">Manfaat Tanggung Gugat Pribadi / Benefits For Personal Liability</td>
						<td style=min-width:50px>Tanggung gugat pribadi / Personal Liability</td>
						<td style=min-width:50px>Rp 500.000.000</td>
					</tr>
                </tbody> 
				</table>
 
                <table id="opsi2" style="font-size: 10px;border-collapse: collapse; width:100%;" cellspacing=0 border=1>
    <tbody style="border-color: black;border-style: none;border-width: 0;">
                    <tr>
						<td colspan="4" style="min-width:50px;background-color: #D9E1F2;">Opsi 2</td>
					</tr>
					<tr>
						<td colspan="4" style="min-width:50px;background-color: #FFE699;border-bottom: none;">Period of cover : 7 days (as per Telkomsel Package)</td>
					</tr>
					<tr>
						<td colspan="4" style="min-width:50px;background-color: #FFE699;border-top: none;border-bottom: none;">Premium : Rp. 101.000</td>
					</tr>
					<tr>
						<td colspan="4" style="min-width:50px;background-color: #FFE699;border-top: none;border-bottom: none;">Administration cost : Rp. 12.500</td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #D9E1F2;"></td>
						<td style="min-width:50px;background-color: #D9E1F2;">LUAS JAMINAN / COVERAGE</td>
						<td style="min-width:50px;background-color: #D9E1F2;">MANFAAT / BENEFIT</td>
						<td style="min-width:50px;background-color: #D9E1F2;">BATASAN GANTI RUGI / LIMIT OF LIABILITY</td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="5">A</td>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="5">Biaya Pengobatan & Layanan Darurat / Emergency Service Expenses</td>
						<td style=min-width:50px>Biaya Pengobatan dan Rawat Inap / Medical and hospitalization expenses</td>
						<td style=min-width:50px>Rp 500.000.000</td>
					</tr>
					<tr>
						
						
						<td style=min-width:50px>Biaya Transportasi atau Repatriasi Ketika Sakit atau Kecelakaan / Transport or repatriation in the event of illness or accident expenses</td>
						<td style=min-width:50px>Rp 500.000.000</td>
					</tr>
					<tr>
						
						
						<td style=min-width:50px>Biaya Repatriasi Jenazah / Repatriation of Mortal Remain expenses</td>
						<td style=min-width:50px>Rp 500.000.000</td>
					</tr>
					<tr>
						
						
						<td style=min-width:50px>Biaya Perjalanan Salah Satu Anggota Keluarga Dekat / Travel of one immediate family member expenses</td>
						<td style=min-width:50px>Rp 25.000.000</td>
					</tr>
					<tr>
						
						
						<td style=min-width:50px>Biaya penjagaan/pedampingan anak / Child Guard expenses</td>
						<td style=min-width:50px>Rp 1.500.000</td>
					</tr>
					<tr>
						
						
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #C6E0B4;">B</td>
						<td style="min-width:50px;background-color: #C6E0B4;">Biaya Pembatalan atau Pengurangan Perjalanan / Travel Cancellation or Curtailment Expenses</td>
						<td style=min-width:50px>Biaya pembatalan atau pengurangan perjalanan / Travel cancellation or curtailment expenses</td>
						<td style=min-width:50px>Rp 10.000.000</td>
					</tr>
					<tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="4">C</td>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="4">Manfaat Atas Kehilangan dan Penundaan / Benefits for Losses dan Delay</td>
						<td style=min-width:50px>Gangguan perjalanan / Travel disruption</td>
						<td style=min-width:50px>Rp 5.000.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Penundaan perjalanan / Travel postponement</td>
						<td style=min-width:50px>Rp 5.000.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Tertinggal perjalanan lanjutan / Travel misconnection</td>
						<td style=min-width:50px>Rp 2.500.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Keterlambatan keberangkatan / Delayed Departure</td>
						<td style=min-width:50px>Rp 2.500.000</td>
					</tr>
					<tr>

						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="4">D</td>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="4">Manfaat Untuk Barang Bawaan / Benefits For Luggage</td>
						<td style=min-width:50px>Kompensasi kehilangan di dalam pesawat, perampokan atau perusakan bagasi / Compensation for in-flight loss, robbery or destruction of baggage checked-in</td>
						<td style=min-width:50px>Rp 5.000.000 (max. Rp 1.000.000 per item)</td>
					</tr>
					<tr>

						<td style=min-width:50px>Keterlambatan kedatangan bagasi / Delay in the arrival of luggage</td>
						<td style=min-width:50px>Rp 2.500.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Kehilangan paspor, SIM atau KTP / Loss of passport, driving license or ID Card</td>
						<td style=min-width:50px>Rp 2.500.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Penemuan dan pengiriman bagasi dan barang pribadi / Discovery & delivery of luggage and personal effects</td>
						<td style=min-width:50px>Rp 1.000.000</td>
					</tr>
					<tr>

						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="4">E</td>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="4">Manfaat Tambahan / Additional Benefit</td>
						<td style=min-width:50px>Pengiriman obat-obatan / Drugs delivery</td>
						<td style=min-width:50px>Rp 1.000.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Pembajakan pesawat terbang / Aircraft Hijacking</td>
						<td style=min-width:50px>Rp 500.000 per hari (max. Rp 5.000.000)</td>
					</tr>
					<tr>

						<td style=min-width:50px>Biaya telepon darurat / Emergency phone call</td>
						<td style=min-width:50px>Rp 1.000.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Perpanjangan periode pertanggungan otomatis / Automatic of extension period</td>
						<td style=min-width:50px>Ya / Yes</td>
					</tr>
					<tr>

						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="2">F</td>
						<td style="min-width:50px;background-color: #C6E0B4;" rowspan="2">Manfaat Kecelakaan Diri dan Cacat Tetap / Benefits For Personal Accident and Disability</td>
						<td style=min-width:50px>Santunan Kematian dan Cacat Tetap Akibat Kecelakaan / Death & Permanent Disablement due to accident</td>
						<td style=min-width:50px>Rp 500.000.000</td>
					</tr>
					<tr>

						<td style=min-width:50px>Cacat Tetap Sebagian / Partial Permanent Disablement</td>
						<td style=min-width:50px>Sesuai tabel skala benefit</td>
					</tr>
					<tr>

						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="min-width:50px;background-color: #C6E0B4;">G</td>
						<td style="min-width:50px;background-color: #C6E0B4;">Manfaat Tanggung Gugat Pribadi / Benefits For Personal Liability</td>
						<td style=min-width:50px>Tanggung gugat pribadi / Personal Liability</td>
						<td style=min-width:50px>Rp 500.000.000</td>
					</tr>
                </tbody> 
				</table>


             
                </div>
                <div class="modal-footer">

                </div>
            </div>

</div>
    @push('custom-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"
                integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script type="text/javascript">
        var premi_values = 0;
        var limits_value = 0;
        var periode_value = 0;
        var hitung_limit = 0;
            $(document).ready(function() {
                $("#gagal_voucher").hide();
                $("#sukses_voucher").hide();
                $("#btn_submit").prop("disabled", true);

                $("#tanggal_periode_dari").hide();
                $("#tanggal_periode_sampai").hide();
                $("#email_send_info_input").hide();


                // getProduk();
                getPremi();
            });

            // hitung usia dari input tgl_lahir
            $('#tgl_lahir').on('change', function() {
            function diff_yearss(dt2, dt1) 
                    {

                    var diff =(dt2s.getTime() - dt1s.getTime()) / 1000;
                    diff /= (60 * 60 * 24);
                    return Math.abs(Math.round(diff/365.25));
                    
                    }
                    dt1s = new Date($('#tgl_lahir').val());
                    dt2s = new Date();
                    //console.log(dt1);
                    //console.log(dt2);
                    //console.log(diff_years(dt1, dt2));
                    hasil_range_tgls = diff_yearss(dt1s, dt2s);
                    console.log(hasil_range_tgls);
                    if(hasil_range_tgls != null){
                        $("#usia").val(hasil_range_tgls);
                    }else{
                        $("#usia").val(hasil_range_tgls);
                    }
                  
            });

            $('#email_send_info').on('change', function() { // on change of state
                // console.log(this.checked.length);
                if ($('#email_send_info').is(':checked')) // if changed state is "CHECKED"
                {
                    $("#email_send_info_input").hide();
                    // do the magic here
                } else {
                    $("#email_send_info_input").show();
                }
            })

            $('#fill_limit').on('click', '.check_limit', function() {
                // this.value
                premi_value = this.getAttribute('data-premi');  
                limits_value = this.getAttribute('data-limits');
                var hitung_limit = parseInt(limits_value);
                $("#limit_t").html('Rp ' + hitung_limit.toLocaleString());  
                getProduk(this.value);
            });

            $('#fill_periode').on('click', '.periode_polis', function() {
                // alert('hallo');
                var a = document.getElementById('ToCFile'); //or grab it by tagname etc
                //a.href = '{{ env('BASE_API') }}/' + this.getAttribute('data-link')
                //update
                a.href = '{{ $baseApi }}'+this.getAttribute('data-link');
                //var b = document.getElementById('Quotation'); //or grab it by tagname etc
                //b.href = '{{ $baseApi }}'+this.getAttribute('data-link-quotation');
                $("#tanggal_periode_dari").show();
                var txt_date = $('#tgl_keberangkatan').val();
                $("#periode_polis_start").val(txt_date);
                $("#start").text(txt_date);
                $("#start_eng").text(txt_date);
                periode_value = this.value;
         
                if (periode_value == 30) {
                    $("#tanggal_periode_sampai").show();
                    $("#opsi1").show(); 
                    $("#opsi2").hide();
                   // var end_date = new Date ($('#periode_polis_start').val());
                    //console.log(end_date);
                    var date_polis_end = new Date($('#periode_polis_start').val());
                    date_polis_end.setDate(date_polis_end.getDate() + 29);
                    var dateString = date_polis_end.toISOString().split('T')[0];
                    $("#periode_polis_end").val(dateString);
                    $("#end").text(dateString);
                    $("#end_eng").text(dateString);
                    
                }else if (periode_value == 7){
                    $("#tanggal_periode_sampai").show();  
                    $("#opsi2").show(); 
                    $("#opsi1").hide();
                    var date_polis_end = new Date($('#periode_polis_start').val());
                    date_polis_end.setDate(date_polis_end.getDate() + 6);
                    var dateString = date_polis_end.toISOString().split('T')[0];
                    $("#periode_polis_end").val(dateString);
                    $("#end").text(dateString);
                    $("#end_eng").text(dateString);
                }else{
                    $("#tanggal_periode_sampai").hide();
                    $("#opsi2").hide(); 
                    $("#opsi1").hide();
                }
                
                premi_values = this.getAttribute('data-premis');
                $('#keterangan_produk').html(this.getAttribute('data-deskripsi'));
                var hitung_premi = parseInt(premi_values);
                // hitung semua
                $('#value_premi').html('Rp ' + hitung_premi.toLocaleString());
                materai_values = 12500;
                materai_values_preview = 12500;
                $('#value_materai').html('Rp ' + materai_values.toLocaleString());
                $('#premi').val(premi_values);

                diskon_values = 15;
                var diskon_hardcode = parseInt(diskon_values) * parseInt($('#premi').val()) / 100;

                $('#value_diskon').html('Rp ' + diskon_hardcode.toLocaleString());
                $("#diskons").html('Rp ' + diskon_hardcode.toLocaleString());
                $('#diskon').val(diskon_hardcode);


                //var hitung_total = parseInt($('#premi').val()) - parseInt(diskon) + parseInt($('#materai').val());

                var hitung_total = parseInt(premi_values) - parseInt(diskon_hardcode) - parseInt($('#diskon').val()) + parseInt(materai_values);
                var hitung_total_preview = parseInt(premi_values) - parseInt($('#diskon').val()) + parseInt(materai_values_preview);
                // console.log(hitung_total);
                $('#total').val(hitung_total);
                $('#value_total').html('Rp ' + hitung_total.toLocaleString());
                var txt_date1 = $('#nama_lengkap').val();
                var txt_date2 = $('#ktp_passpor').val();
                var txt_date3 = $('#alamat').val();
                var txt_date4 = $('#tgl_lahir').val();
            
                var pek = $('#pekerjaan').val();
                var txt_date7 = $('#negara_tujuan').val();
                var txt_date8 = $('#kota_asal').val();
                var txt_date9 = $('#mode_angkutan').val();
                var txt_date10 = $('#ahli_waris').val();
                var txt_date11 = $('#status_hubungan').val();
                var txt_date12 = $('#premi').val();
                var txt_date13 = $('#diskon').val();
                var txt_date14 = $('#s').val();
                var txt_date15 = $('#total').val();
                $("#nama_lengkap_t").text(txt_date1);
                $("#ktp_passpor_t").text(txt_date2);
                $("#alamat_t").text(txt_date3);
                $("#tgl_lahir_t").text(txt_date4);
               
               
                $("#pekerjaan_t").text(pek);
                $("#negara_tujuan_t").text(txt_date7);
                
                $("#kota_asal_t").text(txt_date8);
                $("#mode_angkutan_t").text(txt_date9);
                $("#ahli_waris_t").text(txt_date10);
                $("#status_hubungan_t").text(txt_date11);
                
                $("#premi_t").html('Rp ' + hitung_premi.toLocaleString());
                $("#diskon_t").text(txt_date13); 
                //materai_values = 12500;
                $("#adm").html('Rp ' + materai_values_preview.toLocaleString());
               
                $("#total_bayar_t").html('Rp ' + hitung_total_preview.toLocaleString());

            });

        //     function showDate() {
        //     $("#tanggal_periode_dari").show();
        //     $("#tanggal_periode_sampai").show();
        // }

            $('.termCheck').on('change', function() { // on change of state
                // console.log(this.checked.length);
                if ($('#termCheck_1').is(':checked') && $('#termCheck_2').is(':checked') && $('#termCheck_3').is(':checked')) // if changed state is "CHECKED"
                {
                    $("#btn_submit").prop("disabled", false);
                    // do the magic here
                } else {
                    $("#btn_submit").prop("disabled", true);
                }
            })



            function getPremi() {
                //axios.get("{{ env('BASE_API') }}" + '/api/premi/Telkomsel/')
                //update
                axios.get("{{ $baseApi }}" + 'api/premi/Telkomsel/')
                    .then(function(response) {
                        // console.log();
                        // premi_value = response.data.data.premi;
                        var html;
                        if (response.data.code == 200) {
                            // set premi
                            // $('#value_premi').html('Rp. ' + response.data.data.premi.toLocaleString());
                            // $('#premi').val(response.data.data.premi);

                            console.log(response.data.data);

                            var html = '';
                            var i = 0;
                            response.data.data.forEach(function(list, index) {
                                html += `<input class="form-check-input form-check-primary pl-5 col s3 check_limit" data-premi="`+list.orders[i++].premi+`" id="check_limit" data-limits="`+list.limit+`" type="radio" name="limit" value="`+list.id+`"
                                style="border-radius: 50%; margin-left:4%"><label class="form-check-label ps-2 mt-1" for="termCheck"><strong> Rp `+list.limit.toLocaleString()+`</strong></a></label>`;
                            });


                            // var hitung_total = parseInt(response.data.data.premi) - parseInt($('#diskon').val()) + parseInt($('#materai').val());
                            // // console.log(hitung_total);
                            // $('#total').val(hitung_total);
                            // $('#value_total').html('Rp.' + hitung_total.toLocaleString());

                            $('#fill_limit').html(html);
                        }else{
                            console.log('gagal');
                        }
                    })
                    .catch(function(error) {
                        // $("#gagal_voucher").show()
                        console.log(error);
                    });
            }

            function getProduk(premi_id) {

                //axios.get("{{ env('BASE_API') }}" + '/api/produk/Telkomsel/' + premi_id)
                //update
                axios.get("{{ $baseApi }}" + 'api/produk/Telkomsel/' + premi_id)
                    .then(function(response) {
                        console.log(response.data);
                        if (response.data.code == 200) {

                            var html = '';
                            response.data.data.forEach(function (list, index) {
                                // display premi checkbox
                                html += `
                                <div class="form-check ps-5 me-4">
                                    <input class="form-check-input periode_polis form-check-primary pl-5 produkCheck" type="radio" data-premis="`+list.premi+`" data-deskripsi = "`+list.deskripsi+`" data-link="storage/`+list.term_condition_file_path+`" name="periode_polis" value="`+list.periode+`" id="periode_polis"
                                style="border-radius: 50%;"><label class="form-check-label ps-2 mt-1" for="produkCheck"><strong>`+ list.periode + ' ' + list.jenis_periode +`</strong></a></label>
                                </div>`;
                            });



                            // console.log(html);

                            $('#fill_periode').html(html);

                        }else{
                            // $("#gagal_voucher").show()
                            // $("#sukses_voucher").hide();
                        }
                    })
                    .catch(function(error) {
                        // $("#gagal_voucher").show()
                        console.log(error);
                    });
            }

            function cekVoucher() {
                var kode_voucher = $('#kode_voucher').val();

                //axios.get("{{ env('BASE_API') }}" + '/api/diskon/Telkomsel/' + kode_voucher)
                //update
                axios.get("{{ $baseApi }}" + 'api/diskon/Telkomsel/' + kode_voucher)
                    .then(function(response) {
                        console.log($('#premi').val());
                        if (response.data.code == 200) {
                            $("#sukses_voucher").show();
                            $("#gagal_voucher").hide();
                            var diskon = parseInt(response.data.data.value) * parseInt($('#premi').val()) / 100;

                            $('#value_diskon').html('Rp ' + diskon.toLocaleString());
                            $("#diskons").html('Rp ' + diskon.toLocaleString());
                            $('#diskon').val(diskon);


                            var hitung_total = parseInt($('#premi').val()) - parseInt(diskon) + parseInt($('#materai').val());
                            // console.log(hitung_total);
                            $('#total').val(hitung_total);
                            $('#value_total').html('Rp ' + hitung_total.toLocaleString());
                        } else {
                            $("#gagal_voucher").show()
                            $("#sukses_voucher").hide();
                        }
                    })
                    .catch(function(error) {
                        // $("#gagal_voucher").show()
                        console.log(error);
                    });
            }

            function postData() {

                var $JK = $('input[name=jns_kelamin]:checked');
                // console.log($PP.val());


                if ($('#email_send_info').is(':checked')) {
                    email_info = $('#email').val();
                }else{
                    email_info =  $('#email_send_info_input_text').val();
                }

                //validasi batas usia
                function diff_years(dt2, dt1) 
                {
                    var diff =(dt2.getTime() - dt1.getTime()) / 1000;
                    diff /= (60 * 60 * 24);
                    return Math.abs(Math.round(diff/365.25));
                }
                dt1 = new Date($('#tgl_lahir').val());
                dt2 = new Date();
                //console.log(dt1);
                //console.log(dt2);
                console.log(diff_years(dt1, dt2));
                hasil_range_tgl = diff_years(dt1, dt2);
                // check date range
                //var start_date = new Date($('#tgl_lahir').val());
                // var end_date = new Date ($('#periode_polis_end').val());
                //var range_tgl = start_date;
                //var hasil_range_tgl = range_tgl / (1000 * 3600 * 24) / 365;

                if (hasil_range_tgl > 60) {

                    console.log(hasil_range_tgl)
                    Swal.fire(
                        'Error !',
                        'Batas Usia Premi Maksimal 60 Tahun!',
                        'error'
                    )
                    return false;
                }

                var data = {
                    nama_lengkap: $('#nama_lengkap').val(),
                    jns_kelamin: $JK.val(),
                    no_telp: $('#no_telp').val(),
                    email: $('#email').val(),
                    email_send_info : email_info,
                    ktp_passpor: $('#ktp_passpor').val(),
                    alamat: $('#alamat').val(),
                    tgl_lahir: $('#tgl_lahir').val(),
                    usia: $('#usia').val(),
                    periode_polis: periode_value,
                    periode_polis_start: $('#tgl_keberangkatan').val(),
                    //periode_polis_end: $('#periode_polis_end').val(),
                    tgl_keberangkatan: $('#tgl_keberangkatan').val(),
                    pekerjaan: $('#pekerjaan').val(),
                    negara_tujuan: $('#negara_tujuan').val(),
                    //kota_asal: $('#kota_asal').val(),
                    //kota_tujuan: $('#kota_tujuan').val(),
                    mode_angkutan: $('#mode_angkutan').val(),
                    //kode_penerbangan: $('#kode_penerbangan').val(),
                    ahli_waris: $('#ahli_waris').val(),
                    status_hubungan: $('#status_hubungan').val(),
                    kode_voucher: $('#kode_voucher').val(),
                    // dana
                    limit_rugi: limits_value,
                    premi: $('#premi').val(),
                    diskon: $('#diskon').val(),
                    materai: $('#materai').val(),
                    total: $('#total').val(),
                }


                //axios.post("{{ env('BASE_API') }}" + '/api/telkom', data)
                //update
                axios.post("{{ $baseApi }}" + 'api/telkom', data)
                    .then(function(response) {
                        // console.log(response.data);

                        if (response.data.code == 200) {
                            Swal.fire(
                                'Success',
                                'Data Berhasil dikirim.',
                                'success'
                            ).then((result) => {
                                $("#btn_submit").attr('disabled', 'disabled'); 
                                window.location.replace("payment_method/" + response.data.id);
                            })
                        } else {

                            console.log(response.data.data);
                            Swal.fire(
                                'Error !',
                                'Data Gagal dikirim, ' + JSON.stringify(response.data.data),
                                'error'
                            )
                        }
                    })
                    .catch(function(error) {
                        // alert(error);
                        console.log(error);
                    });
            }


            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal 
            btn.onclick = function() {
            modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
            modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

        </script>
    @endpush
@endsection
