@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />


@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/sizes">Size</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Size</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Size</h4>
                    <form id="add">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" class="form-control" name="name" type="text" />
                        </div>
                        <div class="form-group">
                            <label>Product Type</label>
                            <select id="product_type_id" class="js-example-basic-single w-100">
                                @foreach($product_types as $item)
                                <option value="{{{$item->id}}}">{{{$item->name}}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Submit">
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
                name: $('#name').val(),
                product_type_id: $('#product_type_id').val(),
            };
            showSwal('message-with-auto-close', {
                timer: 60000,
                title: 'Đang tạo kích thước sản phẩm'
            });
            try {
                const response = await axios.post('/api/size', formData);
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