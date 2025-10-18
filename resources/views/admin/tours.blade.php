@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Quản lý <small>Tours</small></h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Tours</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-box table-responsive">
                                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Tiêu đề</th>
                                                        <th>Thời gian</th>
                                                        <th>Mô tả</th>
                                                        <th>Số lượng</th>
                                                        <th>Giá người lớn</th>
                                                        <th>Giá trẻ em</th>
                                                        <th>Địa điểm</th>
                                                        <th>Trạng thái</th>
                                                        <th>Ngày đi</th>
                                                        <th>Ngày về</th>
                                                        <th>Sửa</th>
                                                        <th>Xóa</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody-listTours">
                                                    @include('admin.partials.list-tours', ['tours' => $tours])
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.blocks.footer')
    </div>
</div>

{{-- MODAL CHỈNH SỬA TOUR ĐẦY ĐỦ --}}
<div class="modal fade" id="edit-tour-modal" tabindex="-1" role="dialog" 
     aria-labelledby="editTourModalLabel" aria-hidden="true"
     data-update-url="{{ route('admin.edit-tour') }}"> {{-- <-- THÊM THUỘC TÍNH NÀY --}}
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa Tour</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- SmartWizard -->
                <div id="wizard" class="form_wizard wizard_horizontal">
                    <ul class="wizard_steps">
                        <li>
                            <a href="#step-1">
                                <span class="step_no">1</span>
                                <span class="step_descr">Bước 1<br /><small>Thông tin Tour</small></span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-2">
                                <span class="step_no">2</span>
                                <span class="step_descr">Bước 2<br /><small>Ảnh Tour</small></span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-3">
                                <span class="step_no">3</span>
                                <span class="step_descr">Bước 3<br /><small>Lộ trình</small></span>
                            </a>
                        </li>
                    </ul>

                    <!-- STEP 1: Thông tin Tour -->
                    <div id="step-1">
                        <form id="form-step1" class="form-horizontal form-label-left">
                            @csrf
                            <input type="hidden" name="tourId">

                            <div class="form-group row">
                                <label class="col-form-label col-md-3">Tiêu đề <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3">Thời gian</label>
                                <div class="col-md-9">
                                    {{-- Thêm 'readonly' để người dùng không sửa tay được --}}
                                    <input type="text" class="form-control" name="time" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3">Điểm đến <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="destination" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3">Khu vực <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control" id="domain" name="domain" required>
                                        <option value="">Chọn khu vực</option>
                                        <option value="n">Miền Nam</option>
                                        <option value="b">Miền Bắc</option>
                                        <option value="t">Miền Trung</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3">Số lượng <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="number" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3">Giá người lớn <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="price_adult" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3">Giá trẻ em <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="price_child" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3">Ngày đi <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="start_date" name="start_date" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3">Ngày về <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="end_date" name="end_date" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3">Mô tả <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <textarea id="description" name="description" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- STEP 2: Upload Ảnh -->
                    <div id="step-2">
                        <h4>Tải lên ảnh cho Tour (Tối thiểu 5 ảnh)</h4>
                        <form action="{{ route('admin.add-images-tours') }}" 
                              class="dropzone" 
                              enctype="multipart/form-data"
                              id="myDropzone-listTour" 
                                >
                            @csrf
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form>
                    </div>

                    <!-- STEP 3: Lộ trình -->
                    <div id="step-3">
                        <h4>Lộ trình Tour</h4>
                        <form id="timeline-form" action="{{ route('admin.edit-tour') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tourId" id="timeline_tourId">
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
{{-- KẾT THÚC MODAL --}}

{{-- ❌ XÓA DÒNG NÀY - jQuery đã được load trong header --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

<script>
$(document).ready(function() {
    
    // XỬ LÝ NÚT XÓA TOUR
    $('body').on('click', '.delete-tour', function(e) {
        e.preventDefault();
        var tourId = $(this).data('tourid');
        
        if (confirm('Bạn có chắc chắn muốn xóa tour này không?')) {
            $.ajax({
                url: "{{ route('admin.delete-tour') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    tourId: tourId
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        $('#tbody-listTours').html(response.data);
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Đã xảy ra lỗi trong quá trình xóa.');
                }
            });
        }
    });
    
   
});
</script>