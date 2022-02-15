@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />

<link href="{{ asset('assets/plugins/simplemde/simplemde.min.css') }}" rel="stylesheet" />



@endpush

<style>
    .CodeMirror,
    .CodeMirror-scroll {
        min-height: unset !important;
        height: 300px !important;
    }
</style>

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb ">
        <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sửa Sản phẩm</li>
        <li class="breadcrumb-item active" aria-current="page">{{$data['product']->name}}</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Sửa Sản phẩm</h6>


                <form id="update-product">
                    <div class="form-group my-5">
                        <label for="thumbnail">Hình ảnh chính</label>
                        <img class="d-block mr-auto ml-auto my-5" style="width:200px" src="{{{$data['product']->thumbnail}}}" alt="">
                        <input style="border-style: groove;" name="thumbnail" type="file" class="form-control" id="thumbnail">
                    </div>
                    <div class="form-group my-5">
                        <label for="images">Hình ảnh chi tiết</label>
                        <div class="images__list row my-5">
                            @foreach($data['product']->images as $image)
                            <img class="d-block mr-auto ml-auto" style="width:150px" src="{{{$image}}}" alt="">
                            @endforeach
                        </div>
                        <input style="border-style: groove;" name="images[]" type="file" multiple class="form-control" id="images">
                    </div>
                    <div class="form-group">
<<<<<<< HEAD
                        <label for="exampleInputText1">Tên SP</label>
                        <input name="name" value="{{{$data['product']->name}}}" type="text" class="form-control" id="name" value="" placeholder="Tên sản phẩm">
=======
                        <label for="exampleInputText1">Name</label>
                        <input style="border-style: groove;" name="name" value="{{{$data['product']->name}}}" type="text" class="form-control" id="name" value="" placeholder="Enter Name">
>>>>>>> aa2a91ec52ef680bae366e80919e8ec8a1100629
                    </div>
                    <div class="form-group">
                        <label for="images">Thông tin</label>
                        <textarea class="form-control" value="{{{$data['product']->description}}}" name="tinymce" id="simpleMdeExample"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Loại SP</label><br>
                        <select id="product_type_id" class="js-example-basic-single w-100">
                            <option></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Màu SP</label><br>
                        <select id="colors" name="colors[]" class="js-example-basic-multiple w-100" multiple="multiple">
                            <option></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kích cỡ SP</label><br>
                        <select id="sizes" name='sizes[]' class="js-example-basic-multiple w-100" multiple="multiple">
                            <option></option>
                        </select>
                    </div>


                    <div class="form-group">
<<<<<<< HEAD
                        <label for="exampleInputNumber1">Giá thực</label>
                        <input name="price" value="{{{$data['product']->price}}}" type="number" class="form-control" id="price" value="" placeholder="Giá thực">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNumber1">Giá ( giảm giá )</label>
                        <input name="discount" value="{{{$data['product']->discount}}}" type="number" class="form-control" id="discount" value="" placeholder="Giá ( giảm giá )">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword3">Tồn kho</label>
                        <input name="stock" value="{{{$data['product']->stock}}}" type="number" class="form-control" id="stock" value="" placeholder="Tồn kho">
=======
                        <label for="exampleInputNumber1">Price</label>
                        <input style="border-style: groove;" name="price" value="{{{$data['product']->price}}}" type="number" class="form-control" id="price" value="" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNumber1">Discount</label>
                        <input style="border-style: groove;" name="discount" value="{{{$data['product']->discount}}}" type="number" class="form-control" id="discount" value="" placeholder="Enter Sale">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword3">Stock</label>
                        <input style="border-style: groove;" name="stock" value="{{{$data['product']->stock}}}" type="number" class="form-control" id="stock" value="" placeholder="Enter Stock">
>>>>>>> aa2a91ec52ef680bae366e80919e8ec8a1100629
                    </div>


                    <button type="submit" class="btn btn-primary">Chỉnh sửa sản phẩm</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    var app = @json($data);

    window.onload = () => {

        if ($("#simpleMdeExample").length) {
            var simplemde = new SimpleMDE({
                element: $("#simpleMdeExample")[0],
                initialValue: app.product['description'],
            });
        }

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
        })
        $("#product_type_id").val(app.product['product_type_id']);
        $("#product_type_id").select2().trigger('change');

        $("#colors").select2({
            data: colors,
        })
        $("#colors").val(app.product['colors']);
        $("#colors").select2().trigger('change');

        var current_sizes = [];
        sizes.forEach(function(item) {
            if (item.product_type_id == app.product['product_type_id']) {
                current_sizes.push(item);
            }
        })
        if (current_sizes.length > 0) {
            $("#sizes").select2({
                placeholder: 'Chọn loại SP',
                allowClear: true,
                data: current_sizes,
            });

            $("#sizes").val(app.product['sizes']);
            $("#sizes").select2().trigger('change');
        }



        $('#product_type_id').change(function() {
            var value = this.value;
            var current_sizes = [];
            $("#sizes").val([]);
            $("#sizes").select2().trigger('change');
            sizes.forEach(function(item) {
                if (item.product_type_id == value) {
                    current_sizes.push(item);
                }
            })
            if (current_sizes.length > 0) {
                $("#sizes").select2({
                    placeholder: 'Chọn kích cỡ SP',
                    allowClear: true,
                    data: current_sizes,
                });
            }

        })


        $('#update-product').submit(async function(e) {
            e.preventDefault();

            showSwal('message-with-auto-close', {
                timer: 60000,
                title: 'Đang sửa sản phẩm'
            });
            try {


                let formData = {
                    'name': $("#name").val(),
                    'description': $("#simpleMdeExample").val(),
                    'sizes': $("#sizes").val(),
                    'price': $("#price").val(),
                    'stock': $("#stock").val(),
                    'discount': $("#discount").val(),
                    'colors': $("#colors").val(),
                    'product_type_id': $("#product_type_id").val(),

                };

                let mainUrl, imagesUrl = '';
                if ($("#thumbnail").prop('files')[0]) {
                    mainUrl = await uploadPhoto($("#thumbnail").prop('files')[0]);
                }

                if ($("#images").prop('files').length > 0) {
                    imagesUrl = await uploadPhotos($("#images").prop('files'));
                }

                if (mainUrl) {
                    formData.thumbnail = mainUrl;
                }

                if (imagesUrl) {
                    formData.images = imagesUrl;
                }

                const response = await axios.put(`/api/product/${app.product['id']}`, formData);
                showSwal('custom-position', {
                    title: 'Thành công',
                })

                if (mainUrl || imagesUrl) {
                    window.location.reload();
                }


            } catch (error) {
                return showSwal('title-icon-text-footer', {
                    error: error.response.data.message ?? 'Có lỗi xảy ra,vui lòng thử lại'
                });;
            }



        })
    }
</script>

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>

<script src="{{ asset('assets/plugins/simplemde/simplemde.min.js') }}"></script>



@endpush


@push('custom-scripts')
<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>

<script src="{{asset('assets/js/handlePhotoUpload.js')}}"></script>

@endpush