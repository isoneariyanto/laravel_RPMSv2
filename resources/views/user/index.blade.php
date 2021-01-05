@extends('main_layouts.primary')

@section('title', 'Employees Management' )

@section('menu_title')
<!-- <i class="far fa-address-book fa-4x"></i> -->
<img src="{{ asset('assets/img/admin-removebg.png') }}" alt="">
<div class="main_greeting">
  <h1>Employees Management</h1>
  <p>List Employees Tables</p>
</div>
@endsection

@section('content')
<section class="p-3 bg-mix">
  <div class="row mb-2">
    <div class="col">
      <a href="{{ url('/employees/create') }}" class="btn btn-primary my-2"><i class="fas fa-user-plus"></i> Add Employees</a>
    </div>
  </div>
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
      <ul class="list-group shadow rounded">
        @foreach( $employees as $personaluser )
        <li class="list-group-item d-flex justify-content-between align-items-center">
          {{ $personaluser->first_name}} {{ $personaluser->last_name}}
          <a href="/employees/{{ $personaluser->id }}" class="badge badge-primary" >detail</a>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
  <div class="row mt-2 ">
    <div class="col">
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</section>
@endsection