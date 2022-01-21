@extends('layouts.master')
@section('title',"Nizamlamalar | Ümumi")
@section('content')
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Ümumi Nizamlamalar</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Nizamlamalar</li>
                            <li class="breadcrumb-item active" aria-current="page">Ümumi Nizamlamalar</li>
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
                    <form action="{{route('generalIndexUpdate')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Basic Elements -->
                        <div class="row push">
                            <div style="margin: auto" class="col-lg-10 col-xl-10">
                                <div class="form-group">
                                    <label for="title">Başlıq</label>
                                    <input type="text" class="form-control" required="required" id="title" name="title" value="{{ $data[0]->title }}" />
                                </div>
                                <div class="form-group">
                                    <label for="description">Açıqlama</label>
                                    <input type="text" class="form-control" required="required" id="description" name="description" value="{{ $data[0]->description }}" />
                                </div>
                                <div class="form-group">
                                    <label for="keywords">Açar sözlər</label>
                                    <input type="text" class="form-control" required="required" id="keywords" name="keywords" value="{{ $data[0]->keywords }}" />
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
