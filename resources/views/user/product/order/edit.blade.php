@php
use App\Constants\Constant;
use App\Http\Helpers\Uploader;
@endphp

@extends('user.layout')

@section('styles')
<style>
    @media only screen and (max-width: 1500px) {
        .card-title {
            font-size: 15px;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h4 class="page-title">{{__('Order Edit')}}</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="{{route('user.dashboard')}}">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="{{url()->previous()}}">{{__('Order Management')}}</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="{{url()->previous()}}">{{__('Orders')}}</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">{{__('Edit')}}</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title d-flex justify-content-between">
                    <span>{{__('Order')}} [ {{ $order->order_number}} ]</span>
                    @if (!empty($order->token_no))
                    <span>Token No. {{$order->token_no}}</span>
                    @endif
                </div>
            </div>
            <form id="productOrder" class="" action="{{ route('user.product.orders.update') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">

                <div class="card-body pt-5 pb-5 m-3">
                    <div class="payment-information">

                        @if (!empty($order->type))
                        <div class="row mb-2">
                            <label for="order_type"><strong>{{ __('Ordered From') }}</strong></label>
                            <select name="order_type" class="form-control" id="order_type">
                                <option disabled>{{ __('Select Order Source') }}</option>
                                <option value="website" {{ strtolower($order->type) == 'website' ? 'selected' : '' }}>
                                    {{ __('Website Menu') }}
                                </option>
                                <option value="qr" {{ strtolower($order->type) == 'qr' ? 'selected' : '' }}>
                                    {{ __('QR Menu') }}
                                </option>
                                <option value="pos" {{ strtolower($order->type) == 'pos' ? 'selected' : '' }}>
                                    {{ __('POS') }}
                                </option>
                            </select>
                        </div>
                        @endif

                        @if (!empty($order->serving_method))
                        <div class="row mb-2">
                            <label for="serving_method"><strong>{{ __('Serving Method') }}:</strong></label>
                            <select name="serving_method" class="form-control" id="serving_method">
                                <option disabled>{{ __('Select Serving Method') }}</option>
                                <option value="on_table" {{ strtolower($order->serving_method) == 'on_table' ? 'selected' : '' }}>
                                    {{ __('On Table') }}
                                </option>
                                <option value="home_delivery" {{ strtolower($order->serving_method) == 'home_delivery' ? 'selected' : '' }}>
                                    {{ __('Home Delivery') }}
                                </option>
                                <option value="pick_up" {{ strtolower($order->serving_method) == 'pick_up' ? 'selected' : '' }}>
                                    {{ __('Pick Up') }}
                                </option>
                            </select>
                        </div>
                        @endif

                        <div class="row mb-2">
                            <label><strong>{{__('Postal Code')}} (Delivery Area) </strong></label>
                            <input type="text" class="form-control"
                                name="postal_code"
                                placeholder="Enter Postal Code"
                                value="{{ $order->postal_code ?? '-' }}">
                        </div>

                        <div class="row mb-2">
                            <label><strong>
                                    {{ __('Cart Total') }}
                                    (
                                    {{ $order->currency_symbol_position == 'left' ? $order->currency_symbol : '' }}
                                    {{ $order->currency_symbol_position == 'right' ? $order->currency_symbol : '' }}
                                    )
                                </strong></label>
                            <input type="text" class="form-control"
                                name="total"
                                placeholder="Enter Currency"
                                value="{{ $order->coupon - $order->tax - $order->shipping_charge + $order->total }}">
                        </div>

                        <div class="row mb-2">
                            <label><strong>{{ __('Discount') }}
                                    (
                                    {{ $order->currency_symbol_position == 'left' ? $order->currency_symbol : '' }}
                                    {{ $order->currency_symbol_position == 'right' ? $order->currency_symbol : '' }}
                                    )
                                </strong></label>
                            <input type="text" class="form-control"
                                name="discount"
                                placeholder="Enter Discount"
                                value="{{ $order->coupon }}">
                        </div>

                        <div class="row mb-2">
                            <label><strong>{{ __('Tax') }}
                                    (
                                    {{ $order->currency_symbol_position == 'left' ? $order->currency_symbol : '' }}
                                    {{ $order->currency_symbol_position == 'right' ? $order->currency_symbol : '' }}
                                    )
                                </strong></label>
                            <input type="text" class="form-control"
                                name="tax"
                                placeholder="Enter Tax"
                                value="{{ $order->tax }}">
                        </div>

                        <div class="row mb-2">
                            <label><strong>{{ __('Shipping Charge') }}
                                    (
                                    {{ $order->currency_symbol_position == 'left' ? $order->currency_symbol : '' }}
                                    {{ $order->currency_symbol_position == 'right' ? $order->currency_symbol : '' }}
                                    )
                                </strong></label>
                            <input type="text" class="form-control"
                                name="shipping_charge"
                                placeholder="Enter Shipping Charge"
                                value="{{ !empty($order->shipping_charge) ? $order->shipping_charge : 0 }}">

                        </div>

                        <div class="row mb-2">
                            <label><strong>{{ __('Total') }}
                                    (
                                    {{ $order->currency_symbol_position == 'left' ? $order->currency_symbol : '' }}
                                    {{ $order->currency_symbol_position == 'right' ? $order->currency_symbol : '' }}
                                    )
                                </strong></label>
                            <input type="text" class="form-control"
                                name="total"
                                placeholder="Enter Total"
                                value="{{ $order->total }}">
                        </div>

                        <div class="row mb-2">
                            <label><strong>{{ __('Payment Gateway') }}</strong></label>
                            <input type="text" class="form-control"
                                name="payment_method"
                                placeholder="Enter Payment Gateway"
                                value="{{ convertUtf8($order->method) }}">
                        </div>

                        @if (!empty($order->receipt))
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong>{{__('Receipt')}} :</strong>
                            </div>
                            <div class="col-lg-6 text-capitalize">
                                <a href="#" data-toggle="modal" data-target="#receiptModal">Show</a>
                            </div>
                        </div>
                        @endif

                        <div class="row mb-2">
                            <label><strong>{{ __('Payment Status') }}:</strong></label>
                            <input type="text" class="form-control"
                                name="payment_status"
                                placeholder="Enter Payment Status"
                                value="{{ convertUtf8($order->payment_status) }}"
                                readonly>
                        </div>

                        <div class="row mb-2">
                            <label><strong>{{ __('Order Status') }}:</strong></label>
                            <input type="text" class="form-control"
                                name="order_status"
                                placeholder="Enter Order Status"
                                value="{{ convertUtf8(str_replace('_', ' ', $order->order_status)) }}"
                                readonly>
                        </div>

                        <div class="row mb-2">
                            <label><strong>{{ __('Complete') }}:</strong></label>
                            <input type="text" class="form-control"
                                name="complete"
                                placeholder="Enter Completion Status"
                                value="{{ strtolower($order->completed) == 'yes' ? __('Yes') : __('No') }}"
                                readonly>
                        </div>

                        @if ($order->serving_method == 'home_delivery')
                        <div class="row mb-2">
                            <label><strong>{{ __('Preferred Delivery Date') }}:</strong></label>
                            <input type="text" class="form-control"
                                name="preferred_delivery_date"
                                value="{{ $order->delivery_date ? $order->delivery_date : '-' }}"
                                readonly>
                        </div>


                        <div class="row mb-2">
                            <label><strong>{{ __('Preferred Delivery Time Frame') }}:</strong></label>
                            <input type="text" class="form-control"
                                name="preferred_delivery_time_frame"
                                value="{{ $order->delivery_time_start }} - {{ $order->delivery_time_end }}"
                                readonly>
                        </div>
                        @endif


                        <div class="row mb-2">
                            <label><strong>{{ __('Time') }}:</strong></label>
                            <input type="text" class="form-control"
                                name="order_time"
                                value="{{ $order->created_at }}"
                                readonly>
                        </div>


                        <div class="row mb-0">
                            <label><strong>{{ __('Order Notes') }}:</strong></label>
                            <input type="text" class="form-control"
                                name="order_notes"
                                value="{{ !empty($order->order_notes) ? __('Notes available') : '-' }}">
                            @if (!empty($order->order_notes))
                            <button class="btn btn-info btn-sm mt-2" data-toggle="modal" data-target="#modalNotes">
                                Show
                            </button>
                            @endif
                        </div>
                    </div>


                    <div class="modal fade" id="modalNotes" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Order Notes</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{$order->order_notes}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="form">
                        <div class="form-group from-show-notify row">
                            <div class="col-12 text-center">
                                <button type="submit" form="productOrder" class="btn btn-success">
                                    {{ __('Update') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if ($order->serving_method == 'home_delivery' && $order->type != 'pos')
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title d-inline-block">Shipping Details</div>

            </div>
            <form id="shippingDetails" class="" action="{{ route('user.product.orders.update.shipping.details') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <div class="card-body pt-5 pb-5 m-3">
                    <div class="payment-information">
                        @if (!empty($order->shipping_fname))
                        <div class="row mb-2">
                            <label for="shipping_fname"><strong>{{ __('Name') }}:</strong></label>
                            <input type="text" class="form-control" id="shipping_fname" name="shipping_fname"
                                value="{{ convertUtf8($order->shipping_fname) }}" placeholder="Enter Name">
                        </div>
                        @endif

                        @if (!empty($order->shipping_email))
                        <div class="row mb-2">
                            <label for="shipping_email"><strong>{{ __('Email') }}:</strong></label>
                            <input type="email" class="form-control" id="shipping_email" name="shipping_email"
                                value="{{ convertUtf8($order->shipping_email) }}" placeholder="Enter Email">
                        </div>
                        @endif
                        @if (!empty($order->shipping_number))
                        <div class="row mb-2">
                            <label for="shipping_number"><strong>{{ __('Phone Number') }}:</strong></label>
                            <input type="text" class="form-control" id="shipping_number" name="shipping_number"
                                value="{{ $order->billing_country_code }}{{ $order->shipping_number }}" placeholder="Enter Phone Number">
                        </div>
                        @endif
                        @if (!empty($order->shipping_city))
                        <div class="row mb-2">
                            <label for="shipping_city"><strong>{{ __('City') }}:</strong></label>
                            <input type="text" class="form-control" id="shipping_city" name="shipping_city"
                                value="{{ convertUtf8($order->shipping_city) }}" placeholder="Enter City">
                        </div>
                        @endif
                        @if (!empty($order->shipping_address))
                        <div class="row mb-2">
                            <label for="shipping_address"><strong>{{ __('Address') }}:</strong></label>
                            <input type="text" class="form-control" id="shipping_address" name="shipping_address"
                                value="{{ convertUtf8($order->shipping_address) }}" placeholder="Enter Address">
                        </div>
                        @endif
                        @if (!empty($order->shipping_country))
                        <div class="row mb-2">
                            <label for="shipping_country"><strong>{{ __('Country') }}:</strong></label>
                            <input type="text" class="form-control" id="shipping_country" name="shipping_country"
                                value="{{ convertUtf8($order->shipping_country) }}" placeholder="Enter Country">
                        </div>
                        @endif

                    </div>
                </div>
                <div class="card-footer">
                    <div class="form">
                        <div class="form-group from-show-notify row">
                            <div class="col-12 text-center">
                                <button type="submit" form="shippingDetails" class="btn btn-success">
                                    {{ __('Update') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    @endif

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title d-inline-block">
                    @if ($order->serving_method == 'home_delivery')
                    Billing Details
                    @else
                    Information
                    @endif
                </div>
            </div>
            <form id="billingDetails" class="" action="{{ route('user.product.orders.update.billing.details') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <div class="card-body pt-5 pb-5 m-3">
                    <div class="payment-information">
                        @if (!empty($order->billing_fname))
                        <div class="row mb-2">
                            <label for="billing_name"><strong>{{ __('Name') }}:</strong></label>
                            <input type="text" class="form-control" id="billing_name" name="billing_fname"
                                value="{{ convertUtf8($order->billing_fname) }}" placeholder="Enter Name">
                        </div>
                        @endif
                        @if (!empty($order->billing_email))
                        <div class="row mb-2">
                            <label for="billing_email"><strong>{{ __('Email') }}:</strong></label>
                            <input type="email" class="form-control" id="billing_email" name="billing_email"
                                value="{{ convertUtf8($order->billing_email) }}" placeholder="Enter Email">
                        </div>
                        @endif
                        <!-- @if (!empty($order->billing_number)) -->
                        <!-- <div class="row mb-2">
                            <label for="billing_phone"><strong>{{ __('Phone') }}:</strong></label>
                            <input type="text" class="form-control" id="billing_phone" name="billing_phone"
                                value="{{ $order->billing_country_code }}{{ $order->billing_number }}"
                                placeholder="Enter Phone Number">
                        </div> -->
                        <div class="row mb-2">
                            <label for="billing_phone"><strong>{{ __('Note') }}:</strong></label>
                            <textarea type="text" class="form-control" id="billing_phone" name="billing_phone"
                                value="{{ $order->billing_number }}"
                                placeholder="Enter Notes...">{{ $order->billing_number }}</textarea>
                        </div>
                        <!-- @endif -->
                        @if (!empty($order->billing_city))
                        <div class="row mb-2">
                            <label for="billing_city"><strong>{{ __('City') }}:</strong></label>
                            <input type="text" class="form-control" id="billing_city" name="billing_city"
                                value="{{ convertUtf8($order->billing_city) }}"
                                placeholder="Enter City">
                        </div>
                        @endif
                        @if (!empty($order->billing_address))
                        <div class="row mb-2">
                            <label for="billing_address"><strong>{{ __('Address') }}:</strong></label>
                            <input type="text" class="form-control" id="billing_address" name="billing_address"
                                value="{{ convertUtf8($order->billing_address) }}"
                                placeholder="Enter Address">
                        </div>
                        @endif
                        @if (!empty($order->billing_country))
                        <div class="row mb-2">
                            <label for="billing_country"><strong>{{ __('Country') }}:</strong></label>
                            <input type="text" class="form-control" id="billing_country" name="billing_country"
                                value="{{ convertUtf8($order->billing_country) }}"
                                placeholder="Enter Country">
                        </div>
                        @endif

                        @if ($order->serving_method == 'on_table')
                        @if (!empty($order->table_number))
                        <div class="row mb-2">
                            <label for="table_number"><strong>{{ __('Table Number') }}:</strong></label>
                            <input type="text" class="form-control" id="table_number" name="table_number"
                                value="{{ convertUtf8($order->table_number) }}"
                                placeholder="Enter Table Number">
                        </div>
                        @endif

                        <div class="row mb-2">
                            <label for="waiter_name"><strong>{{ __('Waiter Name') }}:</strong></label>
                            <input type="text" class="form-control" id="waiter_name" name="waiter_name"
                                value="{{ !empty($order->waiter_name) ? convertUtf8($order->waiter_name) : '' }}"
                                placeholder="{{ __('Enter Waiter Name') }}">
                        </div>
                    </div>
                    @endif

                    @if ($order->serving_method == 'pick_up')
                    @if (!empty($order->pick_up_date))
                    <div class="row mb-2">
                        <label for="pick_up_date"><strong>{{ __('Pick up Date') }}:</strong></label>
                        <input type="date" class="form-control" id="pick_up_date" name="pick_up_date"
                            value="{{ !empty($order->pick_up_date) ? date('Y-m-d', strtotime($order->pick_up_date)) : '' }}"
                            placeholder="{{ __('Select Pick Up Date') }}">
                    </div>
                    @endif
                    @if (!empty($order->pick_up_time))
                    <div class="row mb-2">
                        <label for="pick_up_time"><strong>{{ __('Pick up Time') }}:</strong></label>
                        <input type="time" class="form-control" id="pick_up_time" name="pick_up_time"
                            value="{{ !empty($order->pick_up_time) ? $order->pick_up_time : '' }}"
                            placeholder="{{ __('Select Pick Up Time') }}">
                    </div>
                    @endif
                    @endif

                </div>
                <div class="card-footer">
                    <div class="form">
                        <div class="form-group from-show-notify row">
                            <div class="col-12 text-center">
                                <button type="submit" form="billingDetails" class="btn btn-success">
                                    {{ __('Update') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

 
<div class="col-lg-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">{{__('Ordered Products')}}</h4>
            <div class="">
                <a href="{{route('user.pos.edit', $order->id)}}" type="submit" class="btn btn-success">
                    {{ __('Add Items') }}</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive product-list">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Product')}}</th>
                            <th>{{__('Product Title')}}</th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Total')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $key => $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><img
                                    src="{{Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_FEATURED_IMAGE,$item->product->feature_image,$userBs)}}"
                                    alt="product" width="100">
                            </td>
                            <td>
                                <strong class="mr-3">{{$item->productInfromation->title}}</strong>
                                <br>
                                @php
                                $variations = json_decode($item->variations, true);
                                @endphp
                                @if (!empty($variations))
                                <strong class="mr-3">{{__("Variation")}}:</strong>
                                @foreach ($variations as $vKey => $variation)
                                <span
                                    class="text-capitalize">{{str_replace("_"," ",$vKey)}}:</span> {{$variation["name"]}}
                                @if (!$loop->last)
                                ,
                                @endif
                                @endforeach
                                <br>
                                @endif
                                @php
                                $addons = json_decode($item->addons, true);
                                @endphp
                                @if (!empty($addons))
                                <strong class="mr-3">Addons:</strong>
                                @foreach ($addons as $addon)
                                {{$addon["name"]}}
                                @if (!$loop->last)
                                ,
                                @endif
                                @endforeach
                                @endif
                            </td>
                            <td>
                                <strong class="mr-2">{{__("Product")}}:</strong>
                                {{$order->currency_code_position == 'left' ? $order->currency_code : ''}}
                                <span>{{(float)$item->product_price}}</span>
                                {{$order->currency_code_position == 'right' ? $order->currency_code : ''}}
                                <br>
                                @if (is_array($variations))
                                <strong class="mr-2">{{__("Variation")}}: </strong>
                                {{$order->currency_code_position == 'left' ? $order->currency_code : ''}}
                                <span>{{(float)$item->variations_price}}</span>
                                {{$order->currency_code_position == 'right' ? $order->currency_code : ''}}
                                <br>
                                @endif
                                @if (is_array($addons))
                                <strong class="mr-2">{{__("Addons")}}: </strong>
                                {{$order->currency_code_position == 'left' ? $order->currency_code : ''}}
                                <span>{{(float)$item->addons_price}}</span>
                                {{$order->currency_code_position == 'right' ? $order->currency_code : ''}}
                                @endif
                            </td>
                            <td>{{$item->qty}}</td>
                            <td>
                                <span>{{$order->currency_code_position == 'left' ? $order->currency_code : ''}}</span> {{$item->total}}
                                <span>{{$order->currency_code_position == 'right' ? $order->currency_code : ''}}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Receipt Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_RECEIPT,$order->receipt,$userBs)}}" alt="Receipt" width="200">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection