@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Proje Detay Listesi')
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

  </section>
  <section class="users-list-wrapper">
    <a href="{{route('order_detail_excel_add')}}"><h5>Projeye Detay Excel Yüklemek İçin Tıklayınız</h5></a>
    <div class="users-list-table">
      <div class="card">
        <a style="position: absolute; right: 25px; top: 3px;" href="{{route('order_detail_add',$orderid)}}"><button type="submit" class="btn btn-success" style="color:#000000 ;font-family:arial;"><b>Yeni Ekle</b></button></a>
        <div class="card-body mt-2">

          <!-- datatable start -->
          <div class="table-responsive">
            <table id="detail-list-datatable" class="table responsive nowrap" style="width:100%">
              <thead>
              <tr>
                <th>Ürün Kodu</th>
                <th>Ürün Adı TR</th>
                <th>Ürün Adı EN</th>
                <th>Ürün Açıklaması</th>

                <th>Sipariş Miktarı</th>
                <th>Teslim Edilen</th>
                <th>Kalan Miktar</th>
                <th>Stok Bakiyesi</th>

                <th>Birim</th>
                <th>Birim Fiyat</th>
                <th>KDV</th>
                <th>İskonto</th>
                <th>Genel Toplam</th>


                <th>Teslim Tarihi</th>
                <th>İşlem</th>

              </tr>
              </thead>
              <tbody>
              @foreach($orderdetaildata as $orderdetail)
                <tr>
                  <td>{{$orderdetail->order_detail_code}}</td>
                  <td>{{$orderdetail->order_detail_name_tr}}</td>
                  <td>{{$orderdetail->order_detail_name_en}}</td>
                  <td>{{$orderdetail->order_detail_description_tr}}</td>

                  <td>{{$orderdetail->order_detail_order}}</td>
                  <td>{{$orderdetail->order_detail_delivery}}</td>
                  <td>{{$orderdetail->order_detail_remaining}}</td>
                  <td>{{$orderdetail->order_detail_stock}}</td>


                  <td>{{$orderdetail->order_detail_unit}}</td>
                  <td>{{$orderdetail->order_detail_unit_price}}</td>
                  <td>{{$orderdetail->order_detail_vat}}</td>
                  <td>{{$orderdetail->order_detail_discount}}</td>
                  <td>{{$orderdetail->order_detail_total}}</td>


                  <td>{{$orderdetail->order_detail_delivery_date}}</td>
                  <td>
                    <a href="{{route('order_detail_edit',$orderdetail->id)}}"><i class="bx bx-edit-alt"></i> </a>
                    <a href="{{route('order_detail_delete',$orderdetail->id)}}"><i class="bx bx-trash-alt" onclick="return confirm('Sipariş Detayı Silinecek Emin misiniz?')"></i> </a>
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
