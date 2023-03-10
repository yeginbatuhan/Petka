@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Bülten Listesi')
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
                <th>Bülten Başlığı</th>
                <th>Bülten Yazısı</th>
                <th>Bülten Görüntüsü</th>
                <th>İşlem</th>

              </tr>
              </thead>
              <tbody>
              @foreach($newsdata as $index=>$news)
                <tr>
                  <th scope="row">{{$index+1}}</th>
                  <td>{{$news->new_title}}</td>
                  <td>{{$news->new_text}}</td>
                  <td>

                    <img src="{{asset($news->new_image)}}" style="height:60px; width: 70px">
                  </td>

                  <td>
                    <a href="{{route('new_edit',$news->id)}}"><i class="bx bx-edit-alt"></i></a>
                    <a href="{{route('new_delete',$news->id)}}" ><i class="bx bx-trash-alt" onclick="return confirm('Bülten Silinecek Emin misiniz?')"></i></a>
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
@endsection

{{-- page scripts --}}
@section('page-scripts')
  <script src="{{asset('js/scripts/pages/app-users.js')}}"></script>
@endsection
