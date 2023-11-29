@extends('layouts.public.app')
@section('title','Ajukan Syarat Perizinan')

@push('extra_style')
<style>
    body {
      background-color: #f3f8fb;
    }
    .inputfile {
      width: 0.1px;
      height: 0.1px;
      opacity: 0;
      overflow: hidden;
      position: absolute;
      z-index: -1;
    }
    .inputfile + label {
      font-weight: 300;
      color: black;
      border-radius: 10px;
      border: 1px solid rgb(179, 179, 179);
      background-color: white;
      display: inline-block;
    }
    .inputfile + label * {
      pointer-events: none;
    }
    .inputfile + label {
      cursor: pointer; /* "hand" cursor */
    }
    .inputfile:focus + label {
      outline: 1px dotted #000;
      outline: -webkit-focus-ring-color auto 5px;
    }
  </style>
@endpush

@section('content')

<div
class="row col-12 justify-content-center mt-5 pt-5"
id="ajukan-perizinan"
>
<div class="col-md-6 col-12">
  <div class="content mt-5">
    <h3 class="text-center mb-5">Syarat Perizinan</h3>
    <form>
      {{-- <input
        type="file"
        name="file"
        id="file"
        class="inputfile justify-content-around w-100"
        data-multiple-caption="{count} files selected"
        multiple
      />
      <label
        for="file"
        class="w-100 justify-content-between px-3 py-3 align-items-center d-flex"
        >Upload Dokumen <img src="assets/icon/cloud.png" alt=""
      /></label> --}}

      <div class="form-group mb-5">
        <label for="syarat1"
          >Akta pendirian dan perubahan badan penyelenggara satuan
          pendidikan berbentuk badan hukum dan memperoleh pengesahan dari
          Kementerian Hukum dan Hak Asasi Manusia</label
        >
        <input
          type="file"
          class="form-control"
          id="syarat1"
          name="syarat1"
        />
      </div>

      <div class="form-group my-5">
        <label for="syarat2"
          >Akta pendirian dan perubahan badan penyelenggara satuan
          pendidikan berbentuk badan hukum dan memperoleh pengesahan dari
          Kementerian Hukum dan Hak Asasi Manusia</label
        >
        <input
          type="file"
          class="form-control"
          id="syarat2"
          name="syarat2"
        />
      </div>
      <a
        href="{{route('pengajuan-berhasil')}}"
        type="submit"
        class="btn btn-main mt-2 w-100"
      >
        Ajukan Perizinan
      </a>
    </form>
  </div>
</div>
</div>
@endsection
