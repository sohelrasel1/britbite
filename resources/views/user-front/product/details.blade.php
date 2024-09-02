@php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
    use App\Models\User\OrderItem;
    use App\Models\User\ProductReview;
@endphp
@extends('user-front.layout')
@section('pageHeading')
    {{ $keywords['Product Details'] ?? __('Product Details') }}
@endsection
@section('meta-keywords', "$product?->meta_keywords")
@section('meta-description', "$product?->meta_description")
@section('content')

    <section class="page-title-area d-flex align-items-center"
        style="background-image: url('{{ $userBs->breadcrumb ? Uploader::getImageUrl(Constant::WEBSITE_BREADCRUMB, $userBs->breadcrumb, $userBs) : asset('assets/restaurant/images/breadcrum.jpg') }}');background-size:cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-item text-center">
                        <h2 class="title">{{ $upageHeading?->items_details_page_title }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('user.front.index', getParam()) }}"><i
                                            class="flaticon-home"></i>{{ $keywords['Home'] ?? __('Home') }}</a></li>
                                @if ($upageHeading?->items_details_page_title)
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $upageHeading?->items_details_page_title }}
                                    </li>
                                @endif
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shop-details-area pt-95 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                    <div class="shop-item mr-70">
                        <div class="shop-thumb">
                            @foreach ($product->product_images as $image)
                                <div class="item">
                                    <img class="lazy wow fadeIn"
                                        data-src="{{ Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_SLIDER_IMAGE, $image->image, $userBs) }}"
                                        alt="shop" data-wow-delay=".5s">
                                </div>
                            @endforeach
                        </div>
                        <div class="shop-list">
                            <ul class="shop-thumb-active">
                                @foreach ($product->product_images as $img)
                                    <li>
                                        <img class="lazy wow fadeIn"
                                            data-src="{{ Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_SLIDER_IMAGE, $img->image, $userBs) }}"
                                            alt="shop" data-wow-delay=".5s">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="shop-content pt-60">
                        <div class="shop-top-content">
                            <h3 class="title">{{ convertUtf8($product->title) }}</h3>
                            @if (in_array('Online Order', $packagePermissions))
                                <ul class="d-flex justify-content-between">
                                    <li>

                                        <div class="rate">
                                            <div class="rating"
                                                style="width:{{ !empty($product->product_reviews)? ProductReview::where('user_id', $user->id)->where('product_id', $product->product_id)->avg('review') * 20: 0 }}%">
                                            </div>
                                        </div>
                                    </li>

                                    <li><span>
                                            {{ count($reviews) }}
                                            @if (count($reviews) <= 1)
                                                {{ $keywords['Review'] ?? __('Review') }}
                                            @else
                                                {{ $keywords['Reviews'] ?? __('Reviews') }}
                                            @endif
                                        </span>
                                    </li>
                                </ul>
                            @endif
                        </div>
                        <div class="shop-price pt-15">
                            <ul>
                                <li>{{ $userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : '' }}{{ convertUtf8($product->current_price) }}{{ $userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : '' }}
                                </li>
                                @if (convertUtf8($product->previous_price))
                                    <li>{{ $userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : '' }}{{ convertUtf8($product->previous_price) }}{{ $userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : '' }}
                                    </li>
                                @endif
                            </ul>
                        </div>
                        @if (empty($product->variations) && empty($product->addons) && in_array('Online Order', $packagePermissions))
                            <div class="shop-qty d-flex align-items-center pt-25">
                                <div class="product-quantity d-flex align-items-center" id="quantity">
                                    <span>{{ __('Qty') }}</span>
                                    <button type="button" id="sub" class="sub subclick">-</button>
                                    <input type="text" id="detailsQuantity" id="1" value="1" />
                                    <button type="button" id="add" class="add addclick">+</button>
                                </div>
                            </div>
                        @endif
                        <div class="shop-text">
                            <p>{{ $product->summary }}</p>
                        </div>
                        @if ($product->category)
                            <p class="mt-2">
                                <span>{{ $keywords['Category'] ?? __('Category') }} :</span>
                                <a class=""
                                    href="{{ route('user.front.items', [getParam(), 'category_id' => $product->category_id]) }}"
                                    class="cursor-pointer">{{ convertUtf8($product->category->name) }}
                                </a> <br>
                                @php
                                    $subcategory = App\Models\User\PsubCategory::where('category_id', $product->category_id)
                                        ->where('id', $product->subcategory_id)
                                        ->where('status', 1)
                                        ->first();
                                @endphp
                                @if ($subcategory)
                                    <span>{{ $keywords['Subcategory'] ?? __('Subcategory') }} :</span>
                                    <a href="{{ route('user.front.items', [getParam(), 'category_id' => $product->category->id, 'subcategory_id' => $subcategory->id]) }}"
                                        class="cursor-pointer">{{ convertUtf8($subcategory->name) }}
                                    </a>
                                @endif
                            </p>
                        @endif
                        <div class="shop-social product-social-icon social-link a2a_kit a2a_kit_size_32">
                            <span>{{ $keywords['Share'] ?? __('Share') }} :</span>
                            <ul class="social-share">
                                <li>
                                    <a class="facebook a2a_button_facebook" href="">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="twitter a2a_button_twitter" href="">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="linkedin a2a_button_linkedin" href="">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="pinterest a2a_button_pinterest" href="">
                                        <i class="fab fa-pinterest"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="a2a_dd plus" href="https://www.addtoany.com/share">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="shop-btns pt-45">
                            @if (in_array('Online Order', $packagePermissions))
                                <a data-href="{{ route('user.front.add.cart', [getParam(), $product->product_id]) }}"
                                    data-product="{{ $product }}" class="main-btn-2 main-btn cart-link ">
                                    {{ $keywords['Add to Cart'] ?? __('Add To Cart') }}
                                    <i class="fa fa-shopping-basket"></i>
                                </a>
                            @else
                                @if ($product->variations != '[]')
                                    <a class="main-btn-2 main-btn cart-link" data-product="{{ $product }}"
                                        data-href="{{ route('user.front.add.cart', [getParam(), $product->product_id]) }}">{{ $keywords['Extras'] ?? __('Extras') }}
                                    </a>
                                @endif
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="shop-menu-content pb-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="menu-contents">
                        <div class="menu-tabs">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                        role="tab" aria-controls="pills-home"
                                        aria-selected="true">{{ $keywords['Description'] ?? __('Description') }}</a>
                                </li>
                                @if (!is_null($packagePermissions) && in_array('Online Order', $packagePermissions))
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                            href="#pills-contact" role="tab" aria-controls="pills-contact"
                                            aria-selected="false">{{ $keywords['Reviews'] ?? __('Reviews') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    {!! nl2br(replaceBaseUrl(convertUtf8($product->description))) !!}
                                </div>
                                @if (!is_null($packagePermissions) && in_array('Online Order', $packagePermissions))
                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                        aria-labelledby="pills-contact-tab">
                                        <div class="shop-review-area">
                                            <div class="shop-review-title">
                                                <h3 class="title">{{ count($reviews) }}
                                                    {{ $keywords['Reviews For'] ?? __('Reviews For') }}
                                                    {{ convertUtf8($product->title) }}</h3>
                                            </div>

                                            @foreach ($reviews as $review)
                                                <div class="shop-review-user">
                                                    @if (
                                                        !is_null($review->client) &&
                                                            (strpos($review->client->photo, 'facebook') || strpos($review->client->photo, 'google')))
                                                        <img src="{{ $review->client->photo ?? asset('assets/tenant/image/user.jpg') }}"
                                                            alt="user image" width="50">
                                                    @else
                                                        <img src="{{ $review->client ? Uploader::getImageUrl(Constant::WEBSITE_CUSTOMER_IMAGE, $review->client?->photo, $userBs) : asset('assets/tenant/image/user.jpg') }}"
                                                            alt="user image" width="50">
                                                    @endif
                                                    <ul>

                                                        <div class="rate">
                                                            <div class="rating"
                                                                style="width:{{ $review->review * 20 }}%"></div>
                                                        </div>
                                                    </ul>
                                                    <span>
                                                        <span>{{ !empty(convertUtf8($review->client)) ? convertUtf8($review->client->username) : '' }}
                                                        </span>
                                                        – {{ $review->created_at->format('F j, Y') }}
                                                    </span>
                                                    <p>{{ convertUtf8($review->comment) }}</p>
                                                </div>
                                            @endforeach

                                            @if (Auth::guard('client')->user())
                                                @if (OrderItem::query()->where('customer_id', Auth::guard('client')->user()->id)->where('product_id', $product->product_id)->exists())
                                                    <div class="shop-review-form">
                                                        @error('error')
                                                            <p class="text-danger my-2">
                                                                {{ Session::get('error') }}
                                                            </p>
                                                        @enderror
                                                        <form
                                                            action="{{ route('user.product.review.submit', getParam()) }}"
                                                            method="POST">
                                                            @csrf

                                                            <input type="hidden" value="" id="reviewValue"
                                                                name="review">
                                                            <input type="hidden" value="{{ $product->product_id }}"
                                                                name="product_id">
                                                            <div class="input-box">
                                                                <span>{{ $keywords['Rating'] ?? __('Rating') }} *</span>
                                                                <div class="review-content ">
                                                                    <ul class="review-value review-1">
                                                                        <li>
                                                                            <a class="cursor-pointer" data-href="1">
                                                                                <i class="far fa-star"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                    <ul class="review-value review-2">
                                                                        <li><a class="cursor-pointer" data-href="2"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="2"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                    </ul>
                                                                    <ul class="review-value review-3">
                                                                        <li><a class="cursor-pointer" data-href="3"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="3"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="3"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                    </ul>
                                                                    <ul class="review-value review-4">
                                                                        <li><a class="cursor-pointer" data-href="4"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="4"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="4"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="4"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                    </ul>
                                                                    <ul class="review-value review-5">
                                                                        <li><a class="cursor-pointer" data-href="5"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="5"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="5"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="5"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                        <li><a class="cursor-pointer" data-href="5"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="input-box">
                                                                <span>{{ $keywords['Comment'] ?? __('Comment') }} </span>
                                                                <textarea name="comment" cols="30" rows="10" placeholder="{{ $keywords['Comment'] ?? __('Comment') }} "></textarea>
                                                            </div>
                                                            <div class="input-btn mt-3">
                                                                <button type="submit" class="main-btn">
                                                                    {{ $keywords['Submit'] ?? __('Submit') }}
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="review-login mt-5">
                                                    <a class="boxed-btn d-inline-block mr-2"
                                                        href="{{ route('user.client.login', getParam()) }}">
                                                        {{ $keywords['Login'] ?? __('Login') }}
                                                    </a>
                                                    {{ $keywords['to leave a rating'] ?? __('to leave a rating') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


  
@endsection


@section('script')
    <script src="{{ asset('assets/front/js/page.js') }}"></script>
@endsection
