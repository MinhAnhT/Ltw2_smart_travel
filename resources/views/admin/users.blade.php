@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Quản lý người dùng</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Go!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="x_panel">
                    <div class="x_content row">
                        @foreach ($users as $user)
                            <div class="col-md-4 col-sm-4  profile_details">
                                <div class="well profile_view">
                                    
                                    {{-- PHẦN BỊ MẤT ĐÃ ĐƯỢC KHÔI PHỤC --}}
                                    <div class="col-sm-12">
                                        {{-- Hiển thị trạng thái đã sửa từ controller --}}
                                        <h4 class="brief"><i>{{ $user->statusText }}</i></h4>
                                        <div class="left col-md-7 col-sm-7">
                                            <h2>{{ $user->fullname }}</h2>
                                            <p><strong>About: </strong> {{ $user->username }} </p>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-building"></i> Address: {{ $user->address }}</li>
                                                <li><i class="fa fa-phone"></i> Phone #: {{ $user->phone }}</li>
                                            </ul>
                                        </div>
                                        <div class="right col-md-5 col-sm-5 text-center">
                                            <img src="{{ asset('admin/assets/images/user-profile/' . $user->avatar) }}"
                                                alt="" class="img-circle img-fluid">
                                        </div>
                                    </div>
                                    {{-- KẾT THÚC PHẦN BỊ MẤT --}}

                                    <div class=" profile-bottom text-center">
                                        {{-- PHẦN NÚT BẤM ĐÃ SỬA DÙNG CLASS --}}
                                        <div class=" col-sm-12 emphasis" style="display: flex; justify-content: end">
    
                                            <button type="button" class="btn btn-primary btn-sm btn-active"
                                                data-attr='{"userId": "{{ $user->userId }}", "action": "{{ route('admin.active-user') }}"}'
                                                style="{{ $user->isActive !== 'n' ? 'display: none;' : '' }}">
                                                <i class="fa fa-check"> </i> Kích hoạt
                                            </button>
                                
                                            <button type="button" class="btn btn-primary btn-warning btn-ban"
                                                data-attr='{"userId": "{{ $user->userId }}", "action": "{{ route('admin.status-user') }}", "status": "b"}'
                                                style="{{ $user->isActive === 'b' || $user->isActive === 'd' ? 'display: none;' : '' }}">
                                                <i class="fa fa-ban"> </i> Chặn
                                            </button>
                                
                                            <button type="button" class="btn btn-primary btn-warning btn-unban"
                                                data-attr='{"userId": "{{ $user->userId }}", "action": "{{ route('admin.status-user') }}", "status": "n"}'
                                                style="{{ $user->isActive !== 'b' ? 'display: none;' : '' }}">
                                                <i class="fa fa-ban"> </i> Bỏ chặn
                                            </button>
                                
                                            <button type="button" class="btn btn-primary btn-danger btn-delete"
                                                data-attr='{"userId": "{{ $user->userId }}", "action": "{{ route('admin.status-user') }}", "status": "d"}'
                                                style="{{ $user->isActive === 'd' ? 'display: none;' : '' }}">
                                                <i class="fa fa-close"> </i> Xóa
                                            </button>
                                
                                            <button type="button" class="btn btn-primary btn-danger btn-restore"
                                                data-attr='{"userId": "{{ $user->userId }}", "action": "{{ route('admin.status-user') }}", "status": "n"}'
                                                style="{{ $user->isActive !== 'd' ? 'display: none;' : '' }}">
                                                <i class="fa fa-close"> </i> Khôi phục
                                            </button>
                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
@include('admin.blocks.footer')