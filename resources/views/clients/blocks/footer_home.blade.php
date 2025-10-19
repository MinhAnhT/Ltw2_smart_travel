<!-- footer area start -->
<footer class="main-footer footer-two bgp-bottom bgc-black rel z-15 pt-100 pb-115" style="background-image: url({{ asset('clients/assets/images/backgrounds/footer-two.png')}});">
    <div class="widget-area">
        <div class="container">
            <div class="row row-cols-xxl-5 row-cols-xl-4 row-cols-md-3 row-cols-2">
                <div class="col col-small" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="footer-widget footer-text">
                        <div class="footer-logo mb-40">
                            <a href="{{ route('home') }}"><img src="{{ asset('clients/assets/images/logos/logo.png') }}" alt="Logo"></a>
                        </div>
                        <div class="footer-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.7485384583883!2d105.74611147507892!3d20.96261118067017!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313452efff394ce3%3A0x391a39d4325be464!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBQaGVuaWthYQ!5e0!3m2!1svi!2s!4v1760846172112!5m2!1svi!2s"
                            style="border:0; width: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col col-small" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                    <div class="footer-widget footer-links ms-sm-5">
                        <div class="footer-title">
                            <h5>Dịch vụ</h5>
                        </div>
                        <ul class="list-style-three">
                            <li><a href="{{ route('team') }}">Hướng dẫn viên du lịch tốt nhất</a></li>
                            <li><a href="{{ route('tours') }}">Đặt tour</a></li>
                            <li><a href="{{ route('tours') }}">Đặt vé</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-small" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                    <div class="footer-widget footer-links ms-md-4">
                        <div class="footer-title">
                            <h5>Công ty</h5>
                        </div>
                        <ul class="list-style-three">
                            <li><a href="{{ route('about') }}">Giới thiệu về công ty</a></li>
                            <li><a href="{{ route('contact') }}">Việc làm và nghề nghiệp</a></li>
                            <li><a href="{{ route('contact') }}">Liên hệ với chúng tôi</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-small" data-aos="fade-up" data-aos-delay="150" data-aos-duration="1500" data-aos-offset="50">
                    <div class="footer-widget footer-links ms-lg-4">
                        <div class="footer-title">
                            <h5>Điểm đến</h5>
                        </div>
                        <ul class="list-style-three">
                            <li><a href="{{ route('destination') }}">Miền Bắc</a></li>
                            <li><a href="{{ route('destination') }}">Miền Trung</a></li>
                            <li><a href="{{ route('destination') }}">Miền Nam</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-md-6 col-10 col-small" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1500" data-aos-offset="50">
                    <div class="footer-widget footer-contact">
                        <div class="footer-title">
                            <h5>Liên hệ</h5>
                        </div>
                        <ul class="list-style-one">
                            <li><i class="fal fa-map-marked-alt"></i> P. Nguyễn Trác, Yên Nghĩa, Hà Đông, Hà Nội</li>
                            <li><i class="fal fa-envelope"></i> <a
                                    href="mailto:minhdien.dev@gmail.com">anhthuduongbinhmy@gmail.com</a></li>
                            <li><i class="fal fa-phone-volume"></i> <a href="callto:+88012334588">+880 (123)
                                    345 88</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom bg-transparent pt-20 pb-5">
        <div class="container">
            <div class="row">
               <div class="col-lg-5">
                    <div class="copyright-text text-center text-lg-start">
                        <p>@Copy 2025 <a href="\">Travela</a>, All rights reserved</p>
                    </div>
               </div>
               <div class="col-lg-7 text-center text-lg-end">
                   <ul class="footer-bottom-nav">
                    <li><a href="{{ route('about') }}">Điều khoản</a></li>
                    <li><a href="{{ route('about') }}">Chính sách bảo mật</a></li>
                    <li><a href="{{ route('about') }}">Thông báo pháp lý</a></li>
                    <li><a href="{{ route('about') }}">Khả năng truy cập</a></li>
                   </ul>
               </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->

{{-- THAY THẾ BẰNG ĐOẠN NÀY --}}
</div>
{{-- =================================================== --}}
{{--            BẮT ĐẦU CODE CHATBOT AI                   --}}
{{-- =================================================== --}}

<style>
    .travela-chatbot {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
    }
  .chat-bubble {
    width: 60px;
    height: 60px;
    background: #007bff;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
    /* THÊM DÒNG NÀY ĐỂ ÁP DỤNG ANIMATION */
    animation: shake 1.5s ease-in-out infinite; /* Tên, Thời gian, Kiểu, Lặp lại */
    animation-delay: 3s; /* Bắt đầu rung sau 3 giây */
    }
    .chat-bubble:hover {
        transform: scale(1.1);
    }

    /* ... (CSS cho .travela-chatbot, .chat-bubble giữ nguyên) ... */

    .chat-window {
        width: 300px;
        height: 400px; /* <--- GIẢM CHIỀU CAO XUỐNG ĐÂY */
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        position: absolute;
        bottom: 80px;
        right: 0;
        display: none;
        flex-direction: column;
        overflow: hidden;
    }
    .chat-window.show {
        display: flex;
    }

    .chat-header {
        background: #007bff;
        color: white;
        padding: 12px 15px; /* Giảm padding chiều dọc một chút */
        text-align: center;
        font-weight: bold;
        font-size: 16px; /* Giảm font chữ tiêu đề */
        position: relative;
        flex-shrink: 0; /* Ngăn header bị co lại */
    }
    .chat-header #close-chat {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%); /* Căn giữa nút đóng */
        font-size: 20px;
        cursor: pointer;
    }

    .chat-body {
        flex-grow: 1;
        padding: 12px; /* Giảm padding một chút */
        overflow-y: auto;
        background: #f4f7f6;
    }
    .message {
        margin-bottom: 10px; /* Giảm khoảng cách tin nhắn */
        padding: 8px 12px;
        border-radius: 18px;
        max-width: 85%; /* Tăng nhẹ chiều rộng tối đa */
        word-wrap: break-word;
        font-size: 14px; /* Giảm nhẹ font chữ tin nhắn */
        line-height: 1.4;
    }
    .message.bot {
        background: #e9e9eb;
        color: #333;
        align-self: flex-start;
        border-bottom-left-radius: 4px;
    }
    .message.user {
        background: #007bff;
        color: white;
        align-self: flex-end;
        margin-left: auto;
        border-bottom-right-radius: 4px;
    }

    .chat-footer {
        display: flex;
        padding: 8px 10px; /* Giảm padding */
        border-top: 1px solid #ddd;
        flex-shrink: 0; /* Ngăn footer bị co lại */
    }
    .chat-footer #chat-input {
        flex-grow: 1;
        border: 1px solid #ccc;
        border-radius: 20px;
        padding: 6px 12px; /* Giảm padding */
        margin-right: 8px; /* Giảm khoảng cách */
        font-size: 14px;
    }
    .chat-footer #send-btn {
        background: #007bff;
        color: white;
        border: none;
        border-radius: 50%;
        width: 36px; /* Giảm kích thước nút */
        height: 36px;
        font-size: 14px; /* Giảm kích thước icon */
        cursor: pointer;
        flex-shrink: 0;
    }
    @keyframes shake {
    0%, 100% { transform: translateX(0); } /* Vị trí ban đầu và cuối cùng */
    10%, 30%, 50%, 70%, 90% { transform: translateX(-3px); } /* Lắc sang trái */
    20%, 40%, 60%, 80% { transform: translateX(3px); } /* Lắc sang phải */
    }
</style>

<div class="travela-chatbot">
    <div class="chat-window" id="chat-window">
        <div class="chat-header">
            <span>TravelaBot</span>
            <span id="close-chat">&times;</span>
        </div>
        <div class="chat-body" id="chat-body">
            <div class="message bot">Chào bạn! Tôi là TravelaBot. Tôi có thể giúp bạn hỏi đáp về thanh toán, hủy tour, địa chỉ...</div>
        </div>
        <div class="chat-footer">
            <input type="text" id="chat-input" placeholder="Nhập tin nhắn...">
            <button id="send-btn"><i class="fa fa-paper-plane"></i></button>
        </div>
    </div>

    <div class="chat-bubble" id="chat-bubble">
        <i class="fas fa-comment-dots"></i>
    </div>
</div>
{{-- =================================================== --}}
{{--            KẾT THÚC CODE CHATBOT AI                   --}}
{{-- =================================================== --}}
{{-- Tải tất cả script đã được hợp nhất --}}
@include('clients.blocks.footer_scripts')
{{-- =================================================== --}}
{{--            JAVASCRIPT CỦA CHATBOT AI                --}}
{{-- =================================================== --}}
<script>
document.addEventListener("DOMContentLoaded", function() {

    const chatBubble = document.getElementById('chat-bubble');
    const chatWindow = document.getElementById('chat-window');
    const closeChat = document.getElementById('close-chat');
    const chatInput = document.getElementById('chat-input');
    const sendBtn = document.getElementById('send-btn');
    const chatBody = document.getElementById('chat-body');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Kiểm tra xem các phần tử có tồn tại không trước khi gán sự kiện
    if (chatBubble) { 
        chatBubble.addEventListener('click', () => {
            if (chatWindow) chatWindow.classList.add('show');
            chatBubble.style.display = 'none';
        });
    }

    if (closeChat) { 
        closeChat.addEventListener('click', () => {
            if (chatWindow) chatWindow.classList.remove('show');
            if (chatBubble) chatBubble.style.display = 'flex';
        });
    }

    function sendMessage() {
        if (!chatInput) return; 
        const messageText = chatInput.value.trim();
        if (messageText === '') return;

        appendMessage(messageText, 'user');
        chatInput.value = '';

        fetch("{{ route('chatbot.query') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ message: messageText })
        })
        .then(response => {
             if (!response.ok) { 
                throw new Error(`HTTP error! status: ${response.status}`);
             }
             return response.json();
         })
        .then(data => {
            if (data && data.reply) { 
                 appendMessage(data.reply, 'bot');
            } else {
                 appendMessage('Xin lỗi, tôi không nhận được phản hồi hợp lệ.', 'bot');
            }
        })
        .catch(error => {
            console.error('Lỗi khi gọi Chatbot:', error);
            appendMessage('Xin lỗi, tôi đang gặp sự cố. Bạn vui lòng thử lại sau.', 'bot');
        });
    }

    function appendMessage(text, type) {
        if (!chatBody) return; 
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', type);
        messageElement.innerHTML = text; // Dùng innerHTML để thẻ <a> hoạt động
        chatBody.appendChild(messageElement);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    if (sendBtn) { 
        sendBtn.addEventListener('click', sendMessage);
    }

    if (chatInput) { 
        chatInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    }
});
</script>
{{-- =================================================== --}}
</body>
</html>