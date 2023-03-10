@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title','Mükellef Uygulaması | Anasayfa')
{{-- vendor css --}}
@section('vendor-styles')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/swiper.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/shepherd.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
@endsection
@section('page-styles')
  <link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/swiper.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/faq.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/plugins/tour/tour.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection

@section('content')

  <section class="faq-search">

  </section>

  <section class="faq-bottom" style="margin-top: -60px;">
    <div class="row">
      <div class="col-12">
        <div class="card faq-bg bg-transparent box-shadow-0 p-1 p-md-5">
          <div class="card-body p-0">
            <!-- datatable start -->
            <div class="table-responsive">
              <table id="users-list-datatable" class="table">
                <thead>
                <tr>
                  <th>Sl Num</th>
                  <th>Resim</th>
                  <th>Başlık</th>
                  <th>Bildirim İçerik</th>
                  <th>İletilen Kişi Sayısı</th>
                  <th>İşlem</th>
                </tr>
                </thead>
                <tbody>

                  <tr>
                    <td>name</td>
                    <td><img class="rounded-circle mr-1" src=""
                             alt="card">
                    </td>
                    <td ><a href=""></a> </td>
                    <td>name</td>
                    <td >nameKişi</td>
                    <td>
                      <a href=""><i class="bx bx-edit-alt"></i></a>
                      <a href=""><i class="bx bx-trash-alt"></i></a>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
            <!-- datatable ends -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- fab bottom ends -->
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
@endsection
