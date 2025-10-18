{{-- 
  PHẦN NÀY ĐÃ ĐƯỢC DỌN DẸP
  - Toàn bộ <style>...</style> đã được chuyển vào file CSS chính.
  - Toàn bộ <script>...</script> đã được chuyển vào file JS tùy chỉnh (custom-app.js).
--}}

<section class="hero-area bgc-black rel z-2"
    style="position: relative; height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center;">

    <div class="main-hero-image bgs-cover"
        style="background-image: url({{ asset('clients/assets/images/hero/hero.jpg') }}); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; filter: brightness(0.8);">
    </div>

    <div class="hero-content-container" style="position: relative; z-index: 2; width: 100%;">

        {{-- Form vẫn giữ nguyên, bao gồm cả ID và route --}}
        <form action="{{ route('search') }}" method="GET" id="search_form" style="margin-bottom: 50px;">
            <div class="container container-1400">
                <div class="search-filter-inner" data-aos="zoom-out-down" data-aos-duration="1500" data-aos-offset="50">

                    <div class="filter-item filter-location">
                        <span class="icon"><i class="fas fa-search"></i></span>
                        <input type="text" name="destination" id="destination-input"
                            placeholder="Nhập điểm đến..." autocomplete="off">
                    </div>

                    <div class="filter-item">
                        <span class="icon"><i class="fal fa-calendar-alt"></i></span>
                        <input type="text" id="checkin" name="start_date" class="datetimepicker datetimepicker-custom"
                            placeholder="Ngày đi" readonly>
                    </div>

                    <div class="filter-item">
                        <span class="icon"><i class="fal fa-calendar-alt"></i></span>
                        <input type="text" id="checkout" name="end_date" class="datetimepicker datetimepicker-custom"
                            placeholder="Ngày về" readonly>
                    </div>

                    <div class="search-button">
                        <button class="theme-btn" type="submit">
                            <span data-hover="Tìm kiếm">Tìm kiếm</span>
                            <i class="far fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <h1 class="hero-title"
            style="font-size: 90px; line-height: 1.1; color: white; margin-bottom: 25px;"
            data-aos="flip-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
            Tours Du Lịch
        </h1>

        <p style="color: white; font-size: 18px; max-width: 750px; margin: 0 auto; line-height: 1.6;">
            Mở ra chân trời mới, đam mê mới và đánh thức phiên bản rực rỡ của bạn cùng Travela - trên mọi hành trình, dù gần hay xa.
        </p>
    </div>
</section>