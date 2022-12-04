@extends('layouts.layout')

@section('content')
    <header class="bg-dark py-1">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Gourmand</h1>
                <p class="lead fw-normal text-white-50 mb-0">Exclusive fragrances for men</p>
            </div>
        </div>
    </header>
    <main class="py-5">
        <div class="container">
            <h3>Categories</h3>
            <hr/>
            <div class="row justify-content-center">
                @foreach ($categories as $category)
                    <div class="col col-md-3 mb-4">
                        <a class="text-decoration-none text-black" href="/category/{{$category->category_id}}">
                            <div class="card h-100">
                                <img class="card-img-top" src="{{ asset('assets/img')}}{{$category->image_path}}"
                                     alt=""/>
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <h5 class="fw-bolder">{{$category->name}}</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@stop
