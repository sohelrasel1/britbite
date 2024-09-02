@php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
@endphp
@foreach ($apopups as $popup)
    @php
        $type = $popup->type;
    @endphp
    @if ($type == 1)
        <div data-popup_delay="{{$popup->delay}}" data-popup_id="{{$popup->id}}" id="modal-popup{{$popup->id}}"
             class="popup-wrapper">
            <div>
                <img class="lazy"
                     data-src="{{Uploader::getImageUrl(Constant::WEBSITE_ANNOUNCEMENT_POPUP_IMAGE,$popup->image,$userBs)}}"
                     alt="Popup Image" width="100%">
            </div>
        </div>
    @elseif ($type == 2)
        <div data-popup_delay="{{$popup->delay}}" data-popup_id="{{$popup->id}}" id="modal-popup{{$popup->id}}"
             class="popup-wrapper">
           
            <div class="popup-one bg_cover lazy"
                 data-bg="{{asset(Uploader::getImageUrl(Constant::WEBSITE_ANNOUNCEMENT_POPUP_IMAGE,$popup->image,$userBs))}}">
                <div class="popup_main-content">
                    <h1>{{$popup->title}}</h1>
                    <p>{{$popup->text}}</p>

                    @if (!empty($popup->button_url) && !empty($popup->button_text))
                        <a href="{{$popup->button_url}}" class="popup-main-btn"
                           style="background-color: #{{$popup->button_color}};">{{$popup->button_text}}</a>
                    @endif
                </div>
            </div>
        </div>
    @elseif ($type == 3)
        <div data-popup_delay="{{$popup->delay}}" data-popup_id="{{$popup->id}}" id="modal-popup{{$popup->id}}"
             class="popup-wrapper">
            <div class="popup-two bg_cover lazy"
                 data-bg="{{asset(Uploader::getImageUrl(Constant::WEBSITE_ANNOUNCEMENT_POPUP_IMAGE,$popup->image,$userBs))}}">
                <div class="popup_main-content">
                    <h1>{{$popup->title}}</h1>
                    <p>{{$popup->text}}</p>
                    <div class="subscribe-form">
                        <form id="popupSubscribe{{$popup->id}}" class="subscribeForm"
                              action="{{route('user.front.subscribe',getParam())}}" method="POST">
                            @csrf
                            <div class="form_group">
                                <input type="email" class="form_control" placeholder="{{$keywords['Enter Email Address'] ?? __('Enter Email Address')}}"
                                       name="email" required>
                                <p id="erremail" class="text-white mb-3 err-email"></p>
                            </div>
                            <div class="form_group">
                                <button type="submit" class="popup-main-btn"
                                        style="background-color: #{{$popup->button_color}};">
                                    {{$popup->button_text}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($type == 4)
        <div data-popup_delay="{{$popup->delay}}" data-popup_id="{{$popup->id}}" id="modal-popup{{$popup->id}}"
             class="popup-wrapper">
            <div class="popup-three">
                <div class="popup_main-content">
                    <div class="left-bg bg_cover lazy"
                         data-bg="{{Uploader::getImageUrl(Constant::WEBSITE_ANNOUNCEMENT_POPUP_IMAGE,$popup->image,$userBs)}}">
                    </div>
                    <div class="right-content">
                        <h1>{{$popup->title}}</h1>
                        <p>{{$popup->text}}</p>
                        @if (!empty($popup->button_url) && !empty($popup->button_text))
                            <a href="{{$popup->button_url}}" class="popup-main-btn"
                               style="background-color: #{{$popup->button_color}};">
                                {{$popup->button_text}}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @elseif ($type == 5)
        <div data-popup_delay="{{$popup->delay}}" data-popup_id="{{$popup->id}}" id="modal-popup{{$popup->id}}"
             class="popup-wrapper">
            <div class="popup-four">
                <div class="popup_main-content">
                    <div class="left-bg bg_cover lazy"
                         data-bg="{{Uploader::getImageUrl(Constant::WEBSITE_ANNOUNCEMENT_POPUP_IMAGE,$popup->image,$userBs)}}"></div>
                    <div class="right-content">
                        <h1>{{$popup->title}}</h1>
                        <p>{{$popup->text}}</p>
                        <div class="subscribe-form">
                            <form id="popupSubscribe{{$popup->id}}" class="subscribeForm"
                                  action="{{route('user.front.subscribe',getParam())}}" method="POST">
                                @csrf
                                <div class="form_group">
                                    <input type="email" class="form_control" placeholder="{{$keywords['Enter Email Address'] ?? __('Enter Email Address')}}"
                                           name="email" required>
                                    <p id="erremail" class="text-danger mb-3 err-email"></p>
                                </div>
                                <div class="form_group">
                                    <button type="submit" class="popup-main-btn"
                                            style="background-color: #{{$popup->button_color}};">{{$popup->button_text}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($type == 6)
        <div data-popup_delay="{{$popup->delay}}" data-popup_id="{{$popup->id}}" id="modal-popup{{$popup->id}}"
             class="popup-wrapper">
            <div class="popup-five bg_cover lazy"
                 data-bg="{{asset(Uploader::getImageUrl(Constant::WEBSITE_ANNOUNCEMENT_POPUP_IMAGE,$popup->image,$userBs))}}">
                <div class="popup_main-content">
                    <h1>{{$popup->title}}</h1>
                    <h4>{{$popup->text}}</h4>
                    <div class="offer-timer" data-end_date="{!! $popup->end_date !!}"
                         data-end_time="{!! $popup->end_time !!}"></div>
                    @if (!empty($popup->button_url) && !empty($popup->button_text))
                        <a href="{{$popup->button_url}}" class="popup-main-btn"
                           style="background-color: #{{$popup->button_color}};">{{$popup->button_text}}</a>
                    @endif
                </div>
            </div>
        </div>
    @elseif ($type == 7)
        <div data-popup_delay="{{$popup->delay}}" data-popup_id="{{$popup->id}}" id="modal-popup{{$popup->id}}"
             class="popup-wrapper">
            <div class="popup-six">
                <div class="popup_main-content">
                    <div class="left-bg bg_cover lazy"
                         data-bg="{{Uploader::getImageUrl(Constant::WEBSITE_ANNOUNCEMENT_POPUP_IMAGE,$popup->image,$userBs)}}"></div>
                    <div class="right-content bg_cover"
                         style="background-color: #{{$popup->background_color}}; background-image: url({{asset('assets/front/img/popup-7-bg.png')}});">
                        <h1>{{$popup->title}}</h1>
                        <h4>{{$popup->text}}</h4>
                        <div class="offer-timer" data-end_date="{!! $popup->end_date !!}"
                             data-end_time="{!! $popup->end_time !!}"></div>
                        @if (!empty($popup->button_url) && !empty($popup->button_text))
                            <a href="{{$popup->button_url}}" class="popup-main-btn"
                               style="background-color: #{{$popup->button_color}};">{{$popup->button_text}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
