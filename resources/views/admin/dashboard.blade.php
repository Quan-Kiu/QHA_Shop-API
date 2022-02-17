@extends('layout.master')

@php
$firstDate =  Request::get('firstDate') ?? date('Y-m-d',strtotime(date('Y-m-1')));
$currentDate =  Request::get('currentDate') ?? date('Y-m-d');
@endphp

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div class="col-xl-12 grid-margin stretch-card">
        <div class="card">

      
          
          <div class="card-body">
            <h6 class="card-title">Thống kê doanh thu</h6>
            <div class="filter__item mb-5 d-flex align-items-center">
                            <div style="min-width: 100px">Từ ngày</div><input value="{{$firstDate}}" class="form-control" type="date" id="from" name="from"><span class="mx-2">đến</span><input value='{{$currentDate}}' class="form-control" type="date" max='{{date("Y-m-d")}}' id="to" name="to">
                            <div class="btn btn-primary ml-5" id="submit">Lọc</div>
            </div>
            <div id="apexBar"></div>
          </div>
        </div>
      </div>
</div> <!-- row -->
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')

<script>
  var data = @json($data);
  var sales = data.map((e)=>e.unitPrice);
  var dates = data.map((e)=>e.date);
  window.onload = function()
{



    var options = {
    chart: {
      type: 'bar',
      height: '420',
      parentHeightOffset: 0
    },
    colors: ["#f77eb9"],    
    grid: {
      borderColor: "rgba(77, 138, 240, .1)",

    },
    series: [{
      name: 'Doanh thu',
      data: sales
    }],
    xaxis: {
      type: 'Ngày',
      categories: dates
    }
  }
  
  var apexBarChart = new ApexCharts(document.querySelector("#apexBar"), options);
  
  apexBarChart.render();

  $('#submit').click(function () {
    var to = $('#to').val();
    var from = $('#from').val();
    if(from < to){
      window.location.href = `/admin?firstDate=${from}&currentDate=${to}`;
    }
  })

  };
</script>
  {{-- <script src="{{ asset('assets/js/apexcharts.js') }}"></script> --}}
@endpush