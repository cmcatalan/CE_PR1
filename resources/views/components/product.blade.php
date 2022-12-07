@extends('layouts.layout')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-4">
                    <img class="card-img-top mb-5 mb-md-0"
                         src="{{ asset('assets/img')}}{{$product->image_path}}"
                         alt="{{$product->name}}"/>
                </div>
                <div class="col-md-8">
                    <div class="small mb-1">{{$product->manufacturer}}</div>
                    <h1 class="display-5 fw-bolder">{{$product->name}}</h1>
                    <div class="fs-5 mb-3">
                        @if ($product->is_sale)
                            <span class="badge text-bg-danger">Sale</span>
                            <span class="text-decoration-line-through">{{number_format((double)$product->price, 2, '.', '')}}€</span>
                            <span>{{number_format((double)$product->sale_price, 2, '.', '')}}€</span>
                        @else
                            <span>{{number_format((double)$product->price, 2, '.', '')}}€</span>
                        @endif
                    </div>
                    <p class="lead">{{$product->description}}</p>
                    <div class="d-flex">
                        <a class="btn btn-outline-dark flex-shrink-0"
                           type="button"
                           href="/cart/add/{{$product->product_id}}">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
