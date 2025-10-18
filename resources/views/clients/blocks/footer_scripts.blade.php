{{-- 
  FILE NÀY CHỨA TẤT CẢ JS ĐÃ ĐƯỢC HỢP NHẤT VÀ SẮP XẾP ĐÚNG THỨ TỰ.
--}}

<script src="{{ asset('clients/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/appear.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/slick.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/skill.bars.jquery.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/aos.js') }}"></script>
<script src="{{ asset('clients/assets/js/script.js') }}"></script>
<script src="{{ asset('clients/assets/js/custom-js.js') }}"></script>
{{-- jquery-toast --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{-- paypal-payment --}}
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
{{-- datetimepicker --}}
<script src="{{ asset('clients/assets/js/jquery.datetimepicker.full.min.js') }}"></script>
{{-- select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- flatpickr (từ banner_home) --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="{{ asset('clients/assets/js/custom-app.js') }}"></script>

{{-- 
  ĐÃ TẮT VITE ĐỂ TRÁNH XUNG ĐỘT VỚI FILE bootstrap.min.js CỦA THEME
  @vite(['resources/js/app.js']) 
--}}

{{-- Script thông báo lỗi từ Session (Chung cho mọi trang) --}}
@if (session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif

{{-- Script toast cho trang home (nếu không tìm thấy tour) --}}
@if (isset($tours) && count($tours) == 0 && Route::currentRouteName() == 'search')
    <script>
        showToast("Không có tour nào được tìm thấy!");
    </script>
@endif