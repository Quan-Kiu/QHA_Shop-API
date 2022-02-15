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
        <li class="breadcrumb-item"><a href="user">Người dùng</a></li>

        <button type="button" class="btn btn-primary ml-auto" onclick="window.location.href='users/add';">
            <i class="btn-icon-prepend" data-feather="plus"></i>
            Thêm người dùng
        </button>

    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Danh sách người dùng</h6>

                <div class="table-responsive">
                   
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Ảnh đại diện</th>
                                <th style="width:100%">Họ Tên</th>
                                <th>Email</th>
                                <th>Giới tính</th>
                                <th>Số điện thoại</th>
                                <th>Loại TK</th>
                                <th style="opacity:0"></th>
                                <th style="opacity:0"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $item)
                            <tr id="{{{$item->id}}}">
                                <td>{{$item['id']}}</td>
                                <td><img style="width:40px" src="{{$item['avatar']}}" alt="{{$item['avatar']}}"></td>
                                <td>{{$item['fullname']}}</td>
                                <td>{{$item['email']}}</td>
                                <td>{{$item['gender']}}</td>
                                <td>{{$item['phone']}}</td>
                                <td>{{$item['userType']->name}}</td>
                                <td><button class="btn btn-primary" onclick="window.location.href='users/{{{$item->id}}}' ;">Sửa</button></td>
                                <td><button class="btn btn-danger" onclick="deleteUser('{{{$item->id}}}')">Xóa</button></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

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



    const deleteUser = (id) => {
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
                text: "Bạn sẽ không thể khôi phục laị tài khỏan này!",
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
                        const res = await axios.delete(`/api/user/${id}`);
                        $(`${id}`).remove();
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