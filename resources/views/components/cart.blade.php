@extends('layouts.layout')

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <div>
                                    <h4 class="mb-1"><i class="bi bi-cart-fill"></i> Shopping cart</h4>
                                    <p class="mb-0">You have {{$count_items}} items in your cart</p>
                                </div>
                            </div>
                            @foreach ($cart as $cart_item)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between border-bottom">
                                        <div class="d-flex flex-row align-items-center">
                                            <div>
                                                <img
                                                    src="{{ asset('assets/img')}}{{$cart_item['image_path']}}"
                                                    class="img-fluid"
                                                    alt="{{$cart_item['name']}}"
                                                    style="width: 100px;">
                                            </div>
                                            <div class="ms-3">
                                                <p class="small mb-0">{{$cart_item['manufacturer']}}</p>
                                                <small>{{$cart_item['name']}}</small>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center">
                                            <div style="width: 50px;">
                                                <h5 class="fw-normal mb-0">{{$cart_item['quantity']}}</h5>
                                            </div>
                                            <div style="width: 80px;">
                                                <h5 class="mb-0">{{$cart_item['quantity']}}</h5>
                                            </div>
                                            <a href="#!" class="text-black"><i class="bi-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
