@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','İzin Detay Listesi')
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

        <a style="position: absolute; right: 25px; top: 3px;" href="{{route('permit_detail_add',$dtid)}}">
          <button type="submit" class="btn btn-success" style="color:#000000 ;font-family:arial;"><b> Yeni Ekle</b>

          </button>
        </a>

        <div class="card-body mt-2">
          <!-- datatable start -->
          <div class="table-responsive">
            <table id="detail-list-datatable" class="table responsive nowrap" style="width:100%">
              <thead>
              <tr>
                <th>Başlangıç Tarihi</th>
                <th>Bitiş Tarihi</th>
                <th>Kullanılan Gün</th>
                <th>İşlem</th>

              </tr>
              </thead>
              <tbody>
              @foreach($data as $detail)
                <tr>
                  <td>{{$detail->permit_detail_start_date}}</td>
                  <td>{{$detail->permit_detail_end_date}}</td>
                  <td>{{$detail->permit_detail_use_day}}</td>


                  <td>
                    <a href="{{route('permit_detail_edit',$detail->id)}}"><i class="bx bx-edit-alt"></i> </a>
                    <a href="{{route('permit_detail_delete',$detail->id)}}"><i class="bx bx-trash-alt" onclick="return confirm('İzin Detayı Silinecek Emin misiniz?')"></i> </a>
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
