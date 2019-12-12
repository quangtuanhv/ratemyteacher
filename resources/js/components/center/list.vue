<template>
<div class="container mt-100">

     <vue-headful
        title="EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn"
        description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên"
    />
<div class="row">
    <div class="col-12">
    <h2 class="mb-md-5 mb-4">Trường học và Trung tâm</h2>

    <div class="card shadow-none">
        <template v-for="(item, index) in teachers">
            <div class="card-body p-4 p-md-5 border-bottom">
                <div class="d-md-flex align-items-center position-relative justify-content-between">
                    <div class="title-wrap d-block d-md-flex align-items-center">
                        <div class="oval mr-3 my-3 my-md-0 ">
                            <img v-if="item.image != null" :src="item.image" class="avatar-center"/>
                            <i v-else class="fa fa-university fa-2x" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h5 class="card-title">
                                <router-link :to="{name: 'list_teacher', params: {id: item.id}}">{{ item.name }}</router-link>
                            </h5>
                            <h6 class="card-subtitle">{{ item.address }}</h6>
                        </div>
                    </div>
                    <div class="reviews-wrap mt-3 mt-md-0">
                        <p class="card-text">
                            <span class="d-block text-right text-danger font-italic font-weight-bold">{{ Math.round(item.star * 100) / 100 }} / 5 Sao</span>
                            <span>{{ item.rated }} / {{ item.teachers }} Giáo Viên được đánh giá</span>
                        </p>
                    </div>
                    <div class="review-btn d-flex justify-content-between dot-position">
                        <div class="dropdown">
                            <div class="star-rating-container">
                                <div :class="'star-rating star-rating--medium star-rating-'+ Math.round(item.star)">
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
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
</div>
</div>
</template>
<script>
import { get } from '../../helpers/api.js'
export default {
    name: 'list-teacher',
    data() {
        return {
            teachers: {}
        }
    },
    mounted() {
        get('centers').then(res => {
            this.teachers = res.data.list
        })
    },
    filters: {
        roundNumber: function (value) {
            console.log(value, 'rrr');

            if (!value) return ''
            return Math.round(value)
        }
    }
}
</script>
<style scoped>
.mt-100 {
    margin-top: 100px;
}
.avatar-center {
    width: 68px;
    height: 68px;
}
</style>
