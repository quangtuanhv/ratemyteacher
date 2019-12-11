<template>
<div id="new-teacher">
  <div class="container pdt-6">
    <div class="row m-y-2">
        <div class="col-md-12">
            <h4 class="m-y-2 text-center mb-5 tab-content">Cập nhật mật khẩu</h4>
        </div>
        <div class="col-lg-8 push-lg-4">
             <div class="alert alert-success" role="alert" id="notification" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="tab-pane" id="edit">
                <form role="form" @submit.prevent="updateInfo">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Mật khẩu cũ</label>
                        <div class="col-lg-9">
                            <input v-model="password.passwordOld" class="form-control" type="password" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Mật khẩu mới</label>
                        <div class="col-lg-9">
                            <input v-model="password.passwordNew" class="form-control" type="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Nhập lại mật khẩu mới</label>
                        <div class="col-lg-9">
                            <input  v-model="password.passwordNewConfirm" class="form-control" type="password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                        <div class="col-lg-9">
                            <input type="reset" class="btn btn-secondary" value="Hủy bỏ">
                            <input type="submit" class="btn btn-primary" value="Cập nhật">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>
</template>
<script>
import { post, get } from '../../helpers/api'
import noty from '../../helpers/noty'
import { uploadFile, detailUser } from '../../router/router'

export default {
    name: 'app-update-password',
    data(){
        return{
            password: {
                passwordOld: '',
                passwordNew: '',
                passwordNewConfirm: '',
            },
            loadding : false
        }
    },
    methods:{
        updateInfo() {
            // this.$validator.ValidateAll().then((res)=>{
                this.$Progress.start()
                const { id } = this.$route.params
                const url = `user/update-password/${id}`
                post(url , this.password ).then((res)=>{
                    const message = 'Thay đổi mật khẩu thành công.'
                    // document.getElementById("notification").appendChild(node);
                    $('#notification').text(message)
                    $('#notification').css('display', 'block')
                    this.$Progress.finish()
                }).catch(error=>{
                    if (error.response) {
                        let message = error.response.data.http_status ? error.response.data.http_status.message : error.response.data.message
                        $('#notification').text(message)

                    } else if (error.request) {
                        $('#notification').text(error.request.message)
                    } else {
                        $('#notification').text(error.message)
                    }
                        $('#notification').css('display', 'block')

                    this.$Progress.fail()
                })

            // })
        },

    }
}
</script>
<style>
.m-x-auto.img-fluid.img-circle{
    width:150px;
    height:150px;
}
.loadding-avt {
    height: 150px;
    width: 150px;
}

.custom-file-input{
    display: none;
}
</style>
