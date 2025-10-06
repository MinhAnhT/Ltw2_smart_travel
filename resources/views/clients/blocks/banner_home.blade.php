{{-- Khối CSS tùy chỉnh cho các yêu cầu mới --}}
<style>
    /* Thu gọn chiều cao của các ô trong thanh tìm kiếm */
    .search-filter-inner .filter-item,
    .search-filter-inner .search-button .theme-btn {
        height: 55px; /* Giảm chiều cao */
        padding-top: 5px;
        padding-bottom: 5px;
    }

    /* Căn giữa chữ "Chọn điểm đến", "Chọn ngày đi", v.v. */
    .search-filter-inner .filter-item select,
    .search-filter-inner .filter-item input {
        text-align: center;
        text-align-last: center; /* Thêm dòng này để áp dụng căn giữa cho thẻ select */
    }

    /* Căn giữa cho placeholder trên các trình duyệt khác nhau */
    .search-filter-inner .filter-item input::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        text-align: center;
        opacity: 1; /* Firefox */
    }
    .search-filter-inner .filter-item input:-ms-input-placeholder { /* Internet Explorer 10-11 */
        text-align: center;
    }
    .search-filter-inner .filter-item input::-ms-input-placeholder { /* Microsoft Edge */
        text-align: center;
    }
</style>

{{-- Thay đổi ở dòng dưới: Dùng flexbox để đẩy nội dung lên trên --}}
<section class="hero-area bgc-black rel z-2" style="position: relative; height: 650px; display: flex; align-items: flex-start; justify-content: center; text-align: center; padding-top: 120px;">

    {{-- Lớp ảnh nền --}}
    <div class="main-hero-image bgs-cover"
        style="background-image: url({{ asset('clients/assets/images/hero/hero.jpg') }}); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; filter: brightness(0.8);">
    </div>

    {{-- Khối chứa nội dung --}}
    <div class="hero-content-container" style="position: relative; z-index: 2; width: 100%;">

        {{-- Form tìm kiếm --}}
        <form action="{{ route('search') }}" method="GET" id="search_form" style="margin-bottom: 60px;">
            <div class="container container-1400">
                <div class="search-filter-inner" data-aos="zoom-out-down" data-aos-duration="1500" data-aos-offset="50">
                    <div class="filter-item clearfix">
                        <div class="icon"><i class="fal fa-map-marker-alt"></i></div>
                        <span class="title">Điểm đến</span>
                        <select name="destination" id="destination">
                            <option value="">Chọn điểm đến</option>
                            <option value="dn">Đà Nẵng</option>
                            <option value="cd">Côn Đảo</option>
                            <option value="hn">Hà Nội</option>
                            <option value="hcm">TP. Hồ Chí Minh</option>
                            <option value="vt">Vũng Tàu</option>
                            <option value="qn">Quảng Ninh</option>
                            <option value="la">Lào Cai (Sa Pa)</option>
                            <option value="bd">Bình Định (Quy Nhơn)</option>
                        </select>
                    </div>
                    <div class="filter-item clearfix">
                        <div class="icon"><i class="fal fa-calendar-alt"></i></div>
                        <span class="title">Ngày khởi hành</span>
                        <input type="text" id="start_date" name="start_date" class="datetimepicker datetimepicker-custom"
                            placeholder="Chọn ngày đi" readonly>
                    </div>
                    <div class="filter-item clearfix">
                        <div class="icon"><i class="fal fa-calendar-alt"></i></div>
                        <span class="title">Ngày kết thúc</span>
                        <input type="text" id="end_date" name="end_date" class="datetimepicker datetimepicker-custom"
                            placeholder="Chọn ngày về" readonly>
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

        {{-- Tiêu đề --}}
        <h1 class="hero-title" style="font-size: 90px; line-height: 1.1; color: white; margin-bottom: 25px;" data-aos="flip-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
            Tours Du Lịch
        </h1>

        {{-- Dòng mô tả --}}
        <p style="color: white; font-size: 18px; max-width: 750px; margin: 0 auto; line-height: 1.6;">
            Mở ra chân trời mới, đam mê mới và đánh thức phiên bản rực rỡ của bạn cùng Travela - trên mọi hành trình, dù gần hay xa.
        </p>

    </div>
</section>