@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />


@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/colors">Size</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update Size</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Size</h4>
                    <form id="update">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" value="{{{$data['size']->name}}}" class="form-control" name="name" type="text" />
                        </div>
                        <div class="form-group">
                            <label>Product Type</label>
                            <select id="product_type_id" class="js-example-basic-single w-100">
                                @foreach($data['product_types'] as $item)
                                @if($data['size']->product_type_id == $item->id)
                                <option selected value="{{{$item->id}}}">{{{$item->name}}}</option>
                                @else
                                <option value="{{{$item->id}}}">{{{$item->name}}}</option>
                                @endif
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
    var size = @json($data['size']);
    window.onload = () => {
        $("#update").submit(async function(e) {
            e.preventDefault();
            let formData = {
                name: $('#name').val(),
                product_type_id: $('#product_type_id').val(),
            };
            showSwal('message-with-auto-close', {
                timer: 60000,
                title: 'Đang cập nhật thông tin màu sản phẩm'
            });
            try {
                const response = await axios.put(`/api/size/${size['id']}`, formData);
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

@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
@endpush