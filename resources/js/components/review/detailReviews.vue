<template>
<div class="pdt-header">
    <vue-headful
        :title="detailReviews.name+' | EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn'"
        description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên"
    />
    <div class="container mt-4">
        <div class="col-xs-12 col-md-6 mr-auto ml-auto mt-4">
            <p>Review of <router-link :to="'/detail-teacher/'+infoTeacher.id">{{infoTeacher.name}}</router-link></p>
            <template v-if="loading">
                <VueContentLoading/>
            </template>
            <template v-else>
                <div class="card">
                    <div v-if="load" class="loadding-avt">
                        <div class="loader"></div>
                    </div>
                    <div class="card-header">
                        <div class="avatar">
                            <img :src="infoUser.avatar">
                        </div>
                        <div class="over">
                            <div class="name">
                                <span class="name-1">{{infoUser.name}}</span>
                                <router-link :to="{name:'profile_user',params:{ id: infoUser.id }}"><span class="review-1"><i class="fa fa-ravelry" aria-hidden="true"></i> view profile</span></router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="star-line">
                            <div :class="'star-rating star-rating-'+detailReviews.rating+' star-rating--medium'">
                                <div class="star-item star-item--color">
                                    <img src="/images/single-star-transparent.svg" alt="Star 1">
                                </div>
                                <div class="star-item star-item--color">
                                    <img src="/images/single-star-transparent.svg" alt="Star 2">
                                </div>
                                <div class="star-item star-item--color">
                                    <img src="/images/single-star-transparent.svg" alt="Star 3">
                                </div>
                                <div class="star-item star-item--color">
                                    <img src="/images/single-star-transparent.svg" alt="Star 4">
                                </div>
                                <div class="star-item star-item--color">
                                    <img src="/images/single-star-transparent.svg" alt="Star 5">
                                </div>
                            </div>
                            <time datetime="2018-10-22T18:09:36.000+00:00" class="ndate" :title="detailReviews.created">{{ detailReviews.created }}
                            </time>
                        </div>

                        <h5 class="card-title"><router-link :to="{name:'success_created_review',params:{ id: detailReviews.id}}">{{detailReviews.name}}</router-link></h5>
                        <p class="card-text">{{detailReviews.description}}</p>
                    </div>
                    <div class="card-footer bg-white">
                        <template v-if="user != null && user.id == detailReviews.user_id">
                            <router-link :to="{name:'edit_review',params:{id:detailReviews.id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</router-link>
                            <button @click="deleteReview"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
</template>
<script>
import moment from 'moment'
import { mapState } from 'vuex'
import { del,get } from '../../helpers/api'
import VueContentLoading from 'vue-content-loading'
import { getReview,deleteReview } from '../../router/router'
    export default{
        name: 'app-detail-review',
         data() {
            return {
                detailReviews: [],
                infoUser: [],
                infoTeacher: [],
                loading: true,
                load: false
            }
        },
        components:{
            VueContentLoading
        },
        mounted() {
            get(getReview+this.$route.params.id)
            .then((res)=>{
                this.detailReviews = res.data.detail_review.review
                this.infoUser = res.data.detail_review.info_review.user
                this.infoTeacher = res.data.detail_review.info_review.teacher
                moment.locale('vi')
                this.detailReviews.created = moment(this.detailReviews.created_at).format('MMMM Do YYYY, h:mm ')
                this.loading = false
            })
            .catch((err)=>{
                if (err.response.data.http_status.code == 404 ||
                    err.response.data.http_status.code == 401) {
                    this.$router.replace('/not-found')
                }
            })

        },
        computed: mapState('auth', {
            user: state => state.user,
        }),
        methods: {
            deleteReview(){
                this.load = true
                del(deleteReview+this.detailReviews.id)
                .then((res)=>{
                    this.$router.push({name:'homepage'})
                })
                .catch((err)=>{
                    alter('deleted not success')
                     this.load = false
                   console.log('fail')
                })
            }
        },
    }
</script>
<style lang="scss" scoped>
.card-title {
    margin-top: 1rem;
    clear: both;
    padding-top:20px;
}
.card{
    .card-header{
        display: table;
        .avatar{
            display:table-cell;
            width:75px;
            img{
                border-radius:50%;
                width:50px;
                height:50px;
            }
        }
        .over{
            display:table-cell;
            vertical-align: middle;
            .name{
                .name-1{
                    display:block;
                }
            }
        }
    }
    .card-footer.bg-white{
        display:inline-block;
        a {
            display:inline;
            margin-left: 5px;
        }
        button {
            background: none;
            border: none;
            color:#00b67a;
            cursor: pointer;
        }
        button:focus {
            outline:none;
        }
        button:hover {
            color: #009d69;
            text-decoration: underline;
        }
    }
}
.star-rating--medium{
    float:left;
}
time{
    float:right;
}
.pdt-header{
    padding-top:90px;
    #img-teacher .row{
        padding:35px;
        .user-info{
            .profile-img{
                display: inline-block;
                img{
                    border-radius: 50%;
                    max-width: 120px;
                    height:auto;
                }
            }
            .info-basic{
                display: inline-block;
                margin-left:35px;
                .name{
                    font-size: 28px;
                }
            }
        }
        .user-data{
            .review,.like{
                display:inline-block;
                text-align: center;
                .big-size{
                    display:block;
                    margin-bottom: 15px;
                    font-size:50px;
                }
            }

        }
    }
}

.loadding-avt {
    height: 100%;
    width: 100%;
}

</style>
