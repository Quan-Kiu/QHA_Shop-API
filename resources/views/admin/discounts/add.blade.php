@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />


@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../discounts">Mã giảm giá</a></li>
        <li class="breadcrumb-item active" aria-current="page">Thêm mã giảm giá</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thêm mã giảm giá</h4>
                    <form id="add">
                        <div class="form-group">
                            <label for="code">Mã</label>
                            <input id="code" class="form-control" name="code" type="text" />
                            <label for="price">Giảm giá</label>
                            <input id="price" class="form-control" name="price" type="text" />
                            <label for="drought">Hết hạn sau</label>
                            <select class="form-control" id="drought">
                                <option selected disabled>Chọn</option>
                                <option value="1 hours">1 Giờ</option>
                                <option value="2 hours">2 Giờ</option>
                                <option value="4 hours">4 Giờ</option>
                                <option value="8 hours">8 Giờ</option>
                                <option value="1 days">1 Ngày</option>
                                <option value="2 days">2 Ngày</option>
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
        $("#add").submit(async function(e) {
            e.preventDefault();
            let formData = {
                code: $('#code').val(),
                price: $('#price').val(),
                drought: $('#drought').val(),
            };
            showSwal('message-with-auto-close', {
                timer: 60000,
                title: 'Đang tạo mã giảm giá'
            });
            try {
                const response = await axios.post('/api/discount', formData);
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