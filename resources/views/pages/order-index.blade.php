@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Proje Listesi')
{{-- vendor styles --}}
@section('vendor-styles')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection
@section('content')
  <!-- users list start -->
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
  <section class="users-list-wrapper">

    <div class="users-list-table">
      <div class="card">
        <div class="card-body">
          <!-- datatable start -->
          <div class="table-responsive">
            <table id="users-list-datatable" class="table responsive nowrap" style="width:100%">
              <thead>
              <tr>
                <th style="width: 20px;">S.Numarası</th>
                <th>Proje Id</th>
                <th>Müşteri</th>
                <th>Proje Kodu</th>
                <th>Proje Adı TR</th>
                <th>Proje Adı EN</th>

                <th>Proje Image</th>
                <th>Proje Sipariş Tarihi</th>
                <th>Proje Teslim Tarihi</th>
                <th>İşlem</th>

              </tr>
              </thead>
              <tbody>
                @foreach($orderdata as $index=>$order)
                <tr>
                  <th scope="row">{{$index+1}}</th>
                  <td>{{$order->id}}</td>
                  <td>{{$order->user->name }}</td>
                  <td>{{$order->order_code}}</td>
                  <td>{{$order->order_title_tr}}</td>
                  <td>{{$order->order_title_en}}</td>
                  <td>
                    <img src="{{$order->order_image ? asset($order->order_image):asset('public/images/petka/order/noimg.png')}}" style="height:60px; width: 70px">
                  </td>
                  <td>{{$order->order_date}}</td>
                  <td>{{$order->order_delivery_date}}</td>
                  <td>
                    <a href="{{route('detail',$order->id)}}"><i class="bx bx-show-alt"></i> </a>
                    <a href="{{route('edit',$order->id)}}"><i class="bx bx-edit-alt"></i></a>
                    <a href="{{route('delete',$order->id)}}" ><i class="bx bx-trash-alt" onclick="return confirm('Sipariş Ve Sipariş Detayı Silinecek Emin misiniz?')"></i></a>
                  </td>
                </tr>

                @endforeach
              </tbody>
            </table>

          </div>

          <!-- datatable ends -->
        </div>

      </div>

    </div>
  </section>
  <!-- users list ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
  <script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
  <script src="{{asset('js/scripts/pages/app-users.js')}}"></script>
@endsection
