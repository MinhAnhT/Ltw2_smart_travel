/* ===== TOÀN BỘ LOGIC JS TÙY CHỈNH ===== */

// Hàm toast chung
function showToast(msg) {
    const toast = document.createElement('div');
    toast.className = 'toast-message';
    toast.textContent = msg;
    document.body.appendChild(toast);
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Logic hiệu ứng placeholder (từ banner_home)
    const input = document.getElementById('destination-input');
    if (input) { // Chỉ chạy nếu có ô input này
        let recent = JSON.parse(localStorage.getItem('recentDestinations') || '[]');
        if (recent.length === 0) {
            recent = ["Explore Hanoi", "Tokyo Disneyland", "teamlab borderless", "Đà Nẵng", "Phú Quốc"];
        }
        let idx = 0;
        input.placeholder = recent[0];

        setInterval(() => {
            if (!input.value) {
                input.style.transition = "opacity 0.4s";
                input.style.opacity = 0.3;
                setTimeout(() => {
                    idx = (idx + 1) % recent.length;
                    input.placeholder = recent[idx];
                    input.style.opacity = 1;
                }, 400);
            }
        }, 5000);
    }

    // 2. Logic Form Search (Validation + LocalStorage)
    const searchForm = document.getElementById('search_form');
    if (searchForm) { // Chỉ chạy nếu có form này
        searchForm.addEventListener('submit', function(e) {
            const destinationInput = document.getElementById('destination-input');
            const destination = destinationInput ? destinationInput.value.trim() : null;
            const start = document.getElementById('checkin').value;
            const end = document.getElementById('checkout').value;

            // === VALIDATION MỚI: Kiểm tra điểm đến ===
            if (!destination) {
                showToast("Bạn phải nhập điểm đến");
                e.preventDefault(); // Ngăn form gửi đi
                return false;
            }

            // === VALIDATION CŨ: Kiểm tra ngày ===
            if (start && end && start > end) {
                showToast("Bạn phải chọn ngày về sau ngày đi");
                e.preventDefault(); // Ngăn form gửi đi
                return false;
            }

            // 3. Logic Local Storage (từ banner_home)
            if (destination) {
                let recent = JSON.parse(localStorage.getItem('recentDestinations') || '[]');
                recent = [destination, ...recent.filter(item => item !== destination)].slice(0, 5);
                localStorage.setItem('recentDestinations', JSON.stringify(recent));
            }
        });
    }

    // 4. Khởi tạo Flatpickr (từ banner_home)
    if (window.flatpickr) {
        if (document.getElementById('checkin')) {
            flatpickr("#checkin", { dateFormat: "Y-m-d" });
        }
        if (document.getElementById('checkout')) {
            flatpickr("#checkout", { dateFormat: "Y-m-d" });
        }
    }

});