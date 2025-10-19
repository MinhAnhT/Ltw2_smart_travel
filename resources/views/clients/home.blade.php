{{-- =================================================================== --}}
{{--         PHIÊN BẢN TRANG CHỦ VỚI BỐ CỤC TIÊU ĐỀ MỚI              --}}
{{-- =================================================================== --}}

@include('clients.blocks.header_home')
@include('clients.blocks.banner_home')

<div class="form-back-drop"></div>

{{-- ===== KHỐI 2: CÁC TOUR DU LỊCH NỔI BẬT ===== --}}
<section class="tours-area bgc-lighter py-100 rel z-1">
    <div class="container">
        {{-- BẮT ĐẦU KHỐI TIÊU ĐỀ ĐỒNG NHẤT --}}
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <div class="section-title text-center mb-60" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <h2>Các Tour Du Lịch Nổi Bật</h2>
                    <p>Những hành trình được yêu thích và lựa chọn nhiều nhất đang chờ bạn khám phá</p>
                </div>
            </div>
        </div>
        {{-- KẾT THÚC KHỐI TIÊU ĐỀ ĐỒNG NHẤT --}}

        {{-- Lưới hiển thị các tour --}}
        <div class="row g-4 justify-content-center">
            @foreach ($tours as $tour)
                <div class="col-xxl-3 col-xl-4 col-md-6">
                    <div class="destination-item block_tours" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50" style="transition: transform 0.3s ease, box-shadow 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        <div class="image">
                            <div class="ratting"><i class="fas fa-star"></i> {{ number_format($tour->rating, 1) }}</div>
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            
                            @if ($tour->images->isNotEmpty())
                                <img src="{{ asset('admin/assets/images/gallery-tours/' . $tour->images->first()) }}" alt="{{ $tour->title }}">
                            @else
                                <img src="{{ asset('admin/assets/images/default-tour-image.jpg') }}" alt="Ảnh đang cập nhật">
                            @endif
                        </div>
                        <div class="content">
                            <span class="location"><i class="fal fa-map-marker-alt"></i>{{ $tour->destination }}</span>
                            <h5><a href="{{ route('tour-detail', ['id' => $tour->tourId]) }}">{{ $tour->title }}</a></h5>
                            <span class="time">{{ $tour->time }}</span>
                        </div>
                        <div class="destination-footer">
                            <span class="price"><span>{{ number_format($tour->priceAdult, 0, ',', '.') }}</span> VND / người</span>
                            <a href="{{ route('tour-detail', ['id' => $tour->tourId]) }}" class="read-more">Đặt ngay <i class="fal fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== KHỐI 3: CÁC ĐIỂM ĐẾN NỔI BẬT (CTA) ===== --}}
<section class="cta-area bgc-white pt-100 pb-70">
    <div class="container">
        {{-- BẮT ĐẦU KHỐI TIÊU ĐỀ ĐỒNG NHẤT --}}
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <div class="section-title text-center mb-60" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <h2>Các Điểm Đến Nổi Bật</h2>
                    <p>Những điểm đến được yêu thích và lựa chọn nhiều nhất đang chờ bạn khám phá</p>
                </div>
            </div>
        </div>
        {{-- KẾT THÚC KHỐI TIÊU ĐỀ ĐỒNG NHẤT --}}

        <div class="row g-4">
            {{-- Khối CTA 1 --}}
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-duration="1500" data-aos-offset="50">
                <div class="cta-item" style="background-image: url({{ asset('clients/assets/images/cta/cta1.jpg') }});">
                    <span class="category">Điểm đến</span>
                    <h2>Chuyến đi khó quên ở Việt Nam</h2>
                    <a href="{{ route('tours') }}" class="theme-btn style-two">
                        <span data-hover="Khám phá">Khám phá</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            {{-- Khối CTA 2 & 3 tương tự --}}
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                <div class="cta-item" style="background-image: url({{ asset('clients/assets/images/cta/cta2.jpg') }});">
                    <span class="category">Bãi biển</span>
                    <h2>Bãi trong xanh dạt dào</h2>
                    <a href="{{ route('tours') }}" class="theme-btn style-two"><span data-hover="Khám phá">Khám phá</span><i class="fal fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                <div class="cta-item" style="background-image: url({{ asset('clients/assets/images/cta/cta3.jpg') }});">
                    <span class="category">Thác nước</span>
                    <h2>Thác nước lớn nhất Việt Nam</h2>
                    <a href="{{ route('tours') }}" class="theme-btn style-two bgc-secondary"><span data-hover="Khám phá">Khám phá</span><i class="fal fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('clients.blocks.new_letter')
@include('clients.blocks.footer_home')

{{-- Script thông báo --}}
@if(isset($tours) && count($tours) == 0)
    <script>showToast("Không có tour nào được tìm thấy!");</script>
@endif