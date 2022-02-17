@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb d-flex">
        <li class="breadcrumb-item"><a href="/products">Sản phẩm</a></li>

        <button type="button" class="btn btn-primary ml-auto" onclick="window.location.href='products/add';">
            <i class="btn-icon-prepend" data-feather="plus"></i>
            Thêm sản phẩm
        </button>

    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Danh sách sản phẩm</h6>

                <div class="table-responsive">
                    <div class="filter mb-3">
                        <div class="filter__item mb-2 d-flex align-items-center">
                            <div style="min-width: 150px">Số lượng tồn kho</div><input class="form-control" type="text" id="min" name="min"><span class="mx-2">-</span>    <input class="form-control" type="text" id="max" name="max">
                        </div>

                        <div class="filter__item mb-2 d-flex align-items-center">
                            <div style="min-width: 150px">Giá</div><input class="form-control" type="text" id="price_min" name="price_min"><span class="mx-2">-</span>    <input class="form-control" type="text" id="price_max" name="price_max">
                        </div>

                        <div  class="filter__item mb-2 d-flex align-items-center "><div style="min-width: 150px">Loại sản phẩm</div>

                            <select id="product_type" name="product_type"  style="width:unset;display:inline"  >
                                
                                <option selected value="">Tất cả</option>
                                @foreach($data['product_type'] as $item)
                                <option value="{{$item->name}}">{{$item->name}}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
       
    </tbody></table>
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Hình ảnh</th>
                                <th style="width:100%">Tên SP</th>
                                <th>Loại SP</th>
                                <th>Giá</th>
                                <th>Giá (giảm giá)</th>
                                <th>Tồn kho</th>
                                <th style="opacity:0"></th>
                                <th style="opacity:0"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['products'] as $item)
                            <tr id="product{{{$item->id}}}">
                                <td>{{$item['id']}}</td>
                                <td><img style="width:40px" src="{{$item['thumbnail']}}" alt="{{$item['thumbnail']}}"></td>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['productType']->name}}</td>
                                <td>{{$item['price']}} VNĐ</td>
                                <td>{{$item['discount']}} VNĐ</td>
                                <td>{{$item['stock']}}</td>
                                <td><button class="btn btn-primary" onclick="window.location.href='products/{{{$item->id}}}' ;">Sửa</button></td>
                                <td><button class="btn btn-danger" onclick="deleteProduct('{{{$item->id}}}')">Xóa</button></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>

</div>




@endsection @push('plugin-scripts') <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
@endpush

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>
@endpush

<script>
window.onload = ()=>{

    
    $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var age = parseFloat( data[6] ) || 0; // use data for the age column
        
        if ( ( isNaN( min ) && isNaN( max ) ) ||
        ( isNaN( min ) && age <= max ) ||
        ( min <= age   && isNaN( max ) ) ||
        ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
    );

    $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#price_min').val(), 10 );
        var max = parseInt( $('#price_max').val(), 10 );
        var price = parseFloat( data[5].split(' ')[0]) || 0; 
        
        if ( ( isNaN( min ) && isNaN( max ) ) ||
        ( isNaN( min ) && price <= max ) ||
        ( min <= price   && isNaN( max ) ) ||
        ( min <= price   && price <= max ) )
        {
            return true;
        }
        return false;
    }
    
    );
    
    $.fn.dataTable.ext.search.push(
        function(settings,data,dataIndex){
            var product_type_selected = $('#product_type').val();
            var product_type_table = data[3]; // use data for the age column
            if(!product_type_selected || product_type_selected == product_type_table){
            return true;
        }
        return false;

    }
);


 
$(document).ready(function() {
    

    var table = $('#dataTableExample').DataTable();
     
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').keyup( function() {
        table.draw();
    } );
    $('#price_min, #price_max').keyup( function() {
        table.draw();
    } );
    $('#product_type').change( function() {
        table.draw();
    } );
});
}
    const deleteProduct = (id) => {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        });

        swalWithBootstrapButtons
            .fire({
                title: "Bạn có chăc chắn?",
                text: "Bạn sẽ không thể khôi phục laị sản phẩm này!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonClass: "ml-2",
                confirmButtonText: "Vâng, xóa nó!",
                cancelButtonText: "Không, trở lại!",
                reverseButtons: true,
            })
            .then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const res = await axios.delete(`/api/product/${id}`);
                        $(`#product${id}`).remove();
                        swalWithBootstrapButtons.fire(
                            "Đã xóa!",
                            res.data.message,
                            "success"
                        );

                    } catch (error) {
                        swalWithBootstrapButtons.fire(
                            "Có lỗi",
                            "Đã có lỗi xảy ra vui lòng thử lại :(",
                            "error"
                        );
            }

                }

            })
    }
</script>