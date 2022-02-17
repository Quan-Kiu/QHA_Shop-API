@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="css/inputmydesign.css">
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
        <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">thêm sản phẩm</h6>

                    <div class="form-group">
                        <label for="thumbnail">Hình ảnh chính</label>
                        <input name="thumbnail" type="file" class="form-control" id="thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="images">Hình ảnh chi tiết</label>
                        <input name="images[]" type="file" multiple class="form-control" id="images">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText1">Tên SP</label>
                        <input name="name" type="text" class="form-control" id="name" value="" placeholder="Tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="images">Thông tin</label>
                        <textarea class="form-control" name="tinymce" id="simpleMdeExample"></textarea>
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
                        <label>Kích cớ SP</label><br>
                        <select disabled id="sizes" name='sizes[]' class="js-example-basic-multiple w-100" multiple="multiple">
                            <option></option>

                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputNumber1">Giá thực</label>
                        <input name="price" type="number" class="form-control" id="price" value="" placeholder="Giá thực">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNumber1">Giá ( giảm giá )</label>
                        <input name="discount" type="number" class="form-control" id="discount" value="" placeholder="Giá ( giảm giá )">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword3">Tồn kho</label>
                        <input name="stock" type="number" class="form-control" id="stock" value="" placeholder="Tồn kho">
                    </div>


                    <button type="submit" class="btn btn-primary">Thêm SP</button>
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
            placeholder: 'Chọn loại SP',
            allowClear: true
        })
        $("#colors").select2({
            placeholder: 'Chọn màu SP',
            data: colors,
            allowClear: true
        })
        $("#sizes").select2({
            placeholder: 'Chọn kích cỡ SP',
            allowClear: true
        })

        $('#add-product').submit(async function(e) {
            e.preventDefault();

            showSwal('message-with-auto-close', {
                timer: 60000,
                title: 'Đang tạo sản phẩm'
            });
            try {
                const [mainUrl, imagesUrl] = await Promise.all([
                    uploadPhoto($("#thumbnail").prop('files')[0]),
                    uploadPhotos($("#images").prop('files')),
                ]);

                let formData = {
                    'name': $("#name").val(),
                    'thumbnail': mainUrl,
                    'images': imagesUrl,
                    'description': $("#simpleMdeExample").val(),
                    'sizes': $("#sizes").val(),
                    'price': $("#price").val(),
                    'stock': $("#stock").val(),
                    'discount': $("#discount").val(),
                    'colors': $("#colors").val(),
                    'product_type_id': $("#product_type_id").val(),

                };

                const response = await axios.post('/api/product', formData);
                showSwal('custom-position', {
                    title: 'Thành công',
                })


            } catch (error) {
                return showSwal('title-icon-text-footer', {
                    error: error.response.data.message ?? 'Có lỗi xảy ra,vui lòng thử lại'
                });;
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
                    placeholder: 'Chọn màu SP',
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
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>

<script src="{{ asset('assets/plugins/simplemde/simplemde.min.js') }}"></script>



@endpush


@push('custom-scripts')
<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>

<script src="{{asset('assets/js/handlePhotoUpload.js')}}"></script>
<script src="{{ asset('assets/js/simplemde.js') }}"></script>
@endpush