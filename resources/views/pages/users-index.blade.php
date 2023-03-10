@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Kullanıcı Listesi')
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
                <th>Sıra Numarası</th>
                <th>User ID</th>
                <th>Kullanıcı Kodu</th>
                <th>Ad Soyad</th>
                <th>E-Mail</th>

                <th>Telefon Numarası</th>
                <th>Kullanıcı Tipi</th>
                <th>İşlem</th>

              </tr>
              </thead>
              <tbody>
              @foreach($usersdata as $user)
              <tr>
                <th scope="row">{{$loop->index+1}}</th>
                <td>{{$user->id}}</td>
                <td>{{$user->user_code}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>

                <td>{{$user->phone_number}}</td>
                <td>
                  @switch($user->user_type)
                    @case(1)
                  Müşteri
                    @break
                    @case(2)
                  Personel
                    @break
                  @endswitch
                </td>
                <td>
                  <a href="{{route('user_edit',$user->id)}}"><i class="bx bx-edit-alt"></i></a>
                  <a href="{{route('user_delete',$user->id)}}" ><i class="bx bx-trash-alt" onclick="return confirm('Kullanıcı ve Kullanıcıya Ait Tüm Bilgiler Silinecek Emin misiniz?')"></i></a>
                  <a href="{{route('update_password',$user->id)}}" class="password-btn"><i class="bx bxs-message-alt-dots" onclick="return confirm('Kullanıcı Şifresi Güncellenip Mail Atılacak, Emin misiniz?')"></i></a>
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
  <script>$(document).on('click', '.password-btn', function (){

      var element = $(this);

      element.hide();

      setTimeout(function() {

        console.log(this); // gives "window"

        element.show();

      }, 4000);
    }); </script>

@endsection

{{-- page scripts --}}
@section('page-scripts')
  <script src="{{asset('js/scripts/pages/app-users.js')}}"></script>
@endsection
