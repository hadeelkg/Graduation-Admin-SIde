<template>
  <div class="row row-custom">
      <div class="col-md-8">
        <div class="card text-right">
            <div class="card-header">
                تفاصيل التعليق
            </div>
           
            <div class="card-body">
                <div class="row">
                    <table class="table">
                        <tr>
                            <td>اسم العميل</td><td>:</td>
                            <td>{{Comment.client.name}}</td>
                        </tr>
                        <tr>
                            <td>الايميل</td><td>:</td>
                            <td>{{(Comment.client.email)}}</td>
                        </tr>
                        <tr>
                            <td>رقم الهاتف</td><td>:</td>
                            <td>{{(Comment.client.phone)}}</td>
                        </tr>
                        <tr>
                            <td>محتوى التعليق</td><td>:</td>
                            <td>{{Comment.content}}</td>
                        </tr>
                        <tr>
                            <td>التقييم</td><td>:</td>
                            <td>{{Comment.rate}}/5</td>
                        </tr>
                        <!-- <tr>
                            <td>الحالة</td><td>:</td>
                            <td>{{(Comment.is_approved)?'مقبول':'مرفوض'}}</td>
                        </tr> -->
                        <tr>
                            <td>تاريخ الادخال</td><td>:</td>
                            <td>{{Comment.created_at}}</td>       
                        </tr>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import store from '../../../store/index';
    export default {
        data(){
            return{

            }
        },

        computed:{
        ...mapState({
            Comment:state=>state.admin.CommentsAndRates.comments.data,

            }),
        },

        created(){
            let comment_id=this.$route.params.id;
            store.commit('admin/PleaseStartLoading');
            store.dispatch('admin/fetchComment',comment_id).then((response) => {
                store.commit('admin/PleaseStopLoading');
            });
        },

    }
</script>
<style scoped>
    .row-custom{
        justify-content: center;
    }
    .card .card-header {
        background: #37517e;
        color: white;
    }

</style>
