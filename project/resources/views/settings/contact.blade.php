@extends('layouts.master')
@section('title',"Nizamlamalar | Əlaqə")
@section('content')
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Əlaqə</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Nizamlamalar</li>
                            <li class="breadcrumb-item active" aria-current="page">Əlaqə</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            @include('layouts.error_messages')
        <!-- Elements -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Məlumatlar</h3>
                </div>
                <div class="block-content">
                    <form action="{{route('contactIndexUpdate')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Basic Elements -->
                        <div class="row push">
                            <div style="margin: auto" class="col-lg-10 col-xl-10">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" required="required" id="email" name="email"
                                           value="{{ $data[0]->email }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="address">Ünvan</label>
                                    <input type="text" class="form-control" required="required" id="address"
                                           name="address" value="{{ $data[0]->address }}"/>
                                </div>
                                <div class="form-group">
                                    <button type="button"
                                            class="btn btn-outline-info mb-2 button_add">
                                        Telefon nömrəsi əlavə et +
                                    </button>
                                    @foreach($phones as $key=>$phone)
                                        <div class="row properties mb-2" onmouseenter="showButton({{$key}})" onmouseleave="hideButton({{$key}})">
                                            <div class="col-md-5">
                                                <input type="text" class="form-control"
                                                       placeholder="+994121234567" name="phones[]"
                                                       value="{{ $phone }}"/>
                                            </div>
                                            <button type="button" class="btn btn-outline-danger delete" onclick="deletePhone({{$key}})">Sil</button>
                                        </div>


                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- END Basic Elements -->
                        <div class="row mb-2 ml-2">
                            <button class="btn btn-outline-success">Redaktə et</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Elements -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection

@section('css')

    <style>
       .delete{
           display: none;
       }
    </style>

    @endsection
@section('js')
    <script>
        $('.button_add').click(
            function () {
                let count = document.querySelectorAll(".properties").length;
                if (count < 3) {
                    const div = `<div class="row properties mt-2">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control"
                                                   placeholder="+994121234567" name="phones[]"
                                                   value=""/>
                                        </div>
                                    </div>`;
                    $(".properties:last").after(div);
                } else {
                    document.getElementsByClassName("button_add")[0].disabled = true;
                }
            }
        );

       function showButton(id){
        document.getElementsByClassName('delete')[id].style.display = 'inline-block';
       }

       function hideButton(id){
           document.getElementsByClassName('delete')[id].style.display = 'none';
       }

       function deletePhone(id){
            const data = document.getElementsByClassName("properties")[id];
            data.parentNode.removeChild(data);
       }

    </script>
@endsection
