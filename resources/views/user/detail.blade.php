@extends('main_layouts.primary')

@section('title', 'Employees Details')

@section('menu_title')
<img src="{{ asset('assets/img/admin-removebg.png') }}" alt="">
<div class="main_greeting">
  <h1>Employees Management</h1>
  <p>Employees Details</p>
</div>
@endsection

@section('content')
<section class="p-3 bg-mix">
  <div class="card">
    <div class="card-body">
      <!-- <form> -->
        <div class="row">
          <div class="col-md-5">           
            <div class="form-group">
              <label for="exampleInputEmail1">Full Name</label>
              <input type="text" class="form-control" placeholder="{{ $employee->first_name}} {{ $employee->last_name}}" readonly>
            </div>
          </div>
          <div class="col-md-4"> 
            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input type="text" class="form-control" placeholder="{{ $employee->username}}" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="text" class="form-control" placeholder="{{ $employee->user->password}}" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="exampleInputPassword1">Email</label>
              <input type="email" class="form-control" placeholder="{{ $employee->user->email}}" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputPassword1">PlaceOfBirth</label>
              <input type="text" class="form-control" placeholder="{{ $employee->placeofbirth}}" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputPassword1">DateOfBirth</label>
              <input type="text" class="form-control" placeholder="{{ $employee->dateofbirth}}" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="exampleInputPassword1">Address</label>
              <input type="text" class="form-control" placeholder="{{ $employee->address}}" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="exampleInputPassword1">Company</label>
              <input type="text" class="form-control" placeholder="{{ $employee->company}}" readonly>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="exampleInputPassword1">Job</label>
              <input type="text" class="form-control" placeholder="{{ $employee->job}}" readonly>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="exampleInputPassword1">Level</label>
              <input type="text" class="form-control" placeholder="{{ $employee->user->level}}" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col d-flex justify-content-end">
            <form action="{{ $employee->id }}" method="post">
              @method('delete')
              @csrf
              <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
            </form>

            <form action="{{ $employee->id }}/edit" method="post" class="ml-1">
              @csrf
              <button class="btn btn-success" type="submit"><i class="fa fa-edit"></i></button>
            </form>
          </div>
        </div>
      <!-- </form> -->
    </div>
  </div>
  <div class="row mt-2">
    <div class="col-md-12">
      <a href="/employees" class="btn btn-grey text-primary"><i class="fas fa-arrow-left mr-2"></i>Back</a>
    </div>
  </div>
</section>
@endsection