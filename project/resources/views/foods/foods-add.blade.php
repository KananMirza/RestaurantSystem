@extends('layouts.master')
@section('title',"Foods | Add")
@section('content')
    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Yeməklər</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Yeməklər</li>
                            <li class="breadcrumb-item active" aria-current="page">Əlavə Et</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <div class="content content-full content-boxed">

            <div class="block block-rounded">
                <div class="block-content">
                    <form method="POST" action="{{ route('foodAdd') }}" id="form-add" enctype="multipart/form-data">
                    @include('layouts.error_messages')
                    @csrf
                    <!-- General information -->
                        <h2 class="content-heading pt-0">
                            <i class="si si-settings text-muted mr-1"></i> Yemək Əlavə etmə paneli
                        </h2>
                        <div class="row push">

                            <div class="col-md-6 form-group">
                                <label for="category">Kateqoriya Seç</label>
                                <select name="category" id="category" required="required" class="form-control">
                                    <option value="" selected="selected" disabled="disabled">Kateqoriya seçin</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="name">Yemək adı</label>
                                <input type="text" class="form-control" value="{{ old('name') }} " id="name"
                                       name="name" required="required">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="ingredient">İngredient</label>
                                <input type="text" required="required" name="ingredient" id="ingredient"
                                       value="{{ old('ingredient') }} " data-role="tagsinput"/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="price">Qiymət</label>
                                <input type="number" step="0.01" class="form-control" required="required" name="price"
                                       id="price" value="{{ old('price') }} "/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="time">Hazırlanma müddəti</label>
                                <input type="text" class="form-control" required="required" name="time" id="time"
                                       value="{{ old('time') }} "/>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="title">Əsas şəkil seç</label>
                                <div class="custom-file">
                                    <input type="file" required class="custom-file-input"
                                           data-toggle="custom-file-input"
                                           id="image" name="image">
                                    <label class="custom-file-label" for="dm-profile-edit-avatar">Şəkil
                                        seçin...</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="button"
                                        class="btn btn-outline-info mb-2 button_add">
                                    Xüsusiyyət əlavə et +
                                </button>
                                <div class="row properties">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control"
                                               placeholder="1.5 porsiyon iskəndər" name="properties[]"
                                               value=""/>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" step="0.01" class="form-control" placeholder="12.50"
                                                name="properties_price[]"
                                               value=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END General information -->

                        <!-- Submit -->
                        <div class="row push">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-alt-primary submit">
                                        <i class="fa fa-check-circle mr-1"></i> Əlavə et
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

    </script>
@endsection
