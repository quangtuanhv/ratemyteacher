@extends('admin.wrapper')
@section('CSS')
    <link href="{{ asset('css/multiple-select.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="col-lg-7">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
	<div class="p-5">
	  <div class="text-center">
		<h1 class="h4 text-gray-900 mb-4">Cập nhật thông tin giáo viên</h1>
	  </div>
      <form class="user" method="POST" action="{{ route('teacher.update', ['id'=>$teacher->id]) }}">
        @csrf
		<div class="form-group row">
		  <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFirstName">Tên</label>
			<input type="text" class="form-control form-control-user" name="name" id="exampleFirstName" placeholder="Name" value="{{$teacher->name}}">
		  </div>
		  <div class="col-sm-6">
              <label for="exampleLastName">Sinh nhật</label>
			<input type="date" class="form-control form-control-user" name="birthday" id="exampleLastName" placeholder="birthday" value="{{$teacher->birthday}}">
		  </div>
		</div>
		<div class="form-group">
            <label for="exampleInputguilde">Giới thiệu</label>
		  <textarea type="email" class="form-control form-control-user" name="description" id="exampleInputguilde">{{$teacher->description}}</textarea>
		</div>
		<div class="form-group">
            <label for="exampleInputEmail">Email</label>
		  <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="Email Address" value="{{$teacher->email}}">
		</div>
		<div class="form-group row">
		  <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleInput">Địa chỉ</label>
			<input type="text" class="form-control form-control-user" name="address" id="exampleInput" placeholder="Address" value="{{$teacher->address}}">
		  </div>
		  <div class="col-sm-6">
              <label for="exampleRepeatPassword">phone</label>
			<input type="text" class="form-control form-control-user" name="phone" id="exampleRepeatPassword" placeholder="Phone" value="{{$teacher->phone}}">
		  </div>
        </div>
		<div class="form-group row">
            <div class="col-sm-6">
                <label for="examplespecialize">Chuyên nghành</label>
                <input type="text" class="form-control form-control-user" name="specialize" id="examplespecialize" placeholder="specialize" value="{{$teacher->specialize}}">
            </div>
            <div class="col-sm-6">
                <label for="examplespecialize">Trung tâm công tác</label>
                    <select multiple data-placeholder="Thêm trung tâm cho giáo viên" name="centers[]">
                        @foreach ($centers as $center)
                            <option value="{{$center->id}}"
                            @foreach ($teacher->centers as $item)
                            {{$center->id == $item->id ? 'selected' : ''}}
                            @endforeach
                            >{{$center->name}}</option>
                        @endforeach
                    </select>
                    <a class="dribbble" href="https://dribbble.com/shots/5112850-Multiple-select-animation-field" target="_blank"><img src="https://cdn.dribbble.com/assets/dribbble-ball-1col-dnld-e29e0436f93d2f9c430fde5f3da66f94493fdca66351408ab0f96e2ec518ab17.png" alt=""></a>
            </div>
		</div>
		<input class="btn btn-primary btn-user btn-block" type="submit" value="Cập nhật">

		<hr>
	  </form>
	</div>
  </div>
@endsection
@section('endJS')
<script src="{{ asset('js/admin/multiple-select.js') }}"></script>
@endsection
