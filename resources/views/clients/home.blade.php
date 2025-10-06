@include('clients.blocks.header_home')
@include('clients.blocks.banner_home')

<div class="form-back-drop"></div>

<section class="destinations-area pt-100 pb-70">
    <div class="container">
        {{-- Khối này đã được sửa ở bước trước --}}
        <div class="bgc-black rel z-1" style="padding-top: 80px; padding-bottom: 50px; border-radius: 20px;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-white text-center counter-text-wrap mb-70" data-aos="fade-up"
                        data-aos-duration="1500" data-aos-offset="50">
                        <h2>Khám phá kho báu việt nam cùng Travela</h2>
                        <p>Website<span class="count-text plus" data-speed="3000" data-stop="24080">0</span>
                            phổ biến nhất mà bạn sẽ nhớ</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @if (isset($tours) && !$tours->isEmpty())
                    @foreach ($tours as $tour)
                        <div class="col-xxl-3 col-xl-4 col-md-6" style="margin-bottom: 30px">
                            <div class="destination-item block_tours" data-aos="fade-up"
                                data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <div class="video-play">
                                        <a href="https://www.youtube.com/watch?v=1..."
                                            class="mfp-iframe video-play-btn"><i class="fas fa-play"></i></a>
                                    </div>
                                    <img src="{{ asset('admin/assets/images/gallery-tours/' . $tour->images[0]) }}"
                                        alt="Destination" class="tour-img-fix">
                                </div>
                                <div class="content">
                                    <h6><a href="tour-details.html">{{ $tour->title }}</a></h6>
                                    <span class="location"><i class="fal fa-map-marker-alt"></i>
                                        {{ $tour->destination }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
{{-- Đảm bảo khối này cũng nằm trong .container để có bố cục nhất quán --}}
<section class="cta-area bgc-lighter pb-70">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-duration="1500" data-aos-offset="50">
                <div class="cta-item"
                    style="background-image: url( {{ asset('clients/assets/images/cta/cta1.jpg') }});">
                    <span class="category">Điểm đến</span>
                    <h2>Chuyến đi khó quên ở Việt Nam</h2>
                    <a href="{{ route('tours') }}" class="theme-btn style-two">
                        <span data-hover="Khám phá">Khám phá</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="50" data-aos-duration="1500"
                data-aos-offset="50">
                <div class="cta-item"
                    style="background-image: url( {{ asset('clients/assets/images/cta/cta2.jpg') }});">
                    <span class="category">Bãi biển Sea</span>
                    <h2>Bãi trong xanh dạt dào ở Việt Nam</h2>
                    <a href="{{ route('tours') }}" class="theme-btn style-two">
                        <span data-hover="Khám phá">Khám phá</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="100" data-aos-duration="1500"
                data-aos-offset="50">
                <div class="cta-item"
                    style="background-image: url( {{ asset('clients/assets/images/cta/cta3.jpg') }});">
                    <span class="category">Thác nước</span>
                    <h2>Thác nước lớn nhất Việt Nam</h2>
                    <a href="{{ route('tours') }}" class="theme-btn style-two bgc-secondary">
                        <span data-hover="Khám phá">Khám phá</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('clients.blocks.new_letter')
@include('clients.blocks.footer_home')