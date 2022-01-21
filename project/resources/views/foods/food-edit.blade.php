@extends('layouts.master')
@section('title',"Foods | Add")
@section('content')
    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">{{$data['name']}}</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Yeməklər</li>
                            <li class="breadcrumb-item active" aria-current="page">Redaktə Et</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <div class="content content-full content-boxed">

            <div class="block block-rounded">
                <div class="block-content">
                    <form method="POST" action="{{route('foodEdit')}}" id="form-add" enctype="multipart/form-data">
                    @include('layouts.error_messages')
                    @csrf
                    <!-- General information -->
                        <h2 class="content-heading pt-0">
                            <i class="si si-settings text-muted mr-1"></i> Yemək Redaktə etmə paneli
                        </h2>
                        <div class="row push">
                                <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="col-md-6 form-group">
                                <label for="edit_category">Kateqoriya Seç</label>
                                <select name="edit_category" id="edit_category" required="required" class="form-control">

                                    @foreach($categories as $category)
                                        @if($data['category_id']==$category->id){
                                        <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                                    }@else{
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    }

                                        @endif

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_name">Yemək adı</label>
                                <input type="text" class="form-control" value="{{$data['name']}}" id="edit_name"
                                       name="edit_name" >
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_ingredient">İngredient</label>
                                <input type="text"  name="edit_ingredient" id="edit_ingredient"
                                       value="{{$data['ingredient']}}"  data-role="tagsinput"/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="edit_price">Qiymət</label>
                                <input type="number" step="0.01" class="form-control"  name="edit_price"
                                       id="edit_price" value="{{$data['price']}}"/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="edit_time">Hazırlanma müddəti</label>
                                <input type="text" class="form-control"  name="edit_time" id="edit_time"
                                       value="{{$data['time']}}"/>
                            </div>

                            <div class="col-md-6 form-group">
                                <p>Aktiv Şəkil: <img src="{{asset($data['img'])}}" style="width: 250px;"></p>

                                <label for="edit_image">Əsas şəkil seç</label>

                                <div class="custom-file">
                                    <input type="file"  class="custom-file-input"
                                           data-toggle="custom-file-input"
                                           id="edit_image" name="edit_image" >
                                    <label class="custom-file-label" for="dm-profile-edit-avatar">Şəkil seçin...</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="button"
                                        class="btn btn-outline-info mb-2 button_add">
                                    Xüsusiyyət əlavə et +
                                </button>

                                    @foreach($properties as $key=>$item)
                                    <div class="row properties" onmouseenter="showButton({{$key}})" onmouseleave="hideButton({{$key}})">
                                    <div class="col-md-5 mb-2" >
                                        <input type="text" class="form-control"
                                               placeholder="1.5 porsiyon iskəndər" name="properties[]"
                                               value="{{$item->name}}"/>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" step="0.01" class="form-control" placeholder="12.50"
                                               name="properties_price[]"
                                               value="{{$item->price}}"/>

                                    </div>
                                        <button type="button" class="btn btn-outline-danger delete" style="height: 40px" onclick="deleteProperties({{$key}})">Sil</button>
                                    </div>
                                        @endforeach


                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="edit_status" class="col-form-label">Status:</label>
                            <select name="edit_status" id="edit_status" class="form-control">
                                @if($data['status']== 1){
                                <option value="1"  selected="selected">Aktiv</option>
                                <option value="0"  >Deaktiv</option>
                                    }@else{
                                <option value="1"  >Aktiv</option>
                                <option value="0"  selected="selected">Deaktiv</option>
                                }
                                @endif

                            </select>
                        </div>
                        <!-- END General information -->

                        <!-- Submit -->
                        <div class="row push">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-alt-primary submit">
                                        <i class="fa fa-check-circle mr-1"></i> Redaktə et
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- END Submit -->
                    </form>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->


@endsection
@section('css')
    <link rel="stylesheet"
          href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet"
          href="{{asset('assets/js/plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/loading.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        .bootstrap-tagsinput {
            width: 100%;
        }

        .label-info {
            background-color: #17a2b8;
        }

        .label {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out,
            border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        #lists {
            display: none;
        }
        .delete{
            display: none;
        }
    </style>
@endsection
@section('js')
    <script src="{{asset('assets/js/plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/flatpickr/flatpickr.min.js')}}"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
          integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg=="
          crossorigin="anonymous"/>

    <script src="{{asset('assets/js/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>

    <script>

        $("#form-add").on("keypress", function (event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });

        $('.button_add').click(
            function () {
                const div = `<div class="row properties mt-2">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" required="required"
                                                   placeholder="1.5 porsiyon iskəndər" name="properties[]"
                                                   value=""/>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" step="0.01" class="form-control" placeholder="12.50"
                                                   required="required" name="properties_price[]"
                                                   value=""/>
                                        </div>
                                    </div>`;
                $(".properties:last").after(div);

            }
        );

        function showButton(id){
            document.getElementsByClassName('delete')[id].style.display = 'inline-block';
        }

        function hideButton(id){
            document.getElementsByClassName('delete')[id].style.display = 'none';
        }

        function deleteProperties(id){
            const data = document.getElementsByClassName("properties")[id];
            data.parentNode.removeChild(data);
        }
    </script>
@endsection
