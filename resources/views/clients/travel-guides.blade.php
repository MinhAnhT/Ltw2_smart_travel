@include('clients.blocks.header_home')
@include('clients.blocks.banner')

<!-- Benefit Area start -->
<section class="benefit-area mt-100 rel z-1">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-5 col-lg-6">
                <div class="mobile-app-content rmb-55" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="section-title counter-text-wrap mb-40">
                        <h2 class="benefit-title text-black">Đội ngũ hướng dẫn viên chuyên nghiệp của chúng tôi</h2>
                    </div>
                    <p>Đội ngũ hướng dẫn viên của chúng tôi không chỉ là những chuyên gia về tuyến điểm, họ là những người kể chuyện đầy đam mê, những người bạn đồng hành am hiểu văn hóa bản địa sâu sắc. Được đào tạo bài bản và tuyển chọn kỹ lưỡng, mỗi hướng dẫn viên đều cam kết mang đến cho bạn một hành trình an toàn, trọn vẹn và đầy ắp những kỷ niệm khó quên.</p>
                    <div class="skillbar mt-80" data-percent="93">
                        <span class="skillbar-title">Clients Satisfactions</span>
                       
                        <div class="progress-bar-striped skillbar-bar progress-bar-animated" role="progressbar"
                            aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                        <span class="skill-bar-percent"></span>
                    </div>
                    <ul class="list-style-two mt-35 mb-30">
                        <li>Cơ quan trải nghiệm</li>
                        <li>Đội ngũ chuyên nghiệp</li>
                    </ul>
                    <a href="about.html" class="theme-btn style-two">
                        <span data-hover="Khám phá Guides">Khám phá Guides</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="benefit-image-part style-two">
                    <div class="image-one" data-aos="fade-down" data-aos-delay="50" data-aos-duration="1500"
                        data-aos-offset="50">
                        <img src="{{ asset('clients/assets/images/benefit/benefit1.png') }}" alt="Benefit">
                    </div>
                    <div class="image-two" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500"
                        data-aos-offset="50">
                        <img src="{{ asset('clients/assets/images/benefit/benefit2.png') }}" alt="Benefit">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Benefit Area end -->


<!-- Team Area start -->
<section class="about-team-area pt-100 rel z-1">
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
                <div class="team-item hover-content" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <img src="{{ asset('clients/assets/images/team/guide-anh.png') }}" alt="Guide">
                    <div class="content">
                        <h6>Minh Anh</h6>
                        <span class="designation">Founder</span>
                        <div class="social-style-one inner-content">
                            <a href="https://www.facebook.com/share/16DQDeE7v7/"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/share/16DQDeE7v7/"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.facebook.com/share/16DQDeE7v7/"><i class="fab fa-instagram"></i></a>
                            <a href="contact.html"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-item hover-content" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <img src="{{ asset('clients/assets/images/team/guide-thu.png') }}" alt="Guide">
                    <div class="content">
                        <h6>Ha Thu</h6>
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
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-item hover-content" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <img src="{{ asset('clients/assets/images/team/guide-duong.png') }}" alt="Guide">
                    <div class="content">
                        <h6>Bach Duong</h6>
                        <span class="designation">Travel Guide</span>
                        <div class="social-style-one inner-content">
                            <a href="contact.html"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/dienne.dev"><i class="fab fa-facebook-f"></i></a>
                            <a href="contact.html"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com/@dienne248"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-item hover-content" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500"
                    data-aos-offset="50">
                    <img src="{{ asset('clients/assets/images/team/guide-binh.png') }}" alt="Guide">
                    <div class="content">
                        <h6>Thanh Binh</h6>
                        <span class="designation">Senior Guide</span>
                        <div class="social-style-one inner-content">
                            <a href="contact.html"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/dienne.dev"><i class="fab fa-facebook-f"></i></a>
                            <a href="contact.html"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com/@dienne248"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-item hover-content" data-aos="fade-up" data-aos-delay="100"
                    data-aos-duration="1500" data-aos-offset="50">
                    <img src="{{ asset('clients/assets/images/team/guide-my.png') }}" alt="Guide">
                    <div class="content">
                        <h6>Tra My</h6>
                        <span class="designation">Travel Guide</span>
                        <div class="social-style-one inner-content">
                            <a href="contact.html"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/dienne.dev"><i class="fab fa-facebook-f"></i></a>
                            <a href="contact.html"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com/@dienne248"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-item hover-content" data-aos="fade-up" data-aos-delay="100"
                    data-aos-duration="1500" data-aos-offset="50">
                    <img src="{{ asset('clients/assets/images/team/guide-nhung.png') }}" alt="Guide">
                    <div class="content">
                        <h6>Nhung</h6>
                        <span class="designation">Travel Guide</span>
                        <div class="social-style-one inner-content">
                            <a href="contact.html"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/dienne.dev"><i class="fab fa-facebook-f"></i></a>
                            <a href="contact.html"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com/@dienne248"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-item hover-content" data-aos="fade-up" data-aos-delay="100"
                    data-aos-duration="1500" data-aos-offset="50">
                    <img src="{{ asset('clients/assets/images/team/guide-ngoc.png') }}" alt="Guide">
                    <div class="content">
                        <h6>Minh Ngoc</h6>
                        <span class="designation">Travel Guide</span>
                        <div class="social-style-one inner-content">
                            <a href="contact.html"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/dienne.dev"><i class="fab fa-facebook-f"></i></a>
                            <a href="contact.html"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com/@dienne248"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-item hover-content" data-aos="fade-up" data-aos-delay="100"
                    data-aos-duration="1500" data-aos-offset="50">
                    <img src="{{ asset('clients/assets/images/team/guide-dang.png') }}" alt="Guide">
                    <div class="content">
                        <h6>Hai Dang</h6>
                        <span class="designation">Travel Guide</span>
                        <div class="social-style-one inner-content">
                            <a href="contact.html"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/dienne.dev"><i class="fab fa-facebook-f"></i></a>
                            <a href="contact.html"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com/@dienne248"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Team Area end -->


@include('clients.blocks.new_letter')
@include('clients.blocks.footer')
