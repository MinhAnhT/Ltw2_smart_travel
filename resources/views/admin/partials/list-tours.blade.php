
@foreach ($tours as $tour)
    <tr>
        <td>{{ $tour->title }}</td>
        <td>{{ $tour->time }}</td>
        <td>{!! Str::limit($tour->description, 50) !!}</td>
        <td>{{ $tour->quantity }}</td>
        <td>{{ number_format($tour->priceAdult, 0, ',', '.') }}</td>
        <td>{{ number_format($tour->priceChild, 0, ',', '.') }}</td>
        <td>{{ $tour->destination }}</td>
        <td>
            @if ($tour->availability == 1)
                <span class="badge badge-success">Hoạt động</span>
            @else
                <span class="badge badge-danger">Bản nháp</span>
            @endif
        </td>
        <td>{{ date('d-m-Y', strtotime($tour->startDate)) }}</td>
        <td>{{ date('d-m-Y', strtotime($tour->endDate)) }}</td>
        <td>
            {{-- Thêm data-tourid và data-urledit cho JavaScript --}}
            <button type="button" class="btn-action-listTours edit-tour"
                    data-tourid="{{ $tour->tourId }}"
                    data-urledit="{{ route('admin.tour-edit', ['tourId' => $tour->tourId]) }}">
                <span class="glyphicon glyphicon-edit" style="color: #26B99A; font-size:24px" aria-hidden="true"></span>
            </button>
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-danger delete-tour"
                    data-tourid="{{ $tour->tourId }}"
                    data-url="{{ route('admin.delete-tour') }}"> {{-- <-- Đảm bảo có dòng này --}}
                Xóa
            </button>
        </td>
    </tr>
@endforeach