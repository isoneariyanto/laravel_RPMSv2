@extends('main_layouts.primary')

@section('title', 'Heartbeat Sensor' )

@section('menu_title')
<!-- <i class="fab fa-accessible-icon fa-4x"></i> -->
<img src="{{ asset('assets/img/admin-removebg.png') }}" alt="">
<div class="main_greeting">
  <h1>Heartbeat Sensor</h1>
  <p>Heartbeat Sensor Tables</p>
</div>
@endsection

@section('content')
<section class="p-3 bg-mix">

  <div class="row mb-5">
    <div class="col">
      <div class="charts">
        <h1></h1>
        <div id="heartbeatChart" class="heartbeat_charts"></div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body"> 
      <div class="row mb-2">
        <div class="col-6 pt-2">
          <label>
            <span>Show</span> 
                <select aria-controls="form-control" class="shadow-sm rounded" id="mySelect">
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
        <!-- <form method="post" onkeyup="search()">
          @csrf -->
          <input type="search" name="search" placeholder="Search.." id="src" class="srcButton form-control ml-auto shadow-sm rounded" aria-label="Search" onkeyup="mydata()">
        <!-- </form> -->
        </div>
      </div>
        <div class="row ">
          <div class="col"> 
            <table class="table">
              <thead class="thead-light">
                <tr class="text-center">
                  <th scope="col">#</th>
                  <th scope="col">ID</th>
                  <th scope="col">Heartbeat</th>
                  <th scope="col">Status</th>
                  <th scope="col">Time</th>
                </tr>
              </thead>
              <tbody >
                @foreach( $heartbeat as $key => $hb )
                <tr class="text-center" >
                  <th>{{ $heartbeat->firstItem() + $key }}</th>
                  <th>{{ $hb->id }}</th>
                  <th>{{ $hb->heartbeat }}</th>
                  <th>
                    @if($hb->heartbeat > 100)
                        <h6 class="text-danger">High</h6>
                    
                    @elseif($hb->heartbeat >= 60 && $hb->heartbeat <= 100)
                        <h6 class="text-success">Normal</h6>

                    @else <h6 class="text-primary">Low</h6>

                    @endif
                  </th>
                  <th>{{ $hb->created_at }}</th>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
  <div class="row mt-2 ">
    <div class="col-md-6 d-flex justify-content-start">
      Showing {{ $heartbeat->firstItem() }}
      to {{ $heartbeat->lastItem() }}
      of {{ $heartbeat->total() }} Entries
    </div>
    <div class="col-md-6 d-flex justify-content-end">
      {{ $heartbeat->links() }}
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
      name: 'Heartbeat',
      data: [<?php foreach( $heartbeat as $hb ){ echo '"' . $hb->heartbeat . '",'; } ?>]
    }],
    xaxis: {
      categories: [<?php foreach( $heartbeat as $hb ){ echo '"' . $hb->created_at . '",'; } ?>]
    },
    title:{
      text: 'Heartbeat Graph',
      align: 'center',
      margin: 20,
      offsetY: 20,
      style:{
        fontSize: '15pt',
      }
    }
  };

  // init chart
  const chart = new ApexCharts(document.querySelector('#heartbeatChart'), options);

  // Render chart
  chart.render();

  // function myFunction() {

  //   // function GetURLParameter(sParam, url)
  //   // {
  //   //     var sPageURL = window.location.search.substring(1);
  //   //     var sURLVariables = sPageURL.split('&');
  //   //     for (var i = 0; i < sURLVariables.length; i++) 
  //   //     {
  //   //         var sParameterName = sURLVariables[i].split('=');
  //   //         if (sParameterName[0] == sParam) 
  //   //         {
  //   //             return sParameterName[1];
  //   //         }
  //   //     }
  //   // }

  //   // var list = GetURLParameter('list');
  //   // var page = GetURLParameter('page');
  //   var val = document.getElementById("mySelect").value;
  //   var pageURL = window.location.search;
  //   // alert(page);
  //   // var url1 = patchUrl + "?page=" + "&list=" + encodeURIComponent(val);
  //   // var url2 = patchUrl + "?list=" + encodeURIComponent(val);
    
  //   // var url = patchUrl + "?page=" ? url1 : url2;
  //   var url = pageURL + "/?list=" + encodeURIComponent(val);
  //   window.location.href = url;
  // }
  // $(document).ready(function(){
  //   $("#heartbeatSrcButton").keyup(function(){
  //     var str=  $("#heartbeatSrcButton").val();
  //     if(str == "") {
  //       $( "#mydata" ).html("<b> search again..</b>"); 
  //     }else {
  //       $.get( "{{ url('/heartbeatCensor/search?id=') }}"+ str, function( data ) {
  //       $( "#mydata" ).html( data );  
  //       });
  //     }
  //   });  
  //   }); 
  function mydata() {
    $(document).ready(function(){
        
        var val = document.getElementById("src").value;
        if(val != ""){
          url = '/heartbeatCensor/search?id=' + val;
          window.location.href = url;
        }
      });
  }
</script>
@endsection