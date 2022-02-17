@extends('layout.master')



@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div class="col-xl-6 grid-margin stretch-card">
        <div class="card">
          
          <div class="card-body">
            <h6 class="card-title">Thống kê</h6>
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
  console.log(data);
  window.onload = function()
{
    var options = {
    chart: {
      type: 'bar',
      height: '320',
      parentHeightOffset: 0
    },
    colors: ["#f77eb9"],    
    grid: {
      borderColor: "rgba(77, 138, 240, .1)",
      padding: {
        bottom: -15
      }
    },
    series: [{
      name: 'sales',
      data: [30,40,45,50,49,60,70,91,125,220,300,400]
    }],
    xaxis: {
      type: 'category',
      categories: ['02/01/1991','01/02/1991','01/03/1991','01/04/1991','01/05/1991','01/06/1991','01/07/1991', '01/08/1991','01/09/1991','01/10/1991','01/11/1991','01/12/1991']
    }
  }
  
  var apexBarChart = new ApexCharts(document.querySelector("#apexBar"), options);
  
  apexBarChart.render();

  };
</script>
  {{-- <script src="{{ asset('assets/js/apexcharts.js') }}"></script> --}}
@endpush