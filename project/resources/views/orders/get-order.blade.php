@extends('layouts.master')
@section('title',"Orders | Get")
@section('content')
    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Sifarişlər</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Sifarişlər</li>
                            <li class="breadcrumb-item active" aria-current="page">Sifariş Al</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <!-- Search Form -->
            <div class="col-12 bg-body-dark" style="padding: 25px">
                <form action="be_pages_ecom_products.html" method="POST" onsubmit="return false;">
                    <div class="form-group">
                        <input onkeyup="viewSearch()" type="text" class="form-control form-control-alt input" id="dm-ecom-products-search" name="dm-ecom-products-search" placeholder="Search all products..">
                    </div>
                </form>
            </div>
            <!-- END Search Form -->

            @foreach($categories as $category)
                <div class="search">
                <h2 class="content-heading">{{ $category->name }}</h2>
                <div class="row">
                    @foreach(\App\Http\Controllers\Orders\OrderAdd::getFoods($category->id) as $data)
                    <div class="col-md-6 col-xl-3" >
                        <!-- Story #1 -->
                        <div class="block block-rounded">
                            <div onclick="viewData({{ $data->id }})" class="block-content pb-8 text-right bg-image"
                                 style="cursor: pointer; background-image: url({{ asset($data->img) }});">
                                <a class="badge badge-primary font-w700 p-2 text-uppercase" href="javascript:void(0)">
                                    {{ $category->name }}
                                </a>
                            </div>
                            <div class="block-content">
                                <a class="font-w600 text-dark name" href="javascript:void(0)">
                                   {{ $data->name }}
                                </a>
                                <p class="font-size-sm text-muted mt-1">
                                    Qiyməti:{{ $data->price }} AZN
                                </p>
                                <p class="font-size-sm text-muted mt-1">
                                    Hazırlanma Müddəti:{{ $data->time }}
                                </p>
                            </div>
                            <div class="block-content block-content-full bg-body-light">
                                <div class="row no-gutters font-size-sm text-center">
                                    <div class="col-12">
                                        <a class="text-muted font-w600" onclick="viewData({{ $data->id }})" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-plus mr-1"></i> Əlavə Et
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Story #1 -->
                    </div>
                    @endforeach
                </div>
                </div>
        @endforeach


        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
    <div class="modal fade" id="addOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sifariş</h5>
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
                            <th>Hazırlanma Müddəti</th>
                            <td id="time_view"></td>
                        </tr>
                        <tr>
                            <th>Xüsusiyyətlər</th>
                            <td id="properties_view_td">
                                <select onchange="Sum()" id="properties_view" class="form-control"></select>
                            </td>
                        </tr>
                        <tr>
                            <th>Say</th>
                            <td id="count_td">
                                <input type="number" onchange="Sum()" id="count" value="1" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <th>Qeyd</th>
                            <td id="note_td">
                                <textarea id="note" cols="30" rows="5" class="form-control"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Cəm</th>
                            <td id="sum_td">0 AZN</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                    <button type="button" onclick="AddProduct()" class="btn btn-secondary" data-dismiss="modal">Tamamla</button>
                </div>
            </div>
        </div>
    </div>

    <!-- END Main Container -->
    <div class="modal fade" id="viewAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sifariş</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Şəkil</th>
                            <th scope="col">Məhsul Adı</th>
                            <th scope="col">Qiymət</th>
                            <th scope="col">Say</th>
                            <th scope="col">Ümumi Qiymət</th>
                            <th scope="col">Qeyd</th>
                            <th scope="col">Əməliyyat</th>
                           </tr>
                        </thead>
                        <tbody id="tbody">


                        </tbody>
                    </table>

                    <h3 style="text-align: center" id="total"></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                    <button type="button" class="btn btn-success" id="confirm" onclick="confirmOrder()">Səbəti Təsdiqlə</button>
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
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        const viewData = (id)=>{
            $("#overlay").fadeIn();

            $.ajax({
                type: "POST",
                url: "/food/view/food",
                data: {
                    _token: CSRF_TOKEN, id: id,
                },
                success: async function (data) {
                    let properties = JSON.parse(data.properties);
                    let view_properties = `
                        <option value="" selected="selected" disabled="disabled">Seçim edə bilərsiniz..</option>
                    `;
                    for(let i = 0; i<properties.length; i++){
                        if(properties[i].name == null) continue;
                        view_properties +=  `<option value="${properties[i].price}">${properties[i].name} --- ${properties[i].price} AZN</option>`;
                    }

                    const url = "{{ asset("") }}";
                    document.getElementById('ingredient_view').innerText = data.ingredient;
                    document.getElementById('price_view').innerText = `${data.price} AZN`;
                    document.getElementById('name_view').innerText = data.name;
                    document.getElementById('category_view').innerText = await GetCategory(data.category_id);
                    document.getElementById('time_view').innerText = data.time;
                    document.getElementById('img_view').src = url+data.img;
                    document.getElementById('count').value = 1;
                    document.getElementById('note').value = "";
                    document.getElementById('properties_view').innerHTML = view_properties;
                    Sum();
                    $('#addOrder').modal('show');
                    $("#overlay").fadeOut(300);
                },
                error: function () {
                    alert('Error... 5000');
                }
            })

        }

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
