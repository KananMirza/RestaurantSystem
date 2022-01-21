@extends('layouts.master')
@section('title',"Settings | Slider")
@section('content')
    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Slider</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Admin</li>
                            <li class="breadcrumb-item active" aria-current="page">Slider</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <!-- Dynamic Table Full -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    @include('layouts.error_messages')
                    <button class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#exampleModal">
                        Əlavə et
                    </button>
                </div>
                <div class="block-content block-content-full">
                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">#</th>
                            <th style="width: 30%;">Başlıq</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">URL</th>
                            <th class="d-none d-sm-table-cell" style="width: 5%;">STATUS</th>
                            <th>Əməliyyat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $key=>$slider)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->url }}</td>
                                <td>
                                    <span class="badge  badge-{{ $slider->status == 0 ? "danger" : "success" }}">{{ $slider->status == 0 ? "Deaktiv" : "Aktiv" }}</span>
                                </td>
                                <td>
                                    <button class="btn btn-outline-info" onclick="viewData({{ $slider->id }})">Ətraflı</button>
                                    <button class="btn btn-outline-primary" onclick="editSlider({{$slider->id}})">Redaktə et</button>
                                    <button class="btn btn-outline-danger" onclick="deleteSlider({{ $slider->id }})">Sil</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full -->

        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yeni Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('layouts.error_messages')
                    <form action="{{route('addSlider')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="col-form-label">Basliq:</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="btn_title" class="col-form-label">Button basliq:</label>
                            <input type="text" class="form-control" id="btn_title" name="btn_title">
                        </div>
                        <div class="form-group">
                            <label for="url" class="col-form-label">URL:</label>
                            <input type="text" class="form-control" id="url" name="url">
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-form-label">Sekil:</label>
                            <input type="file" class="form-control" id="url" name="image">
                        </div>
                        <div class="form-group">
                            <label for="publish_date" class="col-form-label">Baslama vaxti:</label>
                            <input type="date" class="form-control" id="publish_date" name="publish_date">
                        </div>
                        <div class="form-group">
                            <label for="end_date" class="col-form-label">Baslama vaxti:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Əlavə et</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Bagla</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="viewSlider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Slider bax</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-responsive">
                        <tr>
                            <th>Şəkil</th>
                            <td id="view_img"></td>
                        </tr>
                        <tr>
                            <th>Başlıq</th>
                            <td id="view_title"></td>
                        </tr>
                        <tr>
                            <th>Button başlığı</th>
                            <td id="view_btn"></td>
                        </tr>
                        <tr>
                            <th>URL</th>
                            <td id="view_url"></td>
                        </tr>
                        <tr>
                            <th>Başlama tarixi</th>
                            <td id="view_start"></td>
                        </tr>
                        <tr>
                            <th>Bitmə tarixi</th>
                            <td id="view_end"></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td id="view_status"></td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editSlider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Slider Redaktə</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('layouts.error_messages')
                    <form action="{{route('updateSlider')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input id="id" hidden value="" name="id">
                        <div class="form-group">
                            <label for="edit_title" class="col-form-label">Basliq:</label>
                            <input type="text" class="form-control" id="edit_title" name="edit_title">
                        </div>
                        <div class="form-group">
                            <label for="edit_btn_title" class="col-form-label">Button basliq:</label>
                            <input type="text" class="form-control" id="edit_btn_title" name="edit_btn_title">
                        </div>
                        <div class="form-group">
                            <label for="edit_url" class="col-form-label">URL:</label>
                            <input type="text" class="form-control" id="edit_url" name="edit_url">
                        </div>
                        <div class="form-group">
                            <label for="img">Cari şəkil:</label>
                            <div id="img"></div>
                            <label for="edit_image" class="col-form-label">Sekil:</label>
                            <input type="file" class="form-control" id="edit_image" name="edit_image">
                        </div>
                        <div class="form-group">
                            <label for="edit_publish_date" class="col-form-label">Baslama vaxti:</label>
                            <input type="date" class="form-control" id="edit_publish_date" name="edit_publish_date">
                        </div>
                        <div class="form-group">
                            <label for="edit_end_date" class="col-form-label">Bitme vaxti:</label>
                            <input type="date" class="form-control" id="edit_end_date" name="edit_end_date">
                        </div>
                        <div class="form-group">
                            <label for="edit_status" class="col-form-label">Vəziyyət:</label>
                            <select class="form-control" id="edit_status" name="edit_status">

                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Təsdiqlə</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Bagla</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection
@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
    <script>
        const deleteSlider = (id) =>{
            swal({
                title: "Diqqət!",
                text: "Silinən slider geri qaytarılmır!",
                icon: "warning",
                buttons: ['Xeyr','Bəli'],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        location.href = `/slider/delete/${id}`;
                    } else {
                        swal("İmtina edildi!");
                    }
                });
        };
        const viewData = (id)=>{
            const url = '{{ asset('') }}';
            $.ajax({
                type: "POST",
                url: "/slider/view",
                data: {
                    _token: CSRF_TOKEN, id: id,
                },
                success: function (data) {
                    document.getElementById("view_img").innerHTML = `<img style="height: 55px; width: auto;" src="${url+data.image}" />`;
                    document.getElementById("view_title").innerText = data.title;
                    document.getElementById("view_btn").innerText = data.btn_title;
                    document.getElementById("view_start").innerText = data.publish_date;
                    document.getElementById("view_end").innerText = data.finish_date;
                    document.getElementById("view_url").innerHTML = `<a href="${ data.url}"><button class="btn btn-outline-info">Keçid et</button></a>`;
                    document.getElementById("view_status").innerHTML = `<span class="badge  badge-${ data.status === "0" ? "danger" : "success" }">${ data.status === "0" ? "Deaktiv" : "Aktiv" }</span>`;
                    $("#viewSlider").modal("show");
                },
                error: function () {
                    alert('Error... 5000');
                }
            })
        };
        const editSlider = (id) => {
            const url = '{{ asset('') }}';
            $.ajax({
                type: "POST",
                url: "/slider/edit/view",
                data: {
                    _token: CSRF_TOKEN, id: id,
                },
                success: function (data) {
                    console.log(data)
                    document.getElementById("img").innerHTML = `<img style="height: 55px; width: auto;" src="${url+data.image}" />`;
                    document.getElementById("edit_title").value = data.title;
                    document.getElementById("edit_btn_title").value = data.btn_title;
                    document.getElementById("edit_publish_date").value = data.publish_date.substr(0,10);
                    document.getElementById("edit_end_date").value = data.finish_date.substr(0,10);
                    document.getElementById("edit_url").value = data.url;
                    document.getElementById("id").value = data.id;
                    document.getElementById("edit_status").innerHTML = ` <option value="0" ${data.status==0 ? 'selected' : ''}>Deaktiv</option>
                                                                            <option value="1" ${data.status==1 ? 'selected' : ''}>Aktiv</option>`;
                    $('#editSlider').modal('show');
                },
                error: function () {
                    alert('Error... 5000');
                }
            })

        }
    </script>
@endsection
