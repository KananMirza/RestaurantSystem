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
                            <li class="breadcrumb-item">Gözləyən</li>
                            <li class="breadcrumb-item active" aria-current="page">Sifarişlər</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
        <div class="container">
            @include('layouts.error_messages')
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">İstifadəçi İd</th>
                    <th scope="col">Sifaris</th>
                    <th scope="col">Qiymət</th>
                    <th scope="col">Sifaris Tarixi</th>
                    <th scope="col">Status Dəyiş</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $key=>$order)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{ $order->customer_id==0 ? "Restoran Sifarişi" : \App\Models\Customers::find($order->customer_id)->first_name." ".\App\Models\Customers::find($order->customer_id)->last_name  }}</td>
                        <td>
                            <button class="btn btn-outline-info" onclick="viewAllData('{{ $order->details }}')">
                                Detallar
                            </button>
                        </td>
                        <td>{{$order->sub_total}} AZN</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                            <button class="btn btn-outline-danger" onclick="cancelOrder({{$order->id}})">Ləğv et</button>
                            <button class="btn btn-outline-success" id="preparing" onclick="setAcceptingOrder({{$order->id}})">Qəbul Olundu</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- END Page Content -->
    </main>
@endsection


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
                    </tr>
                    </thead>
                    <tbody id="tbody"></tbody>
                </table>

                <h3 style="text-align: center" id="total"></h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cancel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ləğv etmə səbəbini qeyd edin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('CancelOrder') }}" method="POST">
                <input type="hidden" name="id" id="cancel_id"/>
                @csrf
                <div class="modal-body">
                    <textarea name="cancel_content" class="form-control" id="content" cols="30" rows="10"
                              required="required"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                    <button class="btn btn-danger">Ləğv Et</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

@section('js')
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        const viewAllData = (data) => {
            $("#overlay").fadeIn();
            let Card = JSON.parse(data);
            let body = document.getElementById('tbody');
            let tr = "";
            for (let i = 0; i < Card.Foods.length; i++) {
                tr += `
        <tr>
                            <td><img src="${Card.Images[i]}" style="width: 100px;height: 100px" ></td>
                            <td>${Card.Foods[i]}</td>
                            <td>${Card.Prices[i]} AZN</td>
                            <td>${Card.Count[i]}</td>
                            <td>${(Card.Prices[i] * Card.Count[i]).toFixed(2)} AZN</td>
                            <td><textarea value="" class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>${Card.Notes[i] == null ? "" : Card.Notes[i]}</textarea></td>
                        </tr>
        `
            }
            document.getElementById('total').innerText = `Ümumi Qiymət: ${Number(Card.total).toFixed(2)} AZN`
            body.innerHTML = tr;

            $("#viewAll").modal("show")
            $("#overlay").fadeOut(300);
        };

        const cancelOrder = (id) => {
            document.getElementById("cancel_id").value = id;
            $("#cancel").modal("show")
        }

        const setAcceptingOrder = (id) =>{

            $.ajax({
                type: "POST",
                url: "/orders/view/waiting/setacceptingorder",
                data: {
                    _token: CSRF_TOKEN, id: id,
                },
                success: function (data) {
                    if(data==1){
                        swal({
                            title: "Uğurlu!",
                            text: "Sifariş statusu qəbul olundu olaraq dəyiştirildi",
                            icon: "success",
                            button: "Bağla!",
                        });
                        setTimeout(function (){
                            location.reload();
                        },1000)
                    }else{
                        swal("Gözlənilməyən xəta baş verdi!");
                    }


                },
                error: function () {

                }
            });
        }
    </script>

@endsection
