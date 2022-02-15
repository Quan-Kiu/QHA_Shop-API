@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />


@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../discounts">Mã giảm giá</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sửa mã giảm giá</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa mã giảm giá</h4>
                    <form id="update">
                        <div class="form-group">
                            <label for="code">Tên</label>
                            <input id="code" value="{{{$discount->code}}}" class="form-control" type="text" />
                        </div>
                        <div class="form-group">
                            <label for="price">Giảm giá</label>
                            <input id="price" value="{{{$discount->price}}}" class="form-control" type="text" />
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
    var discount = @json($discount);
    window.onload = () => {
        $("#update").submit(async function(e) {
            e.preventDefault();
            let formData = {
                code: $('#code').val(),
                price: $('#price').val(),
            };
            showSwal('message-with-auto-close', {
                timer: 60000,
                title: 'Đang cập nhật thông tin màu mã giảm giá'
            });
            try {
                const response = await axios.put(`/api/discount/${discount['id']}`, formData);
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