@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/products">Product</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
                                        <h6 class="card-title">ADD PRODUCT</h6>
                                        <form action="/product" method="POST">
                                            <div class="form-group">
                                                <label for="exampleInputText1">Name</label>
                                                <input type="text" class="form-control" name="name" value="" placeholder="Enter Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputText1">Description</label>
                                                <input type="text" class="form-control" name="description" value="" placeholder="Enter Description">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Product Type</label>
                                                <select class="form-control" name="product_type_id">
                                                    <option selected disabled>Select Product Type</option>
                                                    <option>12-18</option>
                                                    <option>18-22</option>
                                                    <option>22-30</option>
                                                    <option>30-60</option>
                                                    <option>Above 60</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect2">Size</label>
                                                <select multiple class="form-control" name="sizes">
                                                    <option value="10">33</option>
                                                    <option value="11">34</option>
                                                    <option value="12">35</option>
                                                    <option value="13">36</option>
                                                    <option>37</option>
                                                    <option>38</option>
                                                    <option>39</option>
                                                    <option>40</option>
                                                    <option>41</option>
                                                    <option>42</option>
                                                    <option>43</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Color</label>
                                                <select class="form-control" name="colors">
                                                    <option selected disabled>Select Color</option>
                                                    <option value="10">12-18</option>
                                                    <option>18-22</option>
                                                    <option>22-30</option>
                                                    <option>30-60</option>
                                                    <option>Above 60</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="exampleInputNumber1">Price</label>
                                                <input type="number" class="form-control" name="price" value="" placeholder="Enter Price">
                                            </div>                                            
                                            <div class="form-group">
                                                <label for="exampleInputNumber1">Sale</label>
                                                <input type="number" class="form-control" name="sales" value="" placeholder="Enter Sale">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword3">Stock</label>
                                                <input type="number" class="form-control" name="stock" value="" placeholder="Enter Stock">
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
                                            <button class="btn btn-primary" type="submit" onclick="">Add Product</button>
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

