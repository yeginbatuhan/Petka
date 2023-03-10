@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Log Kayıtları')
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
            <table id="users-list-datatable" class="table">
              <thead>
              <tr>
                <th style="width: 20px;">S.Numarası</th>
                <th>Kişi Adı</th>
                <th>Olay</th>
                <th>Tarih</th>


              </tr>
              </thead>
              <tbody>
              @foreach($data as $index=>$datalog)
                <tr>
                  <th scope="row">{{$index+1}}</th>

                  <td>{{\App\Helpers\Helper::getLogUser($datalog->causer_id)->name}}</td>
                  <td>{{$datalog->description}}</td>
                  <td>{{$datalog->created_at}}</td>
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
@endsection

{{-- page scripts --}}
@section('page-scripts')
  <script src="{{asset('js/scripts/pages/app-users.js')}}"></script>
@endsection
