@extends('layouts.app') {{-- appel du cadre de la page resources/views/layouts/app.blade.php --}}

@section('title', 'Galerie') {{-- définition du titre de cette page --}}

@section('content')

    <h1 class="pb-3 border-bottom">Galerie</h1>
    
    <div class="row my-3">
        <div class="col-sm-4">
            <img src="https://cdn.pixabay.com/photo/2017/09/15/22/31/luxembourg-2753846_640.jpg" alt="" class="img-thumbnail">
        </div>
        <div class="col-sm-4">
            <img src="https://cdn.pixabay.com/photo/2017/08/16/14/22/luxembourg-2647943_640.jpg" alt="" class="img-thumbnail">
        </div>
        <div class="col-sm-4">
            <img src="https://cdn.pixabay.com/photo/2017/09/15/07/47/port-2751359_640.jpg" alt="" class="img-thumbnail">
        </div>
    </div>
    <div class="row my-3">
        <div class="col-sm-4">
            <img src="https://cdn.pixabay.com/photo/2020/12/23/08/31/village-5854260_640.jpg" alt="" class="img-thumbnail">
        </div>
        <div class="col-sm-4">
            <img src="https://cdn.pixabay.com/photo/2022/04/22/20/54/assisi-city-7150611_640.jpg" alt="" class="img-thumbnail">
        </div>
        <div class="col-sm-4">
            <img src="https://cdn.pixabay.com/photo/2016/08/31/11/30/transamerica-pyramid-1633204_640.jpg" alt="" class="img-thumbnail">
        </div>
    </div>
    <div class="row my-3">
        <div class="col-sm-4">
            <img src="{{ asset('images/image1.jpg') }}" alt="" class="img-thumbnail">
        </div>
        <div class="col-sm-4">
            <img src="{{ asset('images/image2.jpg') }}" alt="" class="img-thumbnail">
        </div>
        <div class="col-sm-4">
            <img src="{{ asset('images/image3.jpg') }}" alt="" class="img-thumbnail">
        </div>
    </div>

@endsection