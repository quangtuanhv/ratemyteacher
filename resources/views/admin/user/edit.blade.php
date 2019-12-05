@extends('admin.wrapper')
@section('content')
<div class="col-lg-7">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
	<div class="p-5">
	  <div class="text-center">
		<h1 class="h4 text-gray-900 mb-4">Cập nhật thông tin người dùng</h1>
	  </div>
      <form class="user" method="POST" action="{{ route('user.update', ['id'=>$user->id]) }}">
        @csrf
		<div class="form-group row">
		  <div class="col-sm-6 mb-3 mb-sm-0">
			<input type="text" class="form-control form-control-user" name="name" id="exampleFirstName" placeholder="Name" value="{{$user->name}}">
		  </div>
		  <div class="col-sm-6">
			<input type="date" class="form-control form-control-user" name="birthday" id="exampleLastName" placeholder="birthday" value="{{$user->birthday}}">
		  </div>
		</div>
		<div class="form-group">
		  <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="Email Address" value="{{$user->email}}">
		</div>
		<div class="form-group row">
		  <div class="col-sm-6 mb-3 mb-sm-0">
			<input type="text" class="form-control form-control-user" name="address" id="exampleInput" placeholder="Address" value="{{$user->address}}">
		  </div>
		  <div class="col-sm-6">
			<input type="text" class="form-control form-control-user" name="phone" id="exampleRepeatPassword" placeholder="Phone" value="{{$user->phone}}">
		  </div>
		</div>
		<input class="btn btn-primary btn-user btn-block" type="submit" value="Cập nhật">

		<hr>
	  </form>
	</div>
  </div>
@endsection
