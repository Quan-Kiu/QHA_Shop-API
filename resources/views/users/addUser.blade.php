@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/user">User</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add User</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
        
                <div class="table-responsive">
                    <table id="table-user" id="dataTableExample" class="table">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">ADD USER</h6>
                                        <form action="/user" method="POST">
                                            <div class="form-group">
                                                <label for="exampleInputText1">Full Name</label>
                                                <input type="text" class="form-control" name="name" value="" placeholder="Enter Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputText1">Email</label>
                                                <input type="email" class="form-control" name="email" value="" placeholder="Enter Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputText1">Password</label>
                                                <input type="password" class="form-control" name="password" value="" placeholder="Enter Password">
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Gender</label>
                                                <select class="form-control" name="gender">
                                                    <option selected disabled>Select Gender</option>
                                                    <option value="10">Nam</option>
                                                    <option>Nữ</option>
                                                    <option>Khác</option>
                                                    
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputText1">Phone</label>
                                                <input type="number" class="form-control" name="phone" value="" placeholder="Enter Phone">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputText1">Avatar</label>
                                                <input type="text" class="form-control" name="avatar" value="" placeholder="Enter Avatar">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputText1">Address</label>
                                                <input type="text" class="form-control" name="phone" value="" placeholder="Enter Address">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="exampleInputNumber1">Birthday</label>
                                                <input type="datetime-local" class="form-control" name="price" value="" placeholder="Enter Birthday">
                                            </div>                                            
                                            
                                            <!-- <div class="form-group">
                                                <label>Main Image</label>
                                                <input type="file" name="img[]" class="file-upload-default">
                                                <div class="input-group col-xs-12">
                                                    <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                                                    <span class="input-group-append">
                                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input type="file" name="img[]" class="file-upload-default">
                                                <div class="input-group col-xs-12">
                                                    <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                                                    <span class="input-group-append">
                                                        <button class="file-upload-browse btn btn-primary" type="button" >Upload</button>
                                                    </span>
                                                </div>
                                            </div> -->
                                            <button class="btn btn-primary" type="submit" onclick="">Add User</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <tbody>

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
@endpush


@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush

