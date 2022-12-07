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
                                    <h4 class="mb-1"><i class="bi bi-cart-check-fill"></i> Checkout</h4>
                                </div>
                            </div>
                            @foreach ($cart as $id => $cart_item)
                                <div class="mb-3 cart-item" data-id="{{$id}}">
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
                                        <div class="d-flex flex-row align-items-center">

                                            <div class="mb-0 text-center px-1" style="width: 75px;">
                                                <span><small>Qty. {{$cart_item['quantity']}}</small></span>
                                            </div>
                                            <div class="mb-0 text-center px-1" style="width: 75px;">
                                                <span class="small fw-bolder">
                                                    {{ number_format((double)($cart_item['is_sale'] ? $cart_item['sale_price'] : $cart_item['price']) * $cart_item['quantity'], 2, '.','') }}€
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <p class="fs-5 text-end mb-1">
                                <small>Total:</small>
                                <span class="fw-bolder">{{number_format((double)$total, 2, '.', '')}}€</span>
                            </p>
                            <div>
                                <h4>Complete your order</h4>
                                <form class="px-5 mx-5" action="/checkout" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <h5>Contact form:</h5>
                                        <div class="d-flex flex-row justify-content-start mb-2">
                                            <div class="flex-fill me-1">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control"
                                                       id="phone"
                                                       name="phone"
                                                       required>
                                            </div>
                                            <div class="flex-fill me-1">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control"
                                                       id="email"
                                                       name="email"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <h5>Delivery form:</h5>
                                        <div class="d-flex flex-row justify-content-start mb-2">
                                            <div class="me-1 flex-fill">
                                                <label for="delivery_first_name" class="form-label">First name</label>
                                                <input type="text" class="form-control"
                                                       id="delivery_first_name"
                                                       name="delivery_first_name"
                                                       required>
                                            </div>
                                            <div class="me-1 flex-fill">
                                                <label for="delivery_last_name" class="form-label">Last name</label>
                                                <input type="text" class="form-control"
                                                       id="delivery_last_name"
                                                       name="delivery_last_name"
                                                       required>
                                            </div>
                                            <div class="me-1 flex-fill">
                                                <label for="delivery_person_id"
                                                       class="form-label">Identification</label>
                                                <input type="text" class="form-control"
                                                       id="delivery_person_id"
                                                       name="delivery_person_id"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row justify-content-start mb-2">
                                            <div class="me-1 flex-fill">
                                                <label for="delivery_country" class="form-label">Country</label>
                                                <input type="text" class="form-control"
                                                       id="delivery_country"
                                                       name="delivery_country"
                                                       required>
                                            </div>
                                            <div class="me-1 flex-fill">
                                                <label for="delivery_city" class="form-label">City</label>
                                                <input type="text" class="form-control"
                                                       id="delivery_city"
                                                       name="delivery_city"
                                                       required>
                                            </div>
                                            <div class="me-1">
                                                <label for="delivery_address_zip_code" class="form-label">
                                                    Zip code
                                                </label>
                                                <input type="text" class="form-control"
                                                       id="delivery_address_zip_code"
                                                       name="delivery_address_zip_code"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row justify-content-start mb-2">
                                            <div class="me-1 flex-fill">
                                                <label for="delivery_address" class="form-label">Address</label>
                                                <input type="text" class="form-control"
                                                       id="delivery_address"
                                                       name="delivery_address"
                                                       required>
                                            </div>
                                            <div class="me-1">
                                                <label for="delivery_address_number" class="form-label">
                                                    Address number
                                                </label>
                                                <input type="text" class="form-control"
                                                       id="delivery_address_number"
                                                       name="delivery_address_number"
                                                       required>
                                            </div>
                                            <div class="me-1 flex-fill">
                                                <label for="delivery_address_addition" class="form-label">Address
                                                    addition</label>
                                                <input type="text" class="form-control"
                                                       id="delivery_address_addition"
                                                       name="delivery_address_addition">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            onclick="toggle('.invoice_form', this)"
                                            class="form-check-input"
                                            type="checkbox"
                                            value=""
                                            id="is_billing_data_different"
                                            name="is_billing_data_different">
                                        <label class="form-check-label" for="is_billing_data_different">
                                            Invoice form data different than delivery form data
                                        </label>
                                    </div>
                                    <div class="mb-3 invoice_form">
                                        <h5>Invoice form:</h5>
                                        <div class="d-flex flex-row justify-content-start mb-2">
                                            <div class="me-1 flex-fill">
                                                <label for="invoice_first_name" class="form-label">First name</label>
                                                <input type="text" class="form-control"
                                                       id="invoice_first_name"
                                                       name="invoice_first_name">
                                            </div>
                                            <div class="me-1 flex-fill">
                                                <label for="invoice_last_name" class="form-label">Last name</label>
                                                <input type="text" class="form-control"
                                                       id="invoice_last_name"
                                                       name="invoice_last_name">
                                            </div>
                                            <div class="me-1 flex-fill">
                                                <label for="invoice_person_id"
                                                       class="form-label">Identification</label>
                                                <input type="text" class="form-control"
                                                       id="invoice_person_id"
                                                       name="invoice_person_id">
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row justify-content-start mb-2">
                                            <div class="me-1 flex-fill">
                                                <label for="invoice_country" class="form-label">Country</label>
                                                <input type="text" class="form-control"
                                                       id="invoice_country"
                                                       name="invoice_country">
                                            </div>
                                            <div class="me-1 flex-fill">
                                                <label for="invoice_city" class="form-label">City</label>
                                                <input type="text" class="form-control"
                                                       id="invoice_city"
                                                       name="invoice_city">
                                            </div>
                                            <div class="me-1">
                                                <label for="invoice_address_zip_code" class="form-label">
                                                    Zip code
                                                </label>
                                                <input type="text" class="form-control"
                                                       id="invoice_address_zip_code"
                                                       name="invoice_address_zip_code">
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row justify-content-start">
                                            <div class="me-1 flex-fill">
                                                <label for="invoice_address" class="form-label">Address</label>
                                                <input type="text" class="form-control"
                                                       id="invoice_address"
                                                       name="invoice_address">
                                            </div>
                                            <div class="me-1">
                                                <label for="invoice_address_number" class="form-label">
                                                    Address number
                                                </label>
                                                <input type="text" class="form-control"
                                                       id="invoice_address_number"
                                                       name="invoice_address_number">
                                            </div>
                                            <div class="me-1 flex-fill">
                                                <label for="invoice_address_addition" class="form-label">
                                                    Address addition
                                                </label>
                                                <input type="text" class="form-control"
                                                       id="invoice_address_addition"
                                                       name="invoice_address_addition">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-end mb-3">
                                        <div>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-credit-card-2-back-fill"></i>
                                                </span>
                                                <input type="text" class="form-control"
                                                       placeholder="Card number"
                                                       aria-label="Card number"
                                                       id="card_number" name="card_number" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-dark">
                                            <i class="bi bi-bag-fill"></i>
                                            Buy
                                        </button>
                                    </div>
                                </form>
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
        function toggle(className, obj) {
            $(className).toggle(!!obj.checked)
        }

        $(".invoice_form").hide();

    </script>
@endsection
