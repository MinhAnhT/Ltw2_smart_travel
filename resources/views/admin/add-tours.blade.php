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
                                                    {{-- THÊM ID VÀO ĐÂY --}}
                                                    <textarea id="descriptionEditor" name="description" class="form-control" rows="8" placeholder="Mô tả chi tiết về tour" required></textarea>
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
                                            <h4>Tải Hình Ảnh Tour (Tối thiểu 5 ảnh)</h4>
                                            <div id="dropzoneContainer" class="dropzone" style="border: 2px dashed #ccc; padding: 30px; text-align: center; cursor: pointer; border-radius: 5px;">
                                                <div class="dz-default dz-message">
                                                    <span>Chọn hình ảnh tour hoặc kéo thả vào đây</span>
                                                </div>
                                            </div>
                                            <div style="margin-top: 20px;">
                                                <button type="button" class="btn btn-primary" onclick="proceedToStep3()()">
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
                                                <button type="button" id="add-timeline-day" class="btn btn-info" style="margin-top: 15px;"><i class="fa fa-plus"></i> Thêm Ngày</button>
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
// Tắt auto-discover của Dropzone
Dropzone.autoDiscover = false;

let tourId = null; // Lưu ID tour sau khi tạo ở bước 1
let uploadedImages = []; // Lưu tên file ảnh đã upload thành công
let dropzone = null; // Lưu instance Dropzone

$(document).ready(function() {
    // 1. Khởi tạo datetimepicker
    $('.datetimepicker').datetimepicker({
        format: 'DD/MM/YYYY',
        useCurrent: false
    }).on('dp.change', function(e) {
        // Tự động render lại timeline nếu đang ở bước 3 khi ngày thay đổi
        if ($('#step3').hasClass('active')) {
             console.log("Date changed, re-rendering timeline in Step 3.");
            renderTimeline();
        }
    });

    // 2. Khởi tạo CKEditor cho Mô tả (Bước 1)
    if ($('#descriptionEditor').length) {
        try {
            CKEDITOR.replace('descriptionEditor');
            console.log("CKEditor for description initialized.");
        } catch (e) {
            console.error("Error initializing CKEditor for description:", e);
        }
    }

    // 3. Khởi tạo Dropzone (Bước 2)
    if ($('#dropzoneContainer').length) {
        try {
            // Hủy instance cũ nếu có
             if (Dropzone.instances.length > 0) {
                 Dropzone.instances.forEach(dz => dz.destroy());
             }

            dropzone = new Dropzone('#dropzoneContainer', {
                url: '{{ route("admin.add-images-tours") }}', // URL upload
                paramName: 'image',          // Tên field gửi file
                maxFilesize: 5,             // Giới hạn dung lượng (MB)
                acceptedFiles: 'image/*',    // Chỉ chấp nhận file ảnh
                addRemoveLinks: true,       // Hiển thị nút xóa
                dictRemoveFile: "Xóa",      // Text nút xóa
                autoProcessQueue: true,     // <-- TỰ ĐỘNG UPLOAD KHI CHỌN FILE
                timeout: 300000,            // Timeout (ms)
                parallelUploads: 5,         // Số file upload cùng lúc
                // maxFiles: 10,            // Giới hạn tổng số file nếu muốn
                headers: {                  // Gửi kèm CSRF Token
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                init: function() {
                    // Sự kiện 'sending': Gửi kèm tourId
                    this.on('sending', function(file, xhr, formData) {
                        console.log('Sending image file:', file.name, 'tourId:', tourId);
                        if (!tourId) {
                            console.error('Lỗi nghiêm trọng: tourId is null khi đang gửi ảnh!');
                            xhr.abort(); // Hủy request
                            this.removeFile(file); // Xóa file khỏi giao diện
                            toastr.error('Lỗi: Chưa lưu tour hoặc tourId không hợp lệ. Không thể tải ảnh.');
                        } else {
                            formData.append('tourId', tourId);
                        }
                    });

                    // Sự kiện 'success': Lưu tên file thành công
                    this.on('success', function(file, response) {
                        console.log('Upload success:', response);
                        if (response.success && response.data && response.data.filename) {
                            // Chỉ thêm nếu chưa tồn tại
                            if (!uploadedImages.includes(response.data.filename)) {
                                 uploadedImages.push(response.data.filename);
                            }
                            file.serverFilename = response.data.filename; // Lưu để xử lý xóa
                            toastr.info('Ảnh ' + file.name + ' tải lên thành công.'); // Dùng info thay vì success
                        } else {
                            this.removeFile(file);
                            toastr.error('Lỗi tải ảnh ' + file.name + ': ' + (response.message || 'Phản hồi không hợp lệ'));
                        }
                    });

                    // Sự kiện 'error': Báo lỗi
                    this.on('error', function(file, message, xhr) {
                        console.error('Upload error:', message, xhr);
                        let errorMsg = "Lỗi không xác định";
                         if (typeof message === "string") { errorMsg = message; }
                         else if (message.message) { errorMsg = message.message; }
                         else if (xhr && xhr.responseJSON && xhr.responseJSON.message) { errorMsg = xhr.responseJSON.message; }
                        $(file.previewElement).find('.dz-error-message').text(errorMsg);
                        toastr.error('Lỗi tải ảnh ' + file.name);
                    });

                    // Sự kiện 'removedfile': Xóa khỏi mảng và tùy chọn xóa trên server
                    this.on('removedfile', function(file) {
                        console.log("Removed file:", file.name);
                        if (file.serverFilename) {
                            // Xóa khỏi mảng JS
                            uploadedImages = uploadedImages.filter(imgName => imgName !== file.serverFilename);
                             // TÙY CHỌN: Gọi AJAX để xóa file trên server/DB nếu cần
                             // $.post('{{-- route("admin.delete-tour-image") --}}', { filename: file.serverFilename, tourId: tourId, _token: '...' });
                        }
                    });
                }
            });
        } catch (e) {
            console.error("Error initializing Dropzone:", e);
            alert("Không thể khởi tạo khu vực tải ảnh!");
        }
    } else {
        console.warn("Dropzone container '#dropzoneContainer' not found.");
    }

}); // <-- Kết thúc $(document).ready()

// --- CÁC HÀM XỬ LÝ CHO TỪNG BƯỚC ---

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
        description: '', // Sẽ lấy từ CKEditor
        _token: $('#formStep1 input[name="_token"]').val() // Lấy token từ form step 1
    };

    // Lấy nội dung từ CKEditor
    if (CKEDITOR.instances.descriptionEditor) {
         data.description = CKEDITOR.instances.descriptionEditor.getData();
    } else {
         toastr.error('Lỗi: Không tìm thấy trình soạn thảo Mô tả!');
         return; // Dừng nếu CKEditor lỗi
    }


    // Kiểm tra validation đơn giản (có thể dùng HTML5 validation tốt hơn)
    let isValid = true;
    for (const key in data) {
        if (key !== '_token' && (!data[key] || (typeof data[key] === 'string' && data[key].trim() === ''))) {
             // Đánh dấu field lỗi
             $(`[name="${key}"]`).closest('.form-group').addClass('has-error'); // Thêm class lỗi
             isValid = false;
        } else {
             $(`[name="${key}"]`).closest('.form-group').removeClass('has-error');
        }
    }
     // Báo lỗi CKEditor riêng
     if (!data.description || data.description.trim() === '') {
         $('#cke_descriptionEditor').addClass('has-error-cke'); // Thêm class lỗi cho editor
         isValid = false;
     } else {
          $('#cke_descriptionEditor').removeClass('has-error-cke');
     }

    if (!isValid) {
        toastr.error('Vui lòng điền đầy đủ tất cả các trường bắt buộc!');
        // Cuộn lên trường lỗi đầu tiên nếu cần
         $('.has-error, .has-error-cke').first().find('input, select, textarea').focus();
        return;
    }

    // Gửi AJAX
    $.ajax({
        url: '{{ route("admin.add-tours") }}',
        type: 'POST',
        data: data,
        success: function(response) {
            if (response.success) {
                tourId = response.tourId; // Lưu tourId toàn cục
                $('input.tourId').val(tourId); // Cập nhật input ẩn ở Step 3
                console.log('Tour saved with ID:', tourId);
                toastr.success('Lưu thông tin tour thành công! Chuyển sang bước tải ảnh.');
                // Tự động chuyển sang tab Step 2
                $('a[href="#step2"]').tab('show'); // Kích hoạt tab Step 2
            } else {
                toastr.error('Lỗi khi lưu tour: ' + (response.message || 'Lỗi không xác định'));
            }
        },
        error: function(xhr) {
            console.error('Save step 1 error:', xhr);
            let errorMsg = 'Lỗi AJAX khi lưu tour!';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                 errorMsg += "\n" + xhr.responseJSON.message;
            }
            toastr.error(errorMsg);
        }
    });
}

// STEP 2: Chuyển sang Bước 3 (Nút "Tiếp Tục Step 3")
function proceedToStep3() { // Đổi tên hàm
    if (!tourId) {
        toastr.error('Vui lòng lưu thông tin tour ở Bước 1 trước!');
        $('a[href="#step1"]').tab('show'); // Quay lại bước 1
        return;
    }

    // Kiểm tra số lượng ảnh đã upload THÀNH CÔNG
    const successfulUploads = uploadedImages.length;
    const minImages = 5; // Số ảnh tối thiểu

    if (successfulUploads < minImages) {
        toastr.error(`Cần ít nhất ${minImages} ảnh được tải lên thành công! Hiện tại có: ${successfulUploads} ảnh.`);
        // Quyết định: Có chặn chuyển bước không? => Nên chặn
         return; // Chặn không cho chuyển bước
    }

    console.log('Proceeding to step 3. Successful uploads:', successfulUploads);
    renderTimeline(); // Gọi hàm render timeline trước khi chuyển tab
    $('a[href="#step3"]').tab('show'); // Chuyển sang tab Step 3
}

// STEP 3: Render giao diện lộ trình
function renderTimeline() {
    if (!tourId) {
        console.error("renderTimeline called but tourId is null!");
        $('#timelineContainer').html('<p class="text-danger">Lỗi: Chưa lưu thông tin tour ở Bước 1.</p>');
        return;
    }
    console.log("Rendering timeline for tourId:", tourId);

    // Lấy ngày tháng TỪ INPUT (có thể đã thay đổi)
    let startDateStr = $('input[name="start_date"]').val();
    let endDateStr = $('input[name="end_date"]').val();
    console.log("Start Date Str:", startDateStr, "End Date Str:", endDateStr);

    let startDate = moment(startDateStr, 'DD/MM/YYYY');
    let endDate = moment(endDateStr, 'DD/MM/YYYY');

    // Kiểm tra ngày hợp lệ
    if (!startDate.isValid() || !endDate.isValid() || endDate.isBefore(startDate)) {
        console.warn("Invalid date range for timeline. Start:", startDateStr, "End:", endDateStr);
        $('#timelineContainer').html('<p class="text-warning">Vui lòng chọn ngày khởi hành và kết thúc hợp lệ ở Bước 1.</p>');
        return;
    }

    let days = endDate.diff(startDate, 'days') + 1;
    console.log("Calculated days:", days);

    if (days <= 0) {
        console.warn("Calculated days is zero or negative.");
        $('#timelineContainer').html('<p class="text-warning">Số ngày tính được không hợp lệ.</p>');
        return;
    }

    // --- Xây dựng HTML ---
    let html = '';
    for (let i = 1; i <= days; i++) {
        let editorId = `timeline-content-${i}`; // ID duy nhất
        html += `
            <div class="panel panel-default timeline-entry" style="margin-bottom: 15px;" data-day="${i}">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <a data-toggle="collapse" href="#collapse-day-${i}">Ngày ${i}</a>
                        <button type="button" class="btn btn-danger btn-xs pull-right remove-timeline-entry" title="Xóa ngày này">
                             <i class="fa fa-trash"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapse-day-${i}" class="panel-collapse collapse in"> {{-- Mặc định mở --}}
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tiêu Đề Ngày ${i} <span style="color:red;">*</span></label>
                            <input type="text" class="form-control day-title" data-day="${i}"
                                   placeholder="Ví dụ: Hà Nội - Hạ Long (Ăn sáng, trưa, tối)" required>
                        </div>
                        <div class="form-group">
                            <label>Nội Dung Ngày ${i} <span style="color:red;">*</span></label>
                            <textarea id="${editorId}" class="form-control day-content" data-day="${i}"
                                      rows="4" placeholder="Mô tả chi tiết lộ trình ngày ${i}" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Gán HTML vào container
    $('#timelineContainer').html(html);
    console.log("Timeline HTML rendered.");

    // --- Khởi tạo CKEditor ---
    let ckeditorInitSuccess = true;
    $('#timelineContainer .day-content').each(function() {
        let editorId = $(this).attr('id');
        if (CKEDITOR.instances[editorId]) {
            try { CKEDITOR.instances[editorId].destroy(true); }
            catch (e) { console.warn(`Could not destroy existing CKEditor ${editorId}:`, e); }
        }
        try {
            CKEDITOR.replace(editorId);
        } catch (e) {
            console.error(`Error initializing CKEditor for ${editorId}:`, e);
            ckeditorInitSuccess = false;
        }
    });

    if(ckeditorInitSuccess) {
         console.log("All CKEditor instances for timeline initialized (or attempted).");
    } else {
         console.error("Errors occurred initializing timeline CKEditor instances.");
    }
}

// --- Xử lý Nút Xóa Ngày ---
$('#timelineContainer').on('click', '.remove-timeline-entry', function() {
     const entryToRemove = $(this).closest('.timeline-entry');
     const editorId = entryToRemove.find('.day-content').attr('id');

     // Hủy CKEditor trước khi xóa HTML
     if (CKEDITOR.instances[editorId]) {
         try { CKEDITOR.instances[editorId].destroy(true); }
         catch (e) { console.warn(`Could not destroy CKEditor ${editorId} on remove:`, e); }
     }

     entryToRemove.remove();
     console.log(`Removed timeline entry for day (original day number might differ if renumbered).`);
     // TÙY CHỌN: Gọi hàm đánh số lại ngày nếu bạn muốn
     // updateTimelineDayNumbers();
});


// STEP 3: Lưu tour hoàn chỉnh (Nút "Hoàn thành")
function submitTour() {
    if (!tourId) {
        toastr.error('Lỗi nghiêm trọng: Không có tour ID!');
        return;
    }

    let timelineData = [];
    let isTimelineValid = true;

    // Lấy dữ liệu timeline từ các input và CKEditor
    $('#timelineContainer .timeline-entry').each(function() {
        let day = $(this).data('day'); // Lấy số ngày gốc (quan trọng nếu không đánh số lại)
        let title = $(this).find('.day-title').val();
        let editorId = $(this).find('.day-content').attr('id');
        let content = '';

        if (CKEDITOR.instances[editorId]) {
            content = CKEDITOR.instances[editorId].getData();
        } else {
             content = $(`#${editorId}`).val();
             console.warn(`CKEditor instance ${editorId} not found when submitting!`);
        }

        // Validate
        if (!title || title.trim() === '') {
             toastr.error(`Vui lòng nhập Tiêu đề cho Ngày ${day}`);
             isTimelineValid = false; return false;
        }
         if (!content || content.trim() === '') {
             toastr.error(`Vui lòng nhập Nội dung cho Ngày ${day}`);
             isTimelineValid = false; return false;
        }

        timelineData.push({
            dayNumber: day, // Gửi số ngày gốc
            title: title,
            content: content
        });
    });

    if (!isTimelineValid) return; // Dừng nếu validation fail

    if (timelineData.length === 0) {
        toastr.error('Vui lòng nhập lộ trình cho ít nhất một ngày!');
        return;
    }

    // Kiểm tra lại số lượng ảnh đã upload thành công
     if (uploadedImages.length < 5) {
         toastr.error('Cần ít nhất 5 ảnh được tải lên thành công!');
         $('a[href="#step2"]').tab('show'); // Chuyển về tab ảnh
         return;
     }

    console.log('Submitting final tour data:', {tourId, timelineData});

    // Dữ liệu gửi đi (không cần FormData, không cần gửi lại uploadedImages)
     let finalData = {
         tourId: tourId,
         timelines: JSON.stringify(timelineData), // Gửi JSON string
         _token: $('#formStep3 input[name="_token"]').val() // Lấy token từ form step 3
     };

    // Gửi AJAX để lưu timeline và cập nhật tour thành 'active'
    $.ajax({
        url: '{{ route("admin.add-timeline") }}',
        type: 'POST',
        data: finalData,
        success: function(response) {
            console.log('Final submit response:', response);
            if (response.success) {
                toastr.success('Tour đã được thêm thành công!');
                // Chuyển hướng về trang danh sách tour
                window.location.href = '{{ route("admin.tours") }}';
            } else {
                toastr.error('Lỗi khi hoàn tất tour: ' + (response.message || 'Lỗi không xác định'));
            }
        },
        error: function(xhr) {
            console.error('Final submit error:', xhr);
             let errorMsg = 'Lỗi AJAX khi hoàn tất tour!';
             if (xhr.responseJSON && xhr.responseJSON.message) {
                  errorMsg += "\n" + xhr.responseJSON.message;
             }
            toastr.error(errorMsg);
        }
    });
}
</script>