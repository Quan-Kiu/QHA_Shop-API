@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />


@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
<<<<<<< HEAD
        <li class="breadcrumb-item"><a href="/product_type">Product Type</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update Product Type</li>
=======
        <<<<<<< HEAD <li class="breadcrumb-item"><a href="/producttypes">Product Type</a></li>
            =======
            <li class="breadcrumb-item"><a href="/colors">Product Type</a></li>
            >>>>>>> 9e9494512a5bd37731d42e9ac35fc630617e2c92
            <li class="breadcrumb-item active" aria-current="page">Update Product Type</li>
>>>>>>> 878690fed5efd3f22364a434b279fae5840fecde
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Product Type</h4>
                    <form id="updateProducttype">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" value="{{{$producttype->name}}}" class="form-control" name="name" type="text" />
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
<<<<<<< HEAD
    var type = @json($producttype);
=======
>>>>>>> 878690fed5efd3f22364a434b279fae5840fecde
    window.onload = () => {
        $("#update").submit(async function(e) {

            e.preventDefault();
            let formData = {
                name: $('#name').val(),
            };
            showSwal('message-with-auto-close', {
                timer: 60000,
                title: 'Đang thay đổi thông tin loại sản phẩm'
            });
            var id = @json($producttype['id']);
            try {
<<<<<<< HEAD
                const response = await axios.put(`/api/product_type/${producttype['id']}`, formData);
=======
                const response = await axios.put(`/api/product_type/${id}`, formData);
>>>>>>> 878690fed5efd3f22364a434b279fae5840fecde
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