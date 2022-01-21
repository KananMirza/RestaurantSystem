@extends('layouts.master')
@section('title',"Admin | Users")
@section('content')
    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">İstifadəçilər</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Admin</li>
                            <li class="breadcrumb-item active" aria-current="page">İstifadəçilər</li>
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
                        <button class="btn btn-outline-primary float-right"  data-toggle="modal" data-target="#add">Əlavə et</button>
                </div>
                <div class="block-content block-content-full">
                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Adı</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Rolu</th>
                            <th style="width: 15%;">Əməliyyat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key=>$user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ \App\Http\Controllers\General\General::getRoleName($user->roles) }}</td>
                                <td>
                                    <button onclick="viewEmp({{ $user->id }})" class="btn btn-outline-primary">Redaktə
                                        Et
                                    </button>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">İstifadəçi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('UserUpdate') }}">
                        @csrf
                        <input type="hidden" name="edit_id" id="edit_id"/>
                        <div class="form-group">
                            <label for="edit_name" class="col-form-label">Şəkil:</label> <br/>
                            <img style="width: 100px; height: 100px" id="edit-img" src="" alt=""/>
                        </div>
                        <div class="form-group">
                            <label for="edit_name" class="col-form-label">Ad Soyad:</label>
                            <input type="text" class="form-control" name="edit_name" id="edit_name">
                        </div>
                        <div class="form-group">
                            <label for="edit_email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" name="edit_email" id="edit_email">
                        </div>
                        <div class="form-group">
                            <label for="edit_password" class="col-form-label">Şifrə (Min 8 simvol):</label>
                            <input type="text" class="form-control" name="edit_password" id="edit_password">
                        </div>
                        <div class="form-group">
                            <label for="edit_roles" class="col-form-label">Rolu:</label>
                            <select name="edit_roles" id="edit_roles" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label for="edit_position" class="col-form-label">Vəzifə:</label>
                            <input type="text" class="form-control" name="edit_position" id="edit_position">
                        </div>
                        <div class="form-group">
                            <label for="edit_status" class="col-form-label">Status:</label>
                            <select name="edit_status" id="edit_status" class="form-control"></select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                            <button type="submit" class="btn btn-primary">Redaktə et</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">İstifadəçi Əlavə</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('UserAdd') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Ad Soyad:</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="roles" class="col-form-label">Rolu:</label>
                            <select name="roles" id="roles" class="form-control">
                                <option value="" disabled="disabled" selected="selected">Seçim edin...</option>
                                <option value="1">Super Admin</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="position" class="col-form-label">Vəzifə:</label>
                            <input type="text" class="form-control" name="position" id="position">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                            <button type="submit" class="btn btn-primary">Əlavə et</button>
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
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
    <script !src="">
        const viewEmp = (id) => {
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "POST",
                url: "/admin/view/emp",
                data: {
                    _token: CSRF_TOKEN, id: id,
                },
                success: function (data) {
                    if (data === 0) {
                        alert('Error... 5001');
                    } else {
                        let url = `{{ asset("") }}`;
                        let roles = `
                                <option value="2" selected="selected">Admin</option>
                            `;
                        let status = `
                                <option value="1" ${data.status == "1" ? 'selected="selected"' : ""}>Aktiv</option>
                                <option value="0"${data.status == "0" ? 'selected="selected"' : ""}>Deaktiv</option>
                            `;
                        document.getElementById("edit_id").value = id;
                        document.getElementById("edit_name").value = data.name;
                        document.getElementById("edit_email").value = data.email;
                        document.getElementById("edit_position").value = data.position;
                        document.getElementById("edit_roles").innerHTML = roles;
                        document.getElementById("edit_status").innerHTML = status;
                        document.getElementById("edit-img").src = url + data.images;
                        $('#exampleModal').modal('show');
                    }
                },
                error: function () {
                    alert('Error... 5000');
                }
            })
        }
    </script>
@endsection
