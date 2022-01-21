@extends('layouts.master')
@section('title',"Foods | List")
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
                            <li class="breadcrumb-item active" aria-current="page">Siyahı</li>
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
                    <a href="{{ route('viewAdd') }}">
                        <button class="btn btn-outline-primary float-right">Əlavə
                            et
                        </button>
                    </a>
                </div>
                <div class="block-content block-content-full">
                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Kateqoriya</th>
                            <th>Adı</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Status</th>
                            <th style="width: 35%;">Əməliyyat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $food)
                            <tr>
                                <td>{{ $food->id }}</td>
                                <td>{{ $food->category()->name }}</td>
                                <td>{{ $food->name }}</td>
                                <td>
                                    @if($food->status=="1")
                                        <span class="badge badge-success">Aktiv</span>
                                    @elseif($food->status=="0")
                                        <span class="badge badge-danger">Deaktiv</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-outline-info" onclick="viewData({{ $food->id }})">Bax</button>
                                     <a href="{{'/food/edit/'.$food->id}}"><button class="btn btn-outline-success" >Redaktə et</button></a>
                                    <button class="btn btn-outline-danger" onclick="deleteFood({{ $food->id }})">Sil</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Məlumatlar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table view-table">
                        <tr>
                            <th>Şəkil</th>
                            <td ><img style="width: 100% !important; height: 200px;" id="img_view"></td>
                        </tr>
                        <tr>
                            <th>Kateqoriya</th>
                            <td id="category_view"></td>
                        </tr>
                        <tr>
                            <th>Məhsul</th>
                            <td id="name_view"></td>
                        </tr>
                        <tr>
                            <th>Qiymət</th>
                            <td id="price_view"></td>
                        </tr>
                        <tr>
                            <th>İngredient</th>
                            <td id="ingredient_view"></td>
                        </tr>
                        <tr>
                            <th>Properties</th>
                            <td id="properties_view"></td>
                        </tr>
                        <tr>
                            <th>Hazırlanma Müddəti</th>
                            <td id="time_view"></td>
                        </tr>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <style>
        #overlay{
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height:100%;
            display: none;
            background: rgba(0,0,0,.6);
        }
        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }
        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }
        .is-hide{
            display:none;
        }
    </style>
@endsection
@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
    <script>
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        const viewData = (id)=>{
            $("#overlay").fadeIn();

            $.ajax({
                type: "POST",
                url: "/food/view/food",
                data: {
                    _token: CSRF_TOKEN, id: id,
                },
                success: async function (data) {
                    console.log( JSON.parse(data.properties));
                    let properties = JSON.parse(data.properties);
                    let view_properties = '';
                    for(let i = 0; i<properties.length; i++){
                        view_properties += `${properties[i].name} --- ${properties[i].price} AZN <hr />`;
                    }

                    const url = "{{ asset("") }}";
                    document.getElementById('ingredient_view').innerText = data.ingredient;
                    document.getElementById('price_view').innerText = `${data.price} AZN`;
                    document.getElementById('name_view').innerText = data.name;
                    document.getElementById('category_view').innerText = await GetCategory(data.category_id);
                    document.getElementById('time_view').innerText = data.time;
                    document.getElementById('img_view').src = url+data.img;
                    document.getElementById('properties_view').innerHTML = view_properties;
                    $('#exampleModal').modal('show');
                    $("#overlay").fadeOut(300);
                },
                error: function () {
                    alert('Error... 5000');
                }
            })

        }

        const deleteFood = (id) =>{
            swal({
                title: "Diqqət!",
                text: "Silinən məhsul geri qaytarılmır!",
                icon: "warning",
                buttons: ['Xeyr','Bəli'],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                       location.href = `/food/delete/${id}`;
                    } else {
                        swal("İmtina edildi!");
                    }
                });
        };

        const GetCategory = (id) => {
            return new Promise(function (resolve, reject) {
                $.ajax({
                    type: "POST",
                    url: "/food/view/category",
                    data: {
                        _token: CSRF_TOKEN, id: id,
                    },
                    success: function (data) {
                        if(data !== 0){
                            resolve(data.name);
                        }
                        reject('Error... 5011');
                    },
                    error: function () {
                        reject('Error... 5011');
                    }
                });
            });
        };

    </script>
@endsection
