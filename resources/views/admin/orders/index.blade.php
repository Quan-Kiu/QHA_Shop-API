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
        <li class="breadcrumb-item"><a href="/orders">Hóa đơn</a></li>

        

    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">danh sách hóa đơn</h6>

                <div class="table-responsive">
                <div  class="filter__item mb-2 d-flex align-items-center "><div style="min-width: 150px">Trạng thái hóa đơn</div>

<select id="orders_status" name="orders_status"  style="width:unset;display:inline"  >
    <option selected value="">Tất cả</option>
    @foreach($data['orders_status'] as $item)
    <option value="{{$item->name}}">{{$item->name}}</option>
    @endforeach
</select> 
</div>
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Tổng tiền</th>
                                <th>Thời gian đặt hàng</th>
                                <th>Thời gian giao hàng ( dự kiến )</th>
                                <th>Trạng thái đơn hàng</th>
                                <th style="opacity:0"></th>
                                <th style="opacity:0"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['orders'] as $item)
                            <tr id="{{{$item->id}}}">
                                <td>{{$item['id']}}</td>
                                <td>{{$item['fullname']}}</td>
                                <td>{{$item['phone']}}</td>
                                <td>{{$item['unit_price']}}đ</td>
                                <td>{{$item['created_at']}}</td>
                                <td>{{$item['delivery_date']}}</td>
                                <td>{{$item['OrderStatus']->name}}</td>
                                <td hidden=true>
                                    @foreach( $item['OrderDetails'] as $detail)
                                        {{{$detail->Product}}}
                                    @endforeach
                                </td>
                                <td><button class="btn btn-primary" onclick="
                                    var data = {{ Illuminate\Support\Js::from($item) }};
                                    handleOrderDetail(data);
                                ">Chi tiết</button></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <span class="float-right mr-4 modal-close" onclick=" $('.bd-example-modal-xl').modal('toggle');" style="font-size:60px;color:white;cursor: pointer;">&times;</span>
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content flex-row p-4" style="min-height:600px">
                            <div class="modal-left-content col-8"></div>
                            <div class="modal-right-content col-4"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>



@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>


<script src="{{ asset('assets/js/data-table.js') }}"></script>

<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>

<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>
@endpush

<script>

window.onload = ()=> {


$.fn.dataTable.ext.search.push(
    function(settings,data,dataIndex){
        var orders_status_selected = $('#orders_status').val();
        var orders_status_table = data[6]; // use data for the age column
        if(!orders_status_selected || orders_status_selected == orders_status_table){
        return true;
    }
    return false;

}
);

$(document).ready(function() {
var table = $('#dataTableExample').DataTable();
 
// Event listener to the two range filtering inputs to redraw on input

$('#orders_status').change( function() {
    table.draw();
} );
} );
}


    var orders_status = @json($data['orders_status']);

    const handleOrderDetail = (data) => {
        $('.modal-left-content').html('');
        $('.modal-right-content').html('');
        var html =
            data.order_details.map((item) => {
                var product = item.product;
                return `<tr>
                      <th>${item.id}</th>
                      <td><img style="width:40px" src="${product.thumbnail}" alt="qha"/></td>
                      <td>${product.name}</td>
                      <td>x${item.quantity}</td>
                      <td>${item.unit_price}đ</td>
                      <td>${item.description}</td>
                    </tr>`
            })

        var order_status_html = orders_status.map((item) => {
            if (data.order_status.id === item.id) {
                return ` <option selected value="${item.id}" >${item.name}</option>`
            } else {
                return ` <option value="${item.id}" >${item.name}</option>`

            }
        })
        $('.modal-right-content').append(`
        <div class="card bg-light">
      <div class="card-body">
        <h6 class="card-title">Chi tiết đơn hàng</h6>
         <div class="form-group">
            <label for="order_status_id">Trạng thái đơn hàng</label>
            <select class="form-control" id="order_status_id">
             ${order_status_html}
            </select>
          </div>
          <div class="form-group">
            <label for="fullname">Họ tên</label>
            <input type="text" class="form-control" id="fullname" value="${data.fullname}" placeholder="Enter Name">
          </div>
          <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" class="form-control" id="address" value="${data.address}" placeholder="Enter Address">
        </div>
          <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" class="form-control" id="phone" value="${data.phone}" placeholder="Enter Address">
        </div>
        <div class="form-group">
            <label for="delivery_date">Ngày giao hàng</label>
            <input type="date" class="form-control" id="delivery_date" value="${data.delivery_date}" placeholder="Enter Address">
        </div>
          </div>
          </div>
          <button  onClick="handleUpdate(${data.id})" class="my-4 w-100 btn btn-success " id="btn-update">Lưu</button>
          <button onClick="handleDelete(${data.id})" class="w-100 btn btn-danger" id="btn-delete">Huỷ đơn</button>
          </div>
        `);
        if (data.order_status_id == 4) {
            $('#btn-update').prop('disabled', true);
            $('#btn-delete').prop('disabled', true);

        }


        $('.modal-left-content').append(`
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Hình ảnh</th>
                      <th>Tên SP</th>
                      <th>Số lượng</th>
                      <th>Tổng giá</th>
                      <th>Thông tin chi tiết</th>
                    </tr>
                  </thead>
                  <tbody>
                    ${html}
                  </tbody>
                  <tfoot>
            <tr>
               <th colspan = "3">Tổng</th>
               <th>x${data.quantity}</th>
               <th> ${data.unit_price}đ</th>
               <td></td>
            </tr>
         </tfoot>
                </table>
            </div>
            </div>
           
          </div>`);

        $('.bd-example-modal-xl').modal('show');
    }

    const handleUpdate = async (id) => {
        let formData = {
            fullname: $('#fullname').val(),
            address: $('#address').val(),
            phone: $('#phone').val(),
            delivery_date: $('#delivery_date').val(),
            order_status_id: $('#order_status_id').val(),
        };
        showSwal('message-with-auto-close', {
            timer: 60000,
            title: 'Đang cập nhật thông tin đơn hàng'
        });
        try {
            const response = await axios.put(`/api/order/${id}`, formData);
            showSwal('custom-position', {
                title: 'Thành công',
            })
            window.location.reload(true);
        } catch (error) {
            showSwal('title-icon-text-footer', {
                error: error.response.data.message
            });
        }
    }


    const handleDelete = (id) => {
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
                text: "Bạn sẽ không thể khôi phục laị đơn hàng này!",
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
                        const res = await axios.delete(`/api/order/${id}`);
                        $(`#${id}`).remove();
                        swalWithBootstrapButtons.fire(
                            "Đã xóa!",
                            res.data.message,
                            "success"
                        );
                        $('.bd-example-modal-xl').modal('toggle');


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
