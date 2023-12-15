@extends('layouts.public.app')
@section('title','Permohonan Saya')

@push('extra_style')
<style>
body {
    background-color: #f3f8fb;
  }
</style>
@endpush

@section('content')
<div
class="row col-12 justify-content-center mt-5 pt-5"
id="buat-perizinan"
>
<div class="col-md-10 col-12">
  <div class="content row justify-content-between">
    <h4 class="align-self-center">Panduan Permohonan <span id="namaPerizinan"></span></h4>

    <div class="sec-center">
      <input
        class="dropdown"
        type="checkbox"
        id="dropdown"
        name="dropdown"
      />
      <label
        class="for-dropdown text-white justify-content-between px-4"
        for="dropdown"
        >Pilih Jenis Perizinan <i class="fa-solid fa-angle-down"></i
      ></label>
      <div class="section-dropdown">
        @foreach ($jenisPerizinanOptions as $jenisPerizinanOption)
          <a href="javascript:void(0)" class="jenis-perizinan-link option" data-id="{{ $jenisPerizinanOption->id }}" data-nama="{{ $jenisPerizinanOption->nama }}">
              {{ $jenisPerizinanOption->nama }}
          </a>
        @endforeach
      </div>
    </div>
  </div>
  <div class="content px-5" id="panduan">
    <div class="row px-2 justify-content-between">
      <h4 class="align-self-center">Panduan Permohonan Perizinan</h4>
      <a href="#" class="btn ajukanPerizinan btn-success px-4 py-3"
        >Syarat Saya Lengkap, Siap Ajukan Permohonan</a
      >
    </div>
    <div class="row mt-5">
      <table class="table" id="table_perizinan">
        <thead>
          <tr>
            <th scope="col" style="width: 100px;">No</th>
            <th scope="col">Syarat Perizinan</th>
          </tr>
        </thead>
        <tbody>
          {{-- data perizinan --}}
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
@endsection

@push('extra_script')
<script>
    $(".option").click(function (e) {
      $("#panduan").css({ opacity: 1 });
    });
  </script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function () {
        $('.jenis-perizinan-link').click(function (e) {
                e.preventDefault();

                var jenisPerizinanId = $(this).data('id');
                @if (Auth::check())
                $('.ajukanPerizinan').attr('href', 'ajukan-perizinan?jenis=' + jenisPerizinanId);
                  @else
                $('.ajukanPerizinan').attr('href', 'loginpemohon');

                @endif

                var namaPerizinan = $(this).data('nama');
                $('#namaPerizinan').html(namaPerizinan)

                $.ajax({
                    type: 'GET',
                    url: 'get-data-perizinan',
                    data: {
                        jenis_perizinan: jenisPerizinanId
                    },
                    success: function (data) {
                        // Update tabel dengan data perizinan baru
                        updateTable(data);
                    }
                });
            });

      function updateTable(data) {
          // Logika untuk memperbarui tabel dengan data perizinan baru
          // ...

          // Contoh sederhana: Menambahkan baris baru untuk setiap entri perizinan
          var table = $('#table_perizinan tbody');
          table.empty();
          
          $.each(data, function (index, item) {
              table.append('<tr><td style="width: 100px;">' + (index + 1) + '</td><td>' + item.nama + '</td></tr>');
          });
      }
  });
</script>
@endpush
