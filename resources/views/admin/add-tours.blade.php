@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Thêm Tours</h3>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Form Thêm Tour</h2>
                            </div>
                            <div class="x_content">

                                <!-- TAB NAVIGATION -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#step1" aria-controls="step1" role="tab" data-toggle="tab">
                                            <span class="badge badge-primary">1</span> Thông Tin Tour
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#step2" aria-controls="step2" role="tab" data-toggle="tab">
                                            <span class="badge badge-secondary">2</span> Hình Ảnh
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#step3" aria-controls="step3" role="tab" data-toggle="tab">
                                            <span class="badge badge-secondary">3</span> Lộ Trình
                                        </a>
                                    </li>
                                </ul>

                                <!-- TAB CONTENT -->
                                <div class="tab-content">
                                    
                                    <!-- STEP 1: THÔNG TIN TOUR -->
                                    <div role="tabpanel" class="tab-pane active" id="step1">
                                        <div style="padding: 20px;">
                                            <form id="formStep1">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Tên Tour <span style="color:red;">*</span></label>
                                                    <input type="text" name="name" class="form-control" placeholder="Nhập tên tour" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Điểm Đến <span style="color:red;">*</span></label>
                                                    <input type="text" name="destination" class="form-control" placeholder="Ví dụ: Hà Nội - Hạ Long" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Khu Vực <span style="color:red;">*</span></label>
                                                    <select name="domain" class="form-control" required>
                                                        <option value="">Chọn khu vực</option>
                                                        <option value="b">Miền Bắc</option>
                                                        <option value="t">Miền Trung</option>
                                                        <option value="n">Miền Nam</option>
                                                    </select>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Số Lượng <span style="color:red;">*</span></label>
                                                            <input type="number" name="number" class="form-control" placeholder="Số người" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Giá Người Lớn <span style="color:red;">*</span></label>
                                                            <input type="number" name="price_adult" class="form-control" placeholder="VND" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Giá Trẻ Em <span style="color:red;">*</span></label>
                                                            <input type="number" name="price_child" class="form-control" placeholder="VND" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Ngày Khởi Hành <span style="color:red;">*</span></label>
                                                            <input type="text" name="start_date" class="form-control datetimepicker" placeholder="DD/MM/YYYY" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Ngày Kết Thúc <span style="color:red;">*</span></label>
                                                            <input type="text" name="end_date" class="form-control datetimepicker" placeholder="DD/MM/YYYY" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Mô Tả <span style="color:red;">*</span></label>
                                                    <textarea name="description" class="form-control" rows="8" placeholder="Mô tả chi tiết về tour" required></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary" onclick="saveStep1()">
                                                        <i class="fa fa-save"></i> Lưu & Tiếp Tục
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- STEP 2: HÌNH ẢNH -->
                                    <div role="tabpanel" class="tab-pane" id="step2">
                                        <div style="padding: 20px;">
                                            <h4>Tải Hình Ảnh Tour</h4>
                                            <div id="dropzoneContainer" class="dropzone" style="border: 2px dashed #ccc; padding: 30px; text-align: center; cursor: pointer; border-radius: 5px;">
                                                <div class="dz-default dz-message">
                                                    <span>Chọn hình ảnh tour hoặc kéo thả vào đây</span>
                                                </div>
                                            </div>
                                            <div style="margin-top: 20px;">
                                                <button type="button" class="btn btn-primary" onclick="goToStep3()">
                                                    <i class="fa fa-arrow-right"></i> Tiếp Tục Step 3
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- STEP 3: LỘ TRÌNH -->
                                    <div role="tabpanel" class="tab-pane" id="step3">
                                        <div style="padding: 20px;">
                                            <h4>Nhập Lộ Trình Tour</h4>
                                            <form id="formStep3">
                                                @csrf
                                                <input type="hidden" name="tourId" class="tourId">
                                                <div id="timelineContainer">
                                                    <!-- Timeline sẽ được thêm vào đây bằng JavaScript -->
                                                </div>
                                                <div class="form-group" style="margin-top: 20px;">
                                                    <button type="button" class="btn btn-success" onclick="submitTour()">
                                                        <i class="fa fa-check"></i> Hoàn Thành
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
    </div>
</div>

@include('admin.blocks.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">

<script>
let tourId = null;
let uploadedImages = [];
let dropzone = null;

// Tắt auto-discover của Dropzone
Dropzone.autoDiscover = false;

$(document).ready(function() {
    // Khởi tạo datetimepicker
    $('.datetimepicker').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    // Khởi tạo Dropzone sau khi DOM sẵn sàng
    dropzone = new Dropzone('#dropzoneContainer', {
        url: '{{ route("admin.add-images-tours") }}',
        paramName: 'image',
        maxFilesize: 5,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        autoProcessQueue: false,
        timeout: 300000
    });

    dropzone.on('sending', function(file, xhr, formData) {
        console.log('Sending image file:', file.name, 'tourId:', tourId);
        if (!tourId) {
            console.error('tourId is null');
            alert('Lỗi: Chưa lưu tour!');
            return false;
        }
        formData.append('tourId', tourId);
        let token = $('meta[name="csrf-token"]').attr('content');
        if (!token) {
            token = $('input[name="_token"]').first().val();
        }
        console.log('Token:', token);
        formData.append('_token', token);
    });

    dropzone.on('success', function(file, response) {
        console.log('Upload success:', response);
        if (response.success) {
            uploadedImages.push(response.data.filename);
            alert('Ảnh tải lên thành công!');
        }
    });

    dropzone.on('error', function(file, msg, xhr) {
        console.error('Upload error:', msg, xhr);
        alert('Lỗi tải ảnh: ' + msg);
    });
});

// STEP 1: Lưu thông tin tour
function saveStep1() {
    let data = {
        name: $('input[name="name"]').val(),
        destination: $('input[name="destination"]').val(),
        domain: $('select[name="domain"]').val(),
        number: $('input[name="number"]').val(),
        price_adult: $('input[name="price_adult"]').val(),
        price_child: $('input[name="price_child"]').val(),
        start_date: $('input[name="start_date"]').val(),
        end_date: $('input[name="end_date"]').val(),
        description: $('textarea[name="description"]').val(),
        _token: $('input[name="_token"]').val()
    };

    // Kiểm tra validation
    if (!data.name || !data.destination || !data.domain || !data.number || 
        !data.price_adult || !data.price_child || !data.start_date || 
        !data.end_date || !data.description) {
        alert('Vui lòng điền đầy đủ tất cả các trường!');
        return;
    }

    $.ajax({
        url: '{{ route("admin.add-tours") }}',
        type: 'POST',
        data: data,
        success: function(response) {
            if (response.success) {
                tourId = response.tourId;
                $('input.tourId').val(tourId);
                console.log('Tour saved with ID:', tourId);
                alert('Lưu thông tin tour thành công! ID: ' + tourId);
                $('#step2-tab').tab('show');
            } else {
                alert('Lỗi: ' + response.message);
            }
        },
        error: function(err) {
            console.error('Save error:', err);
            alert('Lỗi khi lưu tour!');
        }
    });
}

// STEP 2: Tải hình ảnh
function goToStep3() {
    if (!tourId) {
        alert('Vui lòng lưu thông tin tour trước!');
        return;
    }

    let files = dropzone.getQueuedFiles();
    console.log('Files queued:', files.length);

    if (files.length > 0) {
        console.log('Processing uploads...');
        dropzone.processQueue();
        // Đợi một chút để upload hoàn thành
        setTimeout(function() {
            renderTimeline();
            $('#step3-tab').tab('show');
        }, 3000);
    } else {
        console.log('No files, moving to step 3');
        renderTimeline();
        $('#step3-tab').tab('show');
    }
}

// STEP 3: Render lộ trình
function renderTimeline() {
    if (!tourId) return;

    let startDate = moment($('input[name="start_date"]').val(), 'DD/MM/YYYY');
    let endDate = moment($('input[name="end_date"]').val(), 'DD/MM/YYYY');
    let days = endDate.diff(startDate, 'days') + 1;

    if (days <= 0) days = 1;

    let html = '';
    for (let i = 1; i <= days; i++) {
        html += `
            <div class="panel panel-default" style="margin-bottom: 15px;">
                <div class="panel-heading">
                    <h5>Ngày ${i}</h5>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Tiêu Đề Ngày ${i} <span style="color:red;">*</span></label>
                        <input type="text" class="form-control day-title" data-day="${i}" 
                               placeholder="Ví dụ: Hà Nội - Hạ Long (Ăn sáng, trưa, tối)" required>
                    </div>
                    <div class="form-group">
                        <label>Nội Dung Ngày ${i} <span style="color:red;">*</span></label>
                        <textarea class="form-control day-content" data-day="${i}" 
                                  rows="4" placeholder="Mô tả chi tiết lộ trình ngày ${i}" required></textarea>
                    </div>
                </div>
            </div>
        `;
    }

    $('#timelineContainer').html(html);
}

// Lưu tour hoàn chỉnh
function submitTour() {
    if (!tourId) {
        alert('Lỗi: Không có tour ID!');
        return;
    }

    let timelineData = [];

    // Collect timeline data
    $('.day-title').each(function() {
        let day = $(this).data('day');
        let title = $(this).val();
        let content = $(`.day-content[data-day="${day}"]`).val();

        if (title && content) {
            timelineData.push({
                dayNumber: day,
                title: title,
                content: content
            });
        }
    });

    if (timelineData.length === 0) {
        alert('Vui lòng nhập lộ trình cho ít nhất một ngày!');
        return;
    }

    console.log('Submitting tour:', {tourId, timelineData, uploadedImages});

    let formData = new FormData();
    formData.append('tourId', tourId);
    formData.append('timelines', JSON.stringify(timelineData));
    formData.append('images', JSON.stringify(uploadedImages));
    formData.append('_token', $('input[name="_token"]').first().val());

    $.ajax({
        url: '{{ route("admin.add-timeline") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log('Tour submitted successfully:', response);
            if (response.success) {
                alert('Tour đã được thêm thành công!');
                window.location.href = '{{ route("admin.tours") }}';
            } else {
                alert('Lỗi: ' + response.message);
            }
        },
        error: function(err) {
            console.error('Submit error:', err);
            alert('Lỗi khi thêm tour!');
        }
    });
}
</script>