@extends('layouts.public.app')
@section('title','Lacak Perizinan')

@push('extra_style')
<style>
body {
    background-color: #f3f8fb;
  }
</style>
@endpush

@section('content')
<div class="row col-12 justify-content-center" id="lacak-perizinan">
    <div class="col-md-6 col-12">
      <div class="content">
        <h3 class="text-center">Lacak Perizinan</h3>
        <form action="{{route('detail-perizinan')}}" method="post">
          @csrf
          @if(session()->has("gagal"))
          <div class="alert alert-danger mt-4">
            <p class="mb-0"> {{session("gagal")}} </p>
          </div>
          @endif
          <div class="form-group mb-5 mt-4">
            <label for="no_regis">Nomor Surat</label>
            <input
              type="text"
              class="form-control"
              id="no_regis"
              name="no_regis"
              aria-describedby="emailHelp"
            />
          </div>
          <button
            type="submit"
            class="btn btn-main mt-5 w-100"
          >
            Lacak Perizinan
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection
