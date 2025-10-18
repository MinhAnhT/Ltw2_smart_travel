@foreach ($list_booking as $booking)
    <tr>
        <td>{{ $booking->title }}</td>
        <td>{{ $booking->customerName }}</td>  {{-- <--- SỬA Ở ĐÂY --}}
        <td>{{ $booking->customerEmail }}</td> {{-- <--- SỬA Ở ĐÂY --}}
        <td>{{ $booking->customerPhone }}</td> {{-- <--- SỬA Ở ĐÂY --}}
        <td>{{ $booking->customerAddress }}</td> {{-- <--- SỬA Ở ĐÂY --}}
        <td>{{ date('d-m-Y', strtotime($booking->bookingDate)) }}</td>
        <td>{{ $booking->numAdults }}</td>
        <td>{{ $booking->numChildren }}</td>
        <td>{{ number_format($booking->totalPrice, 0, ',', '.') }}</td>
        <td>
            @if ($booking->bookingStatus == 'c')
                <span class="badge badge-danger">Đã hủy</span>
            @elseif ($booking->bookingStatus == 'b')
                <span class="badge badge-warning">Chưa xác nhận</span>
            @elseif ($booking->bookingStatus == 'y')
                <span class="badge badge-primary">Đã xác nhận</span>
            @elseif ($booking->bookingStatus == 'f')
                <span class="badge badge-success">Đã hoàn thành</span>
            @endif
        </td>
        <td>
            @if ($booking->paymentMethod == 'momo-payment')
                <img src="{{ asset('admin/assets/images/icon/icon_momo.png') }}" class="icon_payment" alt="">
            @elseif ($booking->paymentMethod == 'paypal-payment')
                <img src="{{ asset('admin/assets/images/icon/icon_paypal.png') }}" class="icon_payment" alt="">
            @else
                <img src="{{ asset('admin/assets/images/icon/icon_office.png') }}" class="icon_payment" alt="">
            @endif
        </td>
        <td>
            <a href="{{ route('admin.booking-detail', ['id' => $booking->bookingId]) }}"
                class="btn-action-listTours">
                <span class="glyphicon glyphicon-eye-open" style="color: #26B99A; font-size:24px"
                    aria-hidden="true"></span>
            </a>
        </td>
    </tr>
@endforeach