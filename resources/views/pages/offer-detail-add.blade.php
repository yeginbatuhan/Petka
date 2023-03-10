@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title','Teklif Proje Detay Manuel Ekleme')
{{-- vendor css --}}
@section('vendor-styles')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/swiper.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/shepherd.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
@endsection
@section('page-styles')
  <link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/swiper.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/faq.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/plugins/tour/tour.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection

@section('content')

  <section class="faq-search">
    @if(session('success'))

      <div class="alert bg-rgba-success alert-dismissible mb-2" role="alert">

        <strong>{{session('success')}}</strong>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

    @endif

  </section>

  <section class="faq-bottom" style="margin-top: -60px;">
    <br>
    <br>
    <br>
    <br>
    <br>

    <form action="{{route('offer_detail_store')}}" method="POST">
      @csrf

      <input type="hidden" name="offer_id" value="{{$offerdt}}" required>

      <div class="card mb-4">
        <h5 class="card-header">Teklif Proje Detay Manuel Ekleme Alanı</h5>
        <div class="card-body">
          <div class="row mb-3">
            <label for="html5-text-input" class="col-form-label col-md-2">Ürün Kodu</label>
            <div class="col-md-10">
              <input class="form-control" type="text" id="html5-text-input" name="offer_detail_code"  required/>
            </div>
          </div>
          <div class="row mb-3">
            <label for="html5-text-input" class="col-form-label col-md-2">Ürün Adı TR</label>
            <div class="col-md-10">
              <input class="form-control" type="text" id="html5-text-input" name="offer_detail_name_tr"/>
            </div>
          </div>
          <div class="row mb-3">
            <label for="html5-text-input" class="col-form-label col-md-2">Ürün Adı EN</label>
            <div class="col-md-10">
              <input class="form-control" type="text" id="html5-text-input" name="offer_detail_name_en" />
            </div>
          </div>
          <div class="row mb-3">
            <label for="html5-text-input" class="col-form-label col-md-2">Miktar</label>
            <div class="col-md-10">
              <input class="form-control" type="text" id="html5-text-input" name="offer_detail_quantity" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label for="html5-text-input" class="col-form-label col-md-2">Birim Fiyat</label>
            <div class="col-md-10">
              <input class="form-control" type="text" id="html5-text-input" name="offer_detail_unit_price" required/>
            </div>
          </div>

        </div>
        <button type="submit" class="btn btn-success" style="color:#000000 ;font-family:arial;"><b>EKLE</b></button>
      </div>

      </div>

    </form>
  </section>

@endsection

@section('vendor-scripts')
  <script src="{{asset('vendors/js/extensions/swiper.min.js')}}"></script>
  <script src="{{asset('vendors/js/extensions/shepherd.min.js')}}"></script>
  <script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>
@endsection

@section('page-scripts')
  <script src="{{asset('js/scripts/pages/faq.js')}}"></script>
  <script src="{{asset('js/scripts/extensions/tour.js')}}"></script>
  <script src="{{asset('js/scripts/pages/app-users.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">

  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
          integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">

  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
          integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">

  </script>
  <script src="https://cdn.tiny.cloud/1/9dddvb33lt4df41m1jzslmm7gixs4pe9ntv38ih04i94dme7/tinymce/5/tinymce.min.js" referrerpolicy="origin">

  </script>
  <script> tinymce.init({
      selector:'#bulletin_text'
    });</script>
@endsection
