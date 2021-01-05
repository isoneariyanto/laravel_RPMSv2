@extends('main_layouts.primary')

@section('title', 'Temperature Sensor' )

@section('menu_title')
<!-- <i class="fab fa-accessible-icon fa-4x"></i> -->
<img src="{{ asset('assets/img/admin-removebg.png') }}" alt="">
<div class="main_greeting">
  <h1>Temperature Sensor</h1>
  <p>Temperature Sensor Tables</p>
</div>
@endsection

@section('content')
<section class="p-3 bg-mix">

  <div class="row mb-5">
    <div class="col">
      <div class="charts">
        <h1></h1>
        <div id="temperatureChart" class="heartbeat_charts"></div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body"> 
      <div class="row mb-2">
        <div class="col-6 pt-2">
          <label>
            <span>Show</span> 
            <select aria-controls="form-control" class="shadow-sm rounded">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
             <span>Entries</span>
           </label>
        </div>
        <div class="col-6">
          <input type="search" name="search" placeholder="Search.." class="srcButton form-control ml-auto shadow-sm rounded" aria-label="Search">
        </div>
      </div>
      <div class="row ">
        <div class="col"> 
          <table class="table">
            <thead class="thead-light">
              <tr class="text-center">
                <th scope="col">ID</th>
                <th scope="col">Temperature</th>
                <th scope="col">Status</th>
                <th scope="col">Time</th>
              </tr>
            </thead>
            <tbody>
              @foreach( $temperature as $temp )
              <tr class="text-center">
                <th>{{ $temp->id }}</th>
                <th>{{ $temp->temperature }}</th>
                <th>
                  @if($temp->temperature > 37)
                      <h6 class="text-danger">High</h6>
                  
                  @elseif($temp->temperature >= 35 && $temp->temperature <= 37)
                      <h6 class="text-success">Normal</h6>
                  
                  @else <h6 class="text-primary">Low</h6>
                  
                  @endif
                </th>
                <th>{{ $temp->created_at }}</th>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-2 ">
    <div class="col d-flex justify-content-end">
      {{ $temperature->links() }}
    </div>
  </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
  // Chart Options
  const options = {
    chart: {
      height: 350,
      width: '100%',
      type: 'line',
      background: '#fff',
      foreColor: '#333'
    },
    series: [{
      name: 'Temperature',
      data: [<?php foreach( $temperature as $temp ){ echo '"' . $temp->temperature . '",'; } ?>]
    }],
    xaxis: {
      categories: [<?php foreach( $temperature as $temp ){ echo '"' . $temp->created_at . '",'; } ?>]
    },
    title:{
      text: 'Temperature Graph',
      align: 'center',
      margin: 20,
      offsetY: 20,
      style:{
        fontSize: '15pt',
      }
    }
  };

  // init chart
  const chart = new ApexCharts(document.querySelector('#temperatureChart'), options);

  // Render chart
  chart.render();
</script>
@endsection