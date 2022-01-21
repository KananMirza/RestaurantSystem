@extends('layouts.master')
@section('title','Menular')

@section('content')
    <div class="hero_single inner_pages background-image" data-background="url({{asset('img/hero_menu.jpg')}})">
        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-8">
                        <h1>Yeməklər</h1>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <div class="frame white"></div>
    </div>
    <!-- /hero_single -->

    <div class="pattern_2">
        <div class="container margin_60_40" data-cues="slideInUp">
            @foreach($categories as $category)
            <div class="main_title center">
                <span><em></em></span>
                <h2>{{$category->name}}</h2>
            </div>

            <div class="row justify-content-center magnific-gallery mb-5">
                @foreach(\App\Models\food::where([['status','1'],['category_id',$category->id]])->get() as $food)
                <div class="col-md-4 col-xl-3" data-cue="slideInUp">
                    <div class="item menu_item_grid">
                        <div class="item-img" data-cue="slideInUp">
                            <img src="{{'http://127.0.0.1:5000/'.$food->img}}" alt="">
                            <div class="content">
                                <a href="{{'http://127.0.0.1:5000/'.$food->img}}" title="Food" data-effect="mfp-zoom-in"><i class="arrow_expand"></i></a>
                            </div>
                        </div>
                        <h3>{{$food->name}}</h3>
                        <p>{{$food->ingredient}}</p>
                        <div class="price_box">
                            <p class="new_price">{{$food->price}} AZN</p>
                            @foreach(json_decode($food->properties) as $property)
                                @if($property->price !==null)
                                <p class="new_price">{{$property->name}}-{{$property->price}} AZN</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /col -->
                @endforeach
            </div>
            <!-- /row -->
        @endforeach

            <!-- /row -->
            <p class="text-center"><a href="#0" class="btn_1 outline">Download Menu</a></p>
        </div>
        <!-- /container -->
    </div>
@endsection
