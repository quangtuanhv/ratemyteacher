@extends('admin.wrapper')
@section('CSS')
    <link href="{{ asset('js/admin/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/multiple-select.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
@endsection
@section('content')
<div id="new-teacher">
        <div class="container pdt-6">
          <div class="row m-y-2">
              <div class="col-md-12">
                  <h4 class="m-y-2 text-center mb-5 tab-content">ADD NEW TEACHER</h4>
              </div>
              <div class="col-lg-4 pull-lg-8 text-xs-center">
                  <img src="//placehold.it/150" id="new-photo" class="m-x-auto img-fluid img-circle" alt="avatar">
                  <h6 class="m-t-2">Upload a different photo</h6>
                  <label class="custom-file">
                      <input type="file" id="file" name="image" class="custom-file-input">
                      <span class="custom-file-control  btn btn-primary">Choose file</span>
                  </label>
              </div>
              <div class="col-lg-8 push-lg-4">
                    <div class="alert alert-success" role="alert" id="notification" style="display:none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                  <div class="tab-pane" id="edit">
                      <form role="form">
                          <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Tên</label>
                              <div class="col-lg-9">
                                  <input name="name" class="form-control" type="text" placeholder="Jane">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Số điện thoại</label>
                              <div class="col-lg-9">
                                  <input name="phone" class="form-control" type="text" placeholder="0123456789">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Email</label>
                              <div class="col-lg-9">
                                  <input name="email" class="form-control" type="text" placeholder="example@example.com">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Ngày sinh</label>
                              <div class="col-lg-9">
                                  <input name="birthday" class="form-control" type="date">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Giới tính</label>
                              <div class="col-lg-9">
                                  <select id="user_time_zone" name="gender" class="form-control" size="0">
                                      <option value="0">Male</option>
                                      <option value="1">Female</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Địa chỉ</label>
                              <div class="col-lg-9">
                                  <input  name="address" class="form-control" type="text" value="">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Chuyên môn</label>
                              <div class="col-lg-9">
                                  <input name="specialize" class="form-control" type="text" value="">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Mô tả</label>
                              <div class="col-lg-9">
                                  <textarea name="description" name="description" class="form-control"></textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Trung tâm công tác</label>
                              <div class="col-lg-9">
                                    <select multiple data-placeholder="Thêm trung tâm cho giáo viên" name="centers[]">
                                        @foreach ($centers as $center)
                                            <option value="{{$center->id}}">{{$center->name}}</option>
                                        @endforeach
                                    </select>
                                    <a class="dribbble" href="https://dribbble.com/shots/5112850-Multiple-select-animation-field" target="_blank"><img src="https://cdn.dribbble.com/assets/dribbble-ball-1col-dnld-e29e0436f93d2f9c430fde5f3da66f94493fdca66351408ab0f96e2ec518ab17.png" alt=""></a>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label"></label>
                              <div class="col-lg-9">
                                  <input type="reset" class="btn btn-secondary" value="Cancel">
                                  <button onclick="submitForm(event)" class="btn btn-primary">Add my teacher</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
        </div>
      </div>
@endsection
@section('endJS')
<script src="{{ asset('js/admin/multiple-select.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
    $("input[type=file]").change(function(event){
        let formData = new FormData()
        $.each(event.currentTarget.files, (i, file) => {
            formData.append('file', file)
        })
        axios.post('/api/file/upload',formData)
        .then(res=>{
            $('#new-photo').attr('src',`/images/${res.data}`);
        })
        .catch((err) =>{
            console.log(err)
        })
    });
    function submitForm(event) {
        event.preventDefault();
        const image = $('#new-photo').attr('src');
        const userId = <?php echo Auth::user()->id?>;
        let data = $('form').serialize()
        data += `&image=${image}&userId=${userId}`
        console.log(data)
        axios.post(`/api/teacher/new`, data).then((res)=>{
            const message = res.data.message
            $('#notification').append(message)
            $('#notification').css('display', 'block')
        }).catch(err=>{
            console.log(err);
        })
    }
</script>
@endsection
