@extends('admin.wrapper')
@section('CSS')
    <link href="{{ asset('js/admin/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
@endsection
@section('content')
<div id="new-teacher">
        <div class="container pdt-6">
          <div class="row m-y-2">
              <div class="col-md-12">
                  <h4 class="m-y-2 text-center mb-5 tab-content">ADD NEW CENTER</h4>
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
                              <label class="col-lg-3 col-form-label form-control-label">Tên trung tâm</label>
                              <div class="col-lg-9">
                                  <input name="name" class="form-control" type="text" placeholder="Jane">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Giới thiệu</label>
                              <div class="col-lg-9">
                                  <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
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
                              <label class="col-lg-3 col-form-label form-control-label">Website</label>
                              <div class="col-lg-9">
                                  <input name="website" class="form-control" type="text">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Địa chỉ</label>
                              <div class="col-lg-9">
                                  <input  name="address" class="form-control" type="text" value="">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label"></label>
                              <div class="col-lg-9">
                                  <input type="reset" class="btn btn-secondary" value="Cancel">
                                  <button onclick="submitForm(event)" class="btn btn-primary">Add new center</button>
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
        let data = $('form').serialize()
        data += `&image=${image}`
        axios.post(`/api/centers/new`, data).then((res)=>{
            const message = res.data.message
            $('#notification').append(message)
            $('#notification').css('display', 'block')
        }).catch(err=>{
            console.log(err);

        })
    }
</script>
@endsection
