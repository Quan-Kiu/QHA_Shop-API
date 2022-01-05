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
        <li class="breadcrumb-item"><a href="/user">User</a></li>
        
        <button type="button" class="btn btn-primary ml-auto" onclick="window.location.href='/user/add';">
    <i class="btn-icon-prepend" data-feather="plus"></i>
    Add User
</button>

    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                
                <div class="table-responsive">
                    <table id="table-user" id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Avatar</th>
                                <th>Address</th>
                                <th>Birthday</th>                            
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $item)
                            <tr>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['fullname']}}</td>
                                <td>{{$item['email']}}</td>
                                <td>{{$item['password']}}</td>
                                <td>{{$item['gender']}}</td>
                                <td>{{$item['phone']}}</td>
                                <td>{{$item['avatar']}}</td>
                                <td>{{$item['address']}}</td>
                                <td>{{$item['birthday']}}</td>                                
                                <td><button class="btn btn-primary" onclick="window.location.href='products/add' ;">Update </button></td>
                                <td><button class="btn btn-danger" onclick="showSwal('passing-parameter-execute-cancel')">Delete</button></td>

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