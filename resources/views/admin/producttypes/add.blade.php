@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />


@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../producttypes">Loại sản phẩm</a></li>
        <li class="breadcrumb-item active" aria-current="page">Thêm loại sản phẩm</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thêm loại sản phẩm</h4>
                    <form id="addType">
                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input id="name" class="form-control" name="name" type="text" />
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

        $("#addType").submit(async function(e) {
            e.preventDefault();
            let formData = {
                name: $('#name').val(),
            };
            showSwal('message-with-auto-close', {
                timer: 60000,
                title: 'Đang tạo loại sản phẩm'
            });
            try {
                const response = await axios.post('/api/product_type', formData);
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