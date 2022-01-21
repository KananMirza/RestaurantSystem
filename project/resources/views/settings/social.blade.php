@extends('layouts.master')

@section('title',"Nizamlamalar | Sosial Linkler")
@section('content')
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Sosial Link</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Nizamlamalar</li>
                            <li class="breadcrumb-item active" aria-current="page">Sosial Link</li>
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
                    <form action="{{route('socialIndexUpdate')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Basic Elements -->
                        <div class="row push">
                            <div style="margin: auto" class="col-lg-10 col-xl-10">
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" class="form-control" required="required" id="twitter" name="twitter"
                                           value="{{$data[0]}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" class="form-control" required="required" id="facebook"
                                           name="facebook" value="{{$data[1]}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" class="form-control" required="required" id="instagram"
                                           name="instagram" value="{{$data[2]}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="youtube">Youtube</label>
                                    <input type="text" class="form-control" required="required" id="youtube"
                                           name="youtube" value="{{$data[3]}}"/>
                                </div>
                            </div>
                        </div>

                        <!-- END Basic Elements -->
                        <div class="row mb-2 ml-2">
                            <button class="btn btn-outline-success mb-2 ml-2">Redaktə et</button>
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

