@extends('layout.master')
@cloudinaryJS
@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />

@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb ">
        <li class="breadcrumb-item"><a href="#">Product</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">ADD PRODUCT</h6>


                <form id="add-product">
                    <div class="form-group">
                        <label for="thumbnail">Main Image</label>
                        <input name="thumbnail" type="file" class="form-control" id="thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="images">Images</label>
                        <input name="images[]" type="file" multiple class="form-control" id="images">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText1">Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText1">Description</label>
                        <input name="description" type="text" class="form-control" id="description" value="" placeholder="Enter Description">
                    </div>
                    <div class="form-group">
                        <label>Product Type</label><br>
                        <select id="product_type_id" class="js-example-basic-single w-100">
                            <option></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Colors</label><br>
                        <select id="colors" name="colors[]" class="js-example-basic-multiple w-100" multiple="multiple">
                            <option></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Sizes</label><br>
                        <select disabled id="sizes" name='sizes[]' class="js-example-basic-multiple w-100" multiple="multiple">
                            <option></option>

                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputNumber1">Price</label>
                        <input name="price" type="number" class="form-control" id="price" value="" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNumber1">Discount</label>
                        <input name="discount" type="number" class="form-control" id="discount" value="" placeholder="Enter Sale">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword3">Stock</label>
                        <input name="stock" type="number" class="form-control" id="stock" value="" placeholder="Enter Stock">
                    </div>


                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    var app = @json($data);


    window.onload = () => {


        var product_type_id = $.map(app.product_types, function(obj) {
            obj.text = obj.text || obj.name;
            return obj;
        });
        var sizes = $.map(app.sizes, function(obj) {
            obj.text = obj.text || obj.name;
            obj.id = obj.text || obj.name;
            return obj;
        });

        var colors = $.map(app.colors, function(obj) {
            obj.text = obj.text || obj.name;
            obj.id = obj.text || obj.name;
            return obj;
        });


        $("#product_type_id").select2({
            data: product_type_id,
            placeholder: 'Select product type',
            allowClear: true
        })
        $("#colors").select2({
            placeholder: 'Select product color',
            data: colors,
            allowClear: true
        })
        $("#sizes").select2({
            placeholder: 'Select product size',
            allowClear: true
        })

        $('#add-product').submit(async function(e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('thumbnail', $("#thumbnail").prop('files')[0]);
            for (let index = 0; index < $("#images").prop('files').length; index++) {
                formData.append(`images${index}`, $("#images").prop('files')[index]);
            }
            formData.append('name', $("#name").val());
            formData.append('description', $("#description").val());
            formData.append('sizes', $("#sizes").val());
            formData.append('price', $("#price").val());
            formData.append('stock', $("#stock").val());
            formData.append('discount', $("#discount").val());
            formData.append('colors', $("#colors").val());
            formData.append('product_type_id', $("#product_type_id").val());

            showSwal('message-with-auto-close', {
                timer: 60000,
                title: 'Đang tạo sản phẩm'
            });
            try {
                const response = await axios.post('/api/product', formData);
                showSwal('custom-position', {
                    title: 'Thành công',
                })
            } catch (error) {
                showSwal('title-icon-text-footer', {
                    error: error.response.data.message
                });
            }

        })

        $('#product_type_id').change(function() {
            var value = this.value;
            var current_sizes = [];
            sizes.forEach(function(item) {
                if (item.product_type_id == value) {
                    current_sizes.push(item);
                }
            })
            if (current_sizes.length > 0) {
                $("#sizes").select2({
                    placeholder: 'Select product size',
                    allowClear: true,
                    disabled: false,
                    data: current_sizes,
                });
            } else {
                $("#sizes").select2({
                    disabled: true,
                });
            }

        })
    };
</script>

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>


@endpush

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/select2.js') }}"></script>
<script src="{{ asset('assets/js/dropzone.js') }}"></script>


@endpush