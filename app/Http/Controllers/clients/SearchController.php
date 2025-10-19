<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Tours;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Tour;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    private $tours;

    public function __construct()
    {
        $this->tours = new Tours();
    }
    public function index(Request $request)
    {
        $title = 'Tìm kiếm';

        $destination = $request->input('destination');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Chuyển đổi định dạng ngày tháng
        $formattedStartDate = $startDate ? Carbon::createFromFormat('Y-m-d', $startDate)->format('Y-m-d') : null;
        $formattedEndDate = $endDate ? Carbon::createFromFormat('Y-m-d', $endDate)->format('Y-m-d') : null;


        $dataSearch = [
            'destination' => $destination,
            'startDate' => $formattedStartDate,
            'endDate' => $formattedEndDate,
        ];

        $tours = $this->tours->searchTours($dataSearch);

        // dd($tours);

        return view('clients.search', compact('title', 'tours'));
    }

    public function searchTours(Request $request)
    {
        $title = 'Tìm kiếm';

        $keyword = $request->input('keyword');

        // Gọi API Python đã xử lý để lấy danh sách tour tìm kiếm
        try {
            $apiUrl = 'http://127.0.0.1:5555/api/search-tours';
            $response = Http::get($apiUrl, [
                'keyword' => $keyword
            ]);

            if ($response->successful()) {
                $resultTours = $response->json('related_tours');
            } else {
                $resultTours = [];
            }
        } catch (\Exception $e) {
            // Xử lý lỗi khi gọi API
            $resultTours = [];
            \Log::error('Lỗi khi gọi API liên quan: ' . $e->getMessage());
        }

        // dd($resultTours);
        if ($resultTours) {
            $tours = $this->tours->toursSearch($resultTours);

        } else {
            $dataSearch = [
                'keyword' => $keyword
            ];
            $tours = $this->tours->searchTours($dataSearch);
        }

        // dd($tours);

        return view('clients.search', compact('title', 'tours'));
    }
}
