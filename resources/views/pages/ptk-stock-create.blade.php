@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title','Petka Kalıp | Anasayfa')
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
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
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
  <br>
  <br>
  <br>
  <br>


  <br>
  <br>


  <section class="faq-bottom" style="margin-top: -60px;">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">
              Petka Stok Ekleme Alanı
            </h4>
          </div>
          <div class="card-body">
            <form class="form repeater-default" action="{{route('ptk_stock_store')}}" method="POST">
              @csrf
              <div>
                <label for="defaultFormControlInput" class="form-label">Müşteri Seçiniz</label>

                <select class="select2 form-control" name="user_id" id="select_box" required>
                  <option  disabled selected>Müşteriyi Seçiniz</option>
                  @foreach($userid as $data)
                    <option value="{{$data->id}}">{{$data->name}}</option>
                  @endforeach
                </select>
                @error('user_id')

                <span class="text-danger">{{$message}}</span>

                @enderror
              </div>
              <div>
                <label for="defaultFormControlInput" class="form-label">Proje Kodu Girin</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  aria-describedby="defaultFormControlHelp"
                  name="petka_stock_code"
                  required

                />
              </div>
              <div>
                <label for="defaultFormControlInput" class="form-label">Proje Adı Girin TR</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  aria-describedby="defaultFormControlHelp"
                  name="petka_stock_name_tr"


                />
              </div>
              <div>
                <label for="defaultFormControlInput" class="form-label">Proje Adı Girin EN</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  aria-describedby="defaultFormControlHelp"
                  name="petka_stock_name_en"

                />
              </div>
              <h4 class="card-title mt-3">Stok Detayları</h4>
              <hr>

              <div data-repeater-list="detail">
                <div data-repeater-item>

                  <div class="row justify-content-between">
                    <div class="col-md-2 col-sm-12 form-group">
                      <label for="Email">Ürün Kodu </label>
                      <input type="text" class="form-control" id="Name" name="petka_stock_detail_code" required>
                    </div>
                    <div class="col-md-2 col-sm-12 form-group">
                      <label for="Email">Ürün Adı TR </label>
                      <input type="text" class="form-control" id="Name" name="petka_stock_detail_name_tr" >
                    </div>
                    <div class="col-md-2 col-sm-12 form-group">
                      <label for="Email">Ürün Adı EN </label>
                      <input type="text" class="form-control" id="Name" name="petka_stock_detail_name_en">
                    </div>

                    <div class="col-md-2 col-sm-12 form-group">
                      <label for="Email">Miktar </label>
                      <input type="text" class="form-control" id="Name" name="petka_stock_detail_quantity" required>
                    </div>
                    <div class="col-md-2 col-sm-12 form-group d-flex align-items-center pt-2">
                      <button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button"> <i
                          class="bx bx-x"></i>
                        SİL
                      </button>
                    </div>
                  </div>
                  <hr>
                </div>
              </div>
              <div class="form-group">
                <div class="col p-0">
                  <button class="btn btn-primary" data-repeater-create type="button"><i class="bx bx-plus"></i>
                    EKLE
                  </button>
                </div>

              </div>


          </div>
          <button type="submit" class="btn btn-success" style="color:#000000 ;font-family:arial;"><b>KAYDET</b></button>
          </form>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('vendor-scripts')
  <script src="{{asset('js/scripts/forms-extras.js')}}"> </script>
  <script src="{{asset('vendors/js/extensions/swiper.min.js')}}"></script>
  <script src="{{asset('vendors/js/extensions/shepherd.min.js')}}"></script>
  <script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
  <script src="{{asset('js/scripts/forms/form-repeater.js')}}"></script>
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
    });
  </script>
  <script>
    // var select_box_element = document.querySelector('#select_box');
    // dselect(select_box_element,{
    //   search: true
    // });



  </script>

  <script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
  <script src="{{asset('js/scripts/forms/select/form-select2.js')}}"></script>
@endsection
