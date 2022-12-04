@extends('layouts.layout')

@section('content')
    <header class="bg-dark py-1">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-white">
                <h1 class="display-5 fw-bolder">Category {{$category_name}}</h1>
            </div>
        </div>
    </header>
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($products as $product)
                    <div class="col col-md-3">
                        <div class="card h-100">
                            <a href="/product/{{$product->product_id}}">
                                <img class="card-img-top" src="{{ asset('assets/img')}}{{$product->image_path}}"
                                     alt="{{$product->name}}"/>
                            </a>
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{$product->name}}</h5>
                                    @if ($product->is_sale)
                                        <span class="badge text-bg-danger">Sale</span>
                                        <span class="text-decoration-line-through">{{$product->price}}€</span>
                                        <span>{{$product->sale_price}}€</span>
                                    @else
                                        <span>{{$product->price}}€</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center mb-1">
                                    <a class="btn btn-dark btn-outline-light mt-auto"
                                       href="/product/{{$product->product_id}}">View details</a>
                                </div>
                                <div class="text-center">
                                    <a class="btn btn-dark btn-outline-light mt-auto"
                                       href="/cart/add/{{$product->product_id}}">
                                        <i class="bi-cart-fill me-1"></i>
                                        Add
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@stop
