<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Tours;
use Illuminate\Support\Facades\Http; // <-- THÊM DÒNG NÀY

class ChatbotController extends Controller
{
    private $tours;

    public function __construct()
    {
        parent::__construct();
        $this->tours = new Tours();
    }

    public function handleQuery(Request $request)
    {
        $userMessage = $request->input('message', '');
        $lowerUserMessage = strtolower($userMessage);

        $context = session('chatbot_context', [
            'state' => 'idle',
            'criteria' => ['destination' => null, 'duration_days' => null, 'max_price' => null],
            'last_bot_question' => null
        ]);

        $responseMessage = '';

        // --- Xử lý logic hội thoại ---

        // ƯU TIÊN 1: Chào hỏi hoặc Reset
        if (str_contains($lowerUserMessage, 'chào') || str_contains($lowerUserMessage, 'hello') || str_contains($lowerUserMessage, 'hi') || str_contains($lowerUserMessage, 'halo')) {
             $responseMessage = 'Chào bạn! Tôi là TravelaBot, tôi có thể giúp bạn tìm tour, hỏi đáp chính sách hoặc xem thời tiết hôm nay. Bạn cần hỗ trợ gì ạ?';
             // Reset context khi chào hỏi lại
             $context = ['state' => 'idle', 'criteria' => ['destination' => null, 'duration_days' => null, 'max_price' => null], 'last_bot_question' => null];
        }
        elseif (in_array($lowerUserMessage, ['hủy', 'bỏ qua', 'làm lại', 'reset'])) {
            $context = ['state' => 'idle', 'criteria' => ['destination' => null, 'duration_days' => null, 'max_price' => null], 'last_bot_question' => null];
            $responseMessage = 'Ok, chúng ta bắt đầu lại nhé. Bạn cần tôi giúp gì?';
        }

     // ƯU TIÊN 2: Xử lý thời tiết nếu được hỏi
        elseif (str_contains($lowerUserMessage, 'thời tiết')) {
            $apiKey = config('services.openweathermap.key');
            $defaultLocation = "Hà Nội, VN"; // Đặt địa điểm mặc định
            $locationToQuery = $defaultLocation; // Bắt đầu với địa điểm mặc định
            $locationExtracted = false;

            // Cố gắng trích xuất địa điểm từ tin nhắn (Xử lý tiếng Việt tốt hơn)
            // Danh sách địa điểm cần mở rộng thêm (dùng chữ thường, có dấu)
            $knownLocations = ['hà nội', 'hà giang', 'huế', 'phú quốc', 'đà nẵng', 'hội an', 'sapa', 'hạ long', 'sài gòn', 'tp hcm', 'tp.hcm', 'nha trang', 'đà lạt']; // Thêm các địa điểm khác vào đây

            foreach ($knownLocations as $loc) {
                // Sử dụng mb_stripos để tìm chuỗi không phân biệt hoa thường và hỗ trợ Unicode (tiếng Việt)
                if (mb_stripos($lowerUserMessage, $loc) !== false) {
                    // Chuyển đổi một số tên thông dụng
                    if (in_array($loc, ['sài gòn', 'tp hcm', 'tp.hcm'])) {
                        $locationToQuery = "Ho Chi Minh City, VN";
                    } else {
                        // Viết hoa chữ cái đầu của mỗi từ cho API
                        $locationToQuery = ucwords($loc) . ", VN";
                    }
                    $locationExtracted = true;
                    break; // Dừng lại khi tìm thấy địa điểm đầu tiên khớp
                }
            }

            // Xử lý logic gọi API
            if (!$apiKey) {
                $responseMessage = "Xin lỗi, tôi chưa được cấu hình để xem thời tiết (thiếu API key).";
            } else {
                try {
                    $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($locationToQuery) . "&appid={$apiKey}&units=metric&lang=vi";
                    $weatherResponse = Http::get($apiUrl);

                    if ($weatherResponse->successful()) {
                        $weatherData = $weatherResponse->json();
                        if (isset($weatherData['main']) && isset($weatherData['weather'][0])) {
                            $temp = round($weatherData['main']['temp']);
                            $description = $weatherData['weather'][0]['description'];
                            $humidity = $weatherData['main']['humidity'];
                            $cityName = $weatherData['name'];
                            $responseMessage = "Thời tiết hiện tại ở {$cityName}: {$temp}°C, {$description}, độ ẩm {$humidity}%.";
                        } else {
                            $responseMessage = "Xin lỗi, tôi không tìm thấy thông tin thời tiết cho địa điểm '{$locationToQuery}'. Bạn thử kiểm tra lại tên nhé.";
                        }
                    } else {
                        if ($weatherResponse->status() == 404) {
                            $responseMessage = "Xin lỗi, tôi không tìm thấy thông tin thời tiết cho địa điểm '{$locationToQuery}'. Bạn thử kiểm tra lại tên nhé.";
                        } else {
                            $responseMessage = "Xin lỗi, tôi không thể lấy thông tin thời tiết lúc này. Mã lỗi: " . $weatherResponse->status();
                        }
                    }
                } catch (\Exception $e) {
                    \Log::error("Lỗi gọi API thời tiết: " . $e->getMessage());
                    $responseMessage = "Xin lỗi, đã xảy ra lỗi khi cố gắng lấy thông tin thời tiết.";
                }
            }
            // Sau khi trả lời thời tiết, quay về trạng thái idle
            $context['state'] = 'idle';
        }
        // ƯU TIÊN 3: Tiếp tục hội thoại tìm tour nếu đang diễn ra
        elseif ($context['state'] === 'awaiting_destination') {
            // ... (Giữ nguyên logic hỏi địa điểm) ...
             $destination = $this->extractDestination($lowerUserMessage);
            if ($destination) {
                $context['criteria']['destination'] = $destination;
                $context['state'] = 'awaiting_duration';
                $context['last_bot_question'] = 'duration';
                $responseMessage = "Bạn muốn đi " . ucfirst($destination) . " trong mấy ngày?";
            } else {
                $responseMessage = "Tôi chưa nhận ra địa điểm. Bạn muốn đi đâu ạ?";
            }
        }
        elseif ($context['state'] === 'awaiting_duration') {
             // ... (Giữ nguyên logic hỏi thời gian) ...
             $duration = $this->extractDuration($lowerUserMessage);
            if ($duration) {
                $context['criteria']['duration_days'] = $duration;
                $context['state'] = 'awaiting_price';
                $context['last_bot_question'] = 'price';
                $responseMessage = "Bạn muốn chi khoảng bao nhiêu tiền cho chuyến đi này? (Ví dụ: dưới 5 triệu)";
            } else {
                if (str_contains($lowerUserMessage, 'không') || str_contains($lowerUserMessage, 'bỏ qua')) {
                    $context['criteria']['duration_days'] = null;
                    $context['state'] = 'awaiting_price';
                    $context['last_bot_question'] = 'price';
                    $responseMessage = "Ok bỏ qua thời gian. Vậy bạn muốn chi khoảng bao nhiêu tiền? (Ví dụ: dưới 5 triệu)";
                } else {
                    $responseMessage = "Tôi chưa hiểu rõ số ngày bạn muốn đi. Bạn muốn đi mấy ngày?";
                }
            }
        }
        elseif ($context['state'] === 'awaiting_price') {
             // ... (Giữ nguyên logic hỏi giá và tìm tour) ...
            $price = $this->extractPrice($lowerUserMessage);
             if ($price) {
                $context['criteria']['max_price'] = $price;
                $responseMessage = $this->findAndFormatTours($context['criteria']);
                $context = ['state' => 'idle', 'criteria' => ['destination' => null, 'duration_days' => null, 'max_price' => null], 'last_bot_question' => null];
            } else {
                 if (str_contains($lowerUserMessage, 'không') || str_contains($lowerUserMessage, 'bỏ qua')) {
                    $context['criteria']['max_price'] = null;
                    $responseMessage = $this->findAndFormatTours($context['criteria']);
                    $context = ['state' => 'idle', 'criteria' => ['destination' => null, 'duration_days' => null, 'max_price' => null], 'last_bot_question' => null];
                 } else {
                    $responseMessage = "Tôi chưa hiểu rõ mức giá bạn mong muốn. Bạn muốn chi tối đa bao nhiêu? (Ví dụ: dưới 5 triệu, khoảng 3tr)";
                 }
            }
        }

        // ƯU TIÊN 4: Bắt đầu hội thoại tìm tour mới HOẶC trả lời câu hỏi Cấp 1
        elseif ($context['state'] === 'idle') {
             // Cố gắng trích xuất tiêu chí
            $extractedCriteria = [
                'destination' => $this->extractDestination($lowerUserMessage),
                'duration_days' => $this->extractDuration($lowerUserMessage),
                'max_price' => $this->extractPrice($lowerUserMessage)
            ];

            // Nếu trích xuất được địa điểm -> Bắt đầu luồng tìm tour
            if ($extractedCriteria['destination']) {
                $context['criteria'] = $extractedCriteria;
                if ($context['criteria']['duration_days'] === null) {
                    $context['state'] = 'awaiting_duration';
                    $context['last_bot_question'] = 'duration';
                    $responseMessage = "Bạn muốn đi " . ucfirst($context['criteria']['destination']) . " trong mấy ngày?";
                } elseif ($context['criteria']['max_price'] === null) {
                    $context['state'] = 'awaiting_price';
                    $context['last_bot_question'] = 'price';
                    $responseMessage = "Bạn muốn chi khoảng bao nhiêu tiền cho chuyến đi " . $context['criteria']['duration_days'] . " ngày này?";
                } else {
                    $responseMessage = $this->findAndFormatTours($context['criteria']);
                    // Reset trạng thái idle
                     $context = ['state' => 'idle', 'criteria' => ['destination' => null, 'duration_days' => null, 'max_price' => null], 'last_bot_question' => null];
                }
            }
            // Nếu không có địa điểm -> Xử lý Cấp 1
            else {
                if (str_contains($lowerUserMessage, 'thanh toán') || str_contains($lowerUserMessage, 'chuyển khoản')) {
                    $responseMessage = 'Chúng tôi chấp nhận thanh toán tại văn phòng, chuyển khoản ngân hàng, và qua cổng thanh toán Momo/PayPal bạn nhé.';
                }
                 elseif (str_contains($lowerUserMessage, 'hủy tour') || str_contains($lowerUserMessage, 'hoàn tiền')) {
                    $responseMessage = 'Bạn có thể xem chi tiết chính sách hủy tour và hoàn tiền tại trang <a href="/policy" target="_blank">Chính sách</a> của chúng tôi.';
                }
                // ... (Các elseif Cấp 1 khác) ...
                else {
                    $responseMessage = 'Tôi chưa hiểu rõ ý của bạn lắm. Bạn có thể hỏi về thời tiết hôm nay, hỏi tìm tour (ví dụ: "đi Hà Giang 3 ngày dưới 5 triệu"), hoặc hỏi về "thanh toán", "hủy tour"...';
                }
                 // Giữ state là idle
                 $context = ['state' => 'idle', 'criteria' => ['destination' => null, 'duration_days' => null, 'max_price' => null], 'last_bot_question' => null];
            }
        }

        // Lưu ngữ cảnh mới vào Session
        session(['chatbot_context' => $context]);

        // Trả về phản hồi JSON
        return response()->json(['reply' => $responseMessage]);
    }
    // --- Các hàm phụ trợ để trích xuất thông tin ---

    private function extractDestination($message) {
        $knownDestinations = ['hà giang', 'huế', 'phú quốc', 'đà nẵng', 'hội an', 'sapa', 'hạ long']; // Cần cập nhật danh sách này
        foreach ($knownDestinations as $dest) {
            if (str_contains($message, $dest)) {
                return $dest;
            }
        }
        return null;
    }

    private function extractDuration($message) {
        if (preg_match('/([0-9]+)\s*ngày/', $message, $matches)) {
            return intval($matches[1]);
        }
        return null;
    }

    private function extractPrice($message) {
         if (preg_match('/(dưới|tầm|khoảng)\s*([0-9,.]+)\s*(triệu|tr|k)/', $message, $matches) || preg_match('/([0-9,.]+)\s*(triệu|tr|k)\s*trở xuống/', $message, $matches)) {
            $value = floatval(str_replace([',', '.'], '', $matches[count($matches) === 4 ? 2 : 1])); // Lấy giá trị số
            $unit = $matches[count($matches) === 4 ? 3 : 2]; // Lấy đơn vị
             if ($unit == 'triệu' || $unit == 'tr') {
                return $value * 1000000;
            } elseif ($unit == 'k') {
                return $value * 1000;
            }
        }
        return null;
    }

    // --- Hàm tìm tour và định dạng kết quả ---
    private function findAndFormatTours($criteria) {
        $foundTours = $this->tours->findToursByCriteria($criteria); // Gọi hàm đã có trong Model

        if ($foundTours->isNotEmpty()) {
            $response = "OK! Tôi tìm thấy " . $foundTours->count() . " tour phù hợp:<br><ul>";
            foreach ($foundTours as $tour) {
                $tourLink = route('tour-detail', ['id' => $tour->tourId]);
                $response .= "<li><a href='{$tourLink}' target='_blank'>{$tour->title}</a> ({$tour->time}) - Giá từ: " . number_format($tour->priceAdult, 0, ',', '.') . " VND</li>";
            }
            $response .= "</ul>";
            return $response;
        } else {
             $response = "Rất tiếc, tôi không tìm thấy tour nào khớp với yêu cầu của bạn (";
             if ($criteria['destination']) $response .= ucfirst($criteria['destination']);
             if ($criteria['duration_days']) $response .= ", " . $criteria['duration_days'] . " ngày";
             if ($criteria['max_price']) $response .= ", dưới " . number_format($criteria['max_price'], 0, ',', '.') . " VND";
             $response .= "). Bạn thử tìm lại với tiêu chí khác nhé, hoặc gõ 'hủy' để bắt đầu lại.";
            return $response;
        }
    }
}