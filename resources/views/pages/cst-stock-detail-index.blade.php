@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Müşteri Numune Detay Listesi')
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
    <div class="users-list-table">
      <div class="card">

          <a style="position: absolute; right: 25px; top: 3px;" href="{{route('cststock_detail_add',$cstid)}}">
            <button type="submit" class="btn btn-success" style="color:#000000 ;font-family:arial;"><b> Yeni Ekle</b>

            </button>
          </a>

        <div class="card-body mt-2">
          <!-- datatable start -->
          <div class="table-responsive">
            <table id="detail-list-datatable" class="table responsive nowrap" style="width:100%">
              <thead>
              <tr>

                <th>Ürün Adı TR</th>
                <th>Ürün Adı EN</th>
                <th>Miktar</th>
                <th>Birim</th>
                <th>İşlem</th>

              </tr>
              </thead>
              <tbody>
              @foreach($data as $detail)
                <tr>
                  <td>{{$detail->customer_stock_detail_name_tr}}</td>
                  <td>{{$detail->customer_stock_detail_name_en}}</td>
                  <td>{{$detail->customer_stock_detail_quantity}}</td>
                  <td>{{$detail->customer_stock_detail_unit}}</td>
                  <td>
                    <a href="{{route('cststock_detail_edit',$detail->id)}}"><i class="bx bx-edit-alt"></i> </a>
                    <a href="{{route('cststock_detail_delete',$detail->id)}}"><i class="bx bx-trash-alt" onclick="return confirm('Numune Detayı Silinecek Emin misiniz?')"></i> </a>
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
