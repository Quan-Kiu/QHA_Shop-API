@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />


@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../users">Người dùng</a></li>
        <li class="breadcrumb-item active" aria-current="page">Thêm người dùng</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thêm người dùng</h4>
                    <form id="addUser">
                        <div class="form-group">
                            <label for="fullname">Họ Tên</label>
                            <input id="fullname" class="form-control" name="fullname" type="text" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" class="form-control" name="email" type="email" />
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input id="password" class="form-control" name="password" type="password" />
                        </div>
                        <div class="form-group">
                            <label for="password">Số điện thoại</label>
                            <input id="phone" class="form-control" name="phone" type="text" />
                        </div>
                        <div class="form-group">
                            <label>Loại TK</label>
                            <select id="user_type_id" class="js-example-basic-single w-100">
                                @foreach($user_type as $item)
                                <option value="{{{$item->id}}}">{{{$item->name}}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Thêm">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    window.onload = () => {
        $("#addUser").submit(async function(e) {
            e.preventDefault();
            let formData = {
                email: $('input[name="email"]').val(),
                fullname: $('#fullname').val(),
                address: $('#address').val(),
                phone: $('#phone').val(),
                user_type_id: $('#user_type_id').val(),
                password_confirmation: $('#password').val(),
            };
            showSwal('message-with-auto-close', {
                timer: 60000,
                title: 'Đang tạo tài khoản'
            });
            try {
                const response = await axios.post('/api/register', formData);
                console.log(response.data);
                showSwal('custom-position', {
                    title: 'Thành công',
                })
            } catch (error) {
                showSwal('title-icon-text-footer', {
                    error: error.response.data.message
                });
            }
        }, );
    };
</script>



@push('plugin-scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>

@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
@endpush