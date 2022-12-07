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
                            @foreach ($cart as $id => $cart_item)
                                <div class="mb-3 cart-item" data-id="{{$id}}">
                                    <div class="d-flex justify-content-between border-bottom">
                                        <a class="text-black text-decoration-none" href="/product/{{$id}}">
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
                                                    <p class="mb-1">{{$cart_item['name']}}</p>
                                                    <div>
                                                        @if ($cart_item['is_sale'])
                                                            <span class="badge text-bg-danger">Sale</span>
                                                            <span class="text-decoration-line-through">
                                                                {{number_format((double)$cart_item['price'], 2, '.', '')}}€
                                                            </span>
                                                            <span>{{number_format((double)$cart_item['sale_price'], 2, '.', '')}}€</span>
                                                        @else
                                                            <span>{{number_format((double)$cart_item['price'], 2, '.', '')}}€</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="d-flex flex-row align-items-center">

                                            <div class="mb-0 text-center px-1" style="width: 75px;">
                                                <input class="form-control form-control-sm update-cart"
                                                       aria-label="Qty"
                                                       type="number"
                                                       value="{{$cart_item['quantity']}}"/>
                                            </div>
                                            <div class="mb-0 text-center px-1" style="width: 75px;">
                                                <span class="small fw-bolder">
                                                    {{ number_format((double)($cart_item['is_sale'] ? $cart_item['sale_price'] : $cart_item['price']) * $cart_item['quantity'], 2, '.','') }}€
                                                </span>
                                            </div>
                                            <div class="mb-0 text-center">
                                                <button class="btn btn-sm btn-danger remove-from-cart">
                                                    <i class="bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <p class="fs-5 text-end mb-1">
                                <small>Total:</small>
                                <span class="fw-bolder">{{number_format((double)$total, 2, '.', '')}}€</span>
                            </p>
                            <div class="text-end">
                                <a type="button" class="btn btn-dark btn-sm" href="/checkout">
                                    checkout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('scripts')
    <script type="text/javascript">

        $(".update-cart").change(function (e) {
            e.preventDefault();

            let element = $(this);

            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: element.parents("div.cart-item").attr("data-id"),
                    quantity: element.val()
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            let element = $(this);

            if (confirm("Are you sure want to remove?")) {
                $.ajax({
                    url: '{{ route('remove.from.cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: element.parents("div.cart-item").attr("data-id")
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });

    </script>
@endsection
