@include('clients.blocks.header_home')
@include('clients.blocks.banner')


<!-- About Area start -->
<div class="main-content-area">
<section class="about-area-two py-100 rel z-1">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-3" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                <span class="subtitle mb-35">Về chúng tôi</span>
            </div>
            <div class="col-xl-9">
                <div class="about-page-content" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                    <div class="row">
                        <div class="col-lg-8 pe-lg-5 me-lg-5">
                            <div class="section-title mb-25">
                                <h2 class="benefit-title text-black mb-25">Kinh nghiệm và công ty du lịch chuyên nghiệp ở Việt Nam</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="experience-years rmb-20">
                                <span class="title bgc-secondary">Năm kinh nghiệm</span>
                                <span class="text">Chúng tôi có </span>
                                <span class="years">5+</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <p>Chúng tô<img src="" alt=""> là nền tảng du lịch thông minh, nơi mọi hành trình đều được thiết kế dành riêng cho bạn. Chúng tôi mang đến giải pháp đặt tour toàn diện, lo trọn mọi khâu từ A-Z, giúp bạn an tâm tận hưởng chuyến đi. Với hàng ngàn điểm đến đa dạng và những đánh giá chân thực, việc lựa chọn chưa bao giờ dễ dàng hơn thế.</p>
                            <ul class="list-style-two mt-35">
                                <li>Đặt Tour Toàn Diện</li>
                                <li>Điểm Đến Hấp Dẫn & Đa Dạng</li>
                                <li>Trợ Lý Ảo AI 24/7</li>
                                <li>Cá Nhân Hóa Tối Đa</li>
                            </ul>
                            <a href="{{ route('tours') }}" class="theme-btn style-three mt-30">
                                <span data-hover="Khám phá Tours">Khám phá Tours</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<!-- About Area end -->


<!-- Features Area start -->
<section class="about-features-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-4 col-md-6">
                <div class="about-feature-image" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <img src="{{ asset('clients/assets/images/about/about-feature1.jpg') }}" alt="About">
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="about-feature-image" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500"
                    data-aos-offset="50">
                    <img src="{{ asset('clients/assets/images/about/about-feature2.jpg') }}" alt="About">
                </div>
            </div>
            <div class="col-xl-4 col-md-8">
                <div class="about-feature-boxes" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="feature-item style-three bgc-secondary">
                        <div class="icon-title">
                            <div class="icon"><i class="flaticon-award-symbol"></i></div>
                            <h5><a href="#">Chúng tôi là công ty đạt giải thưởng</a></h5>
                        </div>
                        <div class="content">
                            <p>Tại Phenikaa Business Solutions cam kết về sự xuất sắc và đổi mới đã đạt được</p>
                        </div>
                    </div>
                    <div class="feature-item style-three bgc-primary">
                        <div class="icon-title">
                            <div class="icon"><i class="flaticon-tourism"></i></div>
                            <h5><a href="#">5000+ Điểm đến du lịch phổ biến</a></h5>
                        </div>
                        <div class="content">
                            <p>Đội ngũ chuyên gia của chúng tôi tận tâm phát triển các chiến lược tiên tiến thúc đẩy
                                thành công</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Features Area end -->


<!-- About Us Area start -->
<section class="about-us-area pt-70 pb-100 rel z-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-6">
                <div class="about-us-content rmb-55" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                    <div class="section-title mb-25">
                        <h2 class="benefit-title text-black mb-25">Du lịch với sự tự tin Lý do hàng đầu để chọn công ty của chúng tôi</h2>
                    </div>
                    <p>Chúng tôi hợp tác chặt chẽ với khách hàng để hiểu rõ những thách thức và mục tiêu, cung
                        cấp các giải pháp tùy chỉnh để nâng cao hiệu quả, tăng lợi nhuận và thúc đẩy tăng trưởng bền
                        vững.</p>
                    <div class="row pt-25">
                        <div class="col-6">
                            <div class="counter-item counter-text-wrap">
                                <span class="count-text k-plus" data-speed="2000" data-stop="1">0</span>
                                <span class="counter-title">Điểm đến phổ biến</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="counter-item counter-text-wrap">
                                <span class="count-text m-plus" data-speed="3000" data-stop="8">0</span>
                                <span class="counter-title">Khách hàng hài lòng</span>
                            </div>
                        </div>
                    </div>
                    <a href="destination-details.html" class="theme-btn mt-10 style-two">
                        <span data-hover="Explore Destinations">Khám phá các điểm đến</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                <div class="about-us-page">
                    <img src="{{ asset('clients/assets/images/about/about-page.jpg') }}" alt="About">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us Area end -->


<!-- Team Area start -->
<section class="about-team-area pb-70 rel z-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-center counter-text-wrap mb-50" data-aos="fade-up"
                    data-aos-duration="1500" data-aos-offset="50">
                    <h2 class="benefit-title text-black">Gặp gỡ những hướng dẫn viên du lịch giàu kinh nghiệm của chúng tôi</h2>
                    <p>Website <span class="count-text plus bgc-primary" data-speed="3000" data-stop="34500">0</span>
                        trải nghiệm phổ biến nhất mà bạn sẽ nhớ</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">

            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-item hover-content" data-aos="fade-up" data-aos-duration="1500"
                    data-aos-offset="50">
                    <img src="{{ asset('clients/assets/images/team/guide-anh.png') }}" alt="Guide">
                    <div class="content">
                        <h6>Minh Anh</h6>
                        <span class="designation">Founder</span>
                        <div class="social-style-one inner-content">
                            <a href="contact.html"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/share/16DQDeE7v7/"><i class="fab fa-facebook-f"></i></a>
                            <a href="contact.html"><i class="fab fa-instagram"></i></a>
                            <a href="contact.html"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-item hover-content" data-aos="fade-up" data-aos-duration="1500"
                    data-aos-offset="50">
                    <img src="{{ asset('clients/assets/images/team/guide-thu.png') }}" alt="Guide">
                    <div class="content">
                        <h6>Hà Thu</h6>
                        <span class="designation">Co-founder</span>
                        <div class="social-style-one inner-content">
                            <a href="contact.html"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/share/17e7mywFym/?mibextid=wwXIfr"><i class="fab fa-facebook-f"></i></a>
                            <a href="contact.html"><i class="fab fa-instagram"></i></a>
                            <a href="contact.html"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Team Area end -->


<!-- Features Area start -->
<section class="about-feature-two bgc-black pt-100 pb-45 rel z-1">
    <div class="container">
        <div class="section-title text-center text-white counter-text-wrap mb-50" data-aos="fade-up"
            data-aos-duration="1500" data-aos-offset="50">
            <h2 class="benefit-title">Hưởng lợi từ các chuyến du lịch của chúng tôi</h2>
            <p>Website <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> phổ biến nhất
                kinh nghiệm bạn sẽ nhớ</p>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1500"
                data-aos-offset="50">
                <div class="feature-item style-two">
                    <div class="icon"><i class="flaticon-save-money"></i></div>
                    <div class="content">
                        <h5><a href="{{ route('tours') }}">Tối Ưu Chi Phí Thông Minh</a></h5>
                        <p>Nền tảng của chúng tôi luôn nghiên cứu, thiết kế tour du lịch hấp dẫn với mức giá tối ưu, giúp bạn tiết kiệm chi phí mà vẫn đảm bảo một chuyến đi với chất lượng vượt trội.

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500"
                data-aos-offset="50">
                <div class="feature-item style-two">
                    <div class="icon"><i class="flaticon-travel-1"></i></div>
                    <div class="content">
                        <h5><a href="{{ route('tours') }}">Gợi Ý Dành Riêng Cho Bạn</a></h5>
                        <p>Hàng nghìn điểm đến hấp dẫn, phù hợp mọi sở thích và phong cách du lịch.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500"
                data-aos-offset="50">
                <div class="feature-item style-two">
                    <div class="icon"><i class="flaticon-booking"></i></div>
                    <div class="content">
                        <h5><a href="{{ route('tours') }}">Lên Kế Hoạch Liền Mạch</a></h5>
                        <p>Từ ý tưởng đến lúc xách ba lô lên đường chỉ trong vài phút. Quy trình đặt tour toàn diện, tự động và cực kỳ đơn giản.</p>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150" data-aos-duration="1500"
                data-aos-offset="50">
                <div class="feature-item style-two">
                    <div class="icon"><i class="flaticon-guidepost"></i></div>
                    <div class="content">
                        <h5><a href="{{ route('tours') }}">Trợ Lý AI Đồng Hành 24/7</a></h5>
                        <p>KTrợ lý trực tuyến của chúng tôi luôn sẵn sàng giải đáp mọi thắc mắc về chuyến đi ngay lập tức. Nhận được sự hỗ trợ bạn cần, bất kể ngày hay đêm, để có một hành trình an tâm.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shape">
        <img src="{{ asset('clients/assets/images/video/shape1.png') }}" alt="shape">
    </div>
</section>
<!-- Features Area end -->

<!-- Client Logo Area start -->
<div class="client-logo-area mb-100">
    <div class="container">
        <div class="client-logo-wrap pt-60 pb-55">
            <div class="text-center mb-40" data-aos="zoom-in" data-aos-duration="1500" data-aos-offset="50">
                <h6>Chúng tôi được giới thiệu bởi:</h6>
            </div>
            <div class="client-logo-active">
                <div class="client-logo-item" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                    <a href="#"><img src="{{ asset('clients/assets/images/client-logos/client-logo1.png') }}"
                            alt="Client Logo"></a>
                </div>
                <div class="client-logo-item" data-aos="flip-up" data-aos-delay="50" data-aos-duration="1500"
                    data-aos-offset="50">
                    <a href="#"><img src="{{ asset('clients/assets/images/client-logos/client-logo2.png') }}"
                            alt="Client Logo"></a>
                </div>
                <div class="client-logo-item" data-aos="flip-up" data-aos-delay="100" data-aos-duration="1500"
                    data-aos-offset="50">
                    <a href="#"><img src="{{ asset('clients/assets/images/client-logos/client-logo3.png') }}"
                            alt="Client Logo"></a>
                </div>
                <div class="client-logo-item" data-aos="flip-up" data-aos-delay="150" data-aos-duration="1500"
                    data-aos-offset="50">
                    <a href="#"><img src="{{ asset('clients/assets/images/client-logos/client-logo4.png') }}"
                            alt="Client Logo"></a>
                </div>
                <div class="client-logo-item" data-aos="flip-up" data-aos-delay="200" data-aos-duration="1500"
                    data-aos-offset="50">
                    <a href="#"><img src="{{ asset('clients/assets/images/client-logos/client-logo5.png') }}"
                            alt="Client Logo"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Client Logo Area end -->



@include('clients.blocks.footer')
