@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />


@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../orders_status">Trạng thái đơn hàng</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sửa trạng thái đơn hàng</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa trạng thái đơn hàng</h4>
                    <form id="update">
                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input id="name" value="{{{$order_status->name}}}" class="form-control" type="text" />
                        </div>
                        <input class="btn btn-primary" type="submit" value="Sửa">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    var order_status = @json($order_status);
    window.onload = () => {
        $("#update").submit(async function(e) {
            e.preventDefault();
            let formData = {
                name: $('#name').val(),
            };
            showSwal('message-with-auto-close', {
                timer: 60000,
                title: 'Đang cập nhật thông tin màu sản phẩm'
            });
            try {
                const response = await axios.put(`/api/order_status/${order_status['id']}`, formData);
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