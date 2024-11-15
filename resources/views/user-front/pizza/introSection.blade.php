  @php
      use App\Constants\Constant;
      use App\Http\Helpers\Uploader;
      use Illuminate\Support\Facades\Auth;

  @endphp
  <!-- About-area start -->
  <section class="about-area about-2 pt-100 pb-60 bg-img"
      data-bg-image="{{ Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBe->intro_bg_image, $userBs) }}">
      <!-- Spacer -->
      <div class="spacer pt-120"></div>

      <div class="container">
          <div class="row align-items-center gx-xl-5">
              <div class="col-lg-6" data-aos="fade-up">
                  <div class="content-title mb-40 ps-xl-2">
                      {{-- <h2 class="title mb-20 color-white">
                            Affordable Pizza Delivery from Your <span>Trusted</span> Store
                        </h2> --}}
                      <h2 class="title mb-20 color-white">

                          {{ convertUtf8($userBs->intro_title) }}

                      </h2>
                      <div class="content-text">
                          <p>
                              {{ convertUtf8($userBs->intro_text) }}

                          </p>
                      </div>
                      @if ($userBs->intro_section_highlight_text)
                          <blockquote class="blockquote mt-30 bg-dark">
                              {{ convertUtf8($userBs->intro_section_highlight_text) }}
                          </blockquote>
                      @endif

                      @if ($intro_feature_items->count() > 0)
                          <div class="info-list mt-40">
                              <div class="row">
                                  @foreach ($intro_feature_items as $item)
                                      <div class="col-md-6 item mb-30">
                                          <div class="card">
                                              @if ($item->icon)
                                                  <div class="card-icon rounded-pill bg-white">
                                                      <i class="{{ $item->icon }}"></i>
                                                  </div>
                                              @endif
                                              <div class="card-content">
                                                  <h6 class="card-title mb-2 color-white">
                                                      {{ $item->title }}
                                                  </h6>
                                                  <p class="card-text color-white">
                                                      {{ $item->text }}
                                                  </p>
                                              </div>
                                          </div>
                                      </div>
                                  @endforeach
                              </div>
                          </div>
                      @endif
                      <div class="btn-groups gap-25 mt-10" data-aos="fade-up">
                          @if ($userBs->intro_section_button_url)
                              <a href="{{ $userBs->intro_section_button_url }}" target="_self"
                                  class="btn btn-lg btn-primary rounded-pill"
                                  title="{{ convertUtf8($userBs->intro_section_button_text) }}"
                                  style="background-color:#{{ $userBs->base_color }} !important; border: 2px solid #{{ $userBs->base_color }} !important ;">{{ convertUtf8($userBs->intro_section_button_text) }}</a>
                          @endif



                          @if ($userBs->intro_video_link)
                              <a href="{{ $userBs->intro_video_link }}"
                                  class="video-btn video-btn-text video-btn-sm youtube-popup" target="_self"
                                  title="Show Video">
                                  <i class="fas fa-play"></i>
                                  <span>{{ convertUtf8($userBs->intro_section_video_button_text) }}</span>
                              </a>
                          @endif

                      </div>
                  </div>
              </div>
              @if ($userBs->intro_main_image)
                  <div class="col-lg-6" data-aos="fade-up">
                      <div class="image mb-40">
                          <img class="lazyload blur-up"
                              data-src="{{ Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBs->intro_main_image, $userBs) }}"
                              alt="Image">
                      </div>
                  </div>
              @endif
          </div>
      </div>

      <!-- Spacer -->
      <div class="spacer pb-120"></div>
      <!-- Bg shape -->
      @if ($userBs->intro_section_top_shape_image)
          <div class="bg-shape">
              <img class="lazyload"
                  data-src="{{ Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBs->intro_section_top_shape_image, $userBs) }}"
                  alt="Bg Shape">
          </div>
      @endif
      @if ($userBs->intro_section_bottom_shape_image)
          <div class="bg-shape h-auto">
              <img class="lazyload"
                  data-src="{{ Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBs->intro_section_bottom_shape_image, $userBs) }}"
                  alt="Bg Shape">
          </div>
      @endif
  </section>
  <!-- About-area end -->
