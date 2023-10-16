<template>
  <div class="row row-custom">
      <div class="col-md-8">
        <div class="card text-right">
            <div class="card-header">
                تفاصيل العميل
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table">
                        <tr>
                            <td>اسم العميل</td><td>:</td>
                            <td>{{Client.name}}</td>
                        </tr>
                        <tr>
                            <td>البريد الالكتروني</td><td>:</td>
                            <td>{{Client.email}}</td>
                        </tr>
                        <tr>
                            <td>الجنس</td><td>:</td>
                            <td v-if="Client.gender=='male'">ذكر</td>
                            <td v-else>انثى</td>
                        </tr>
                        <tr>
                            <td>رقم الهاتف</td><td>:</td>
                            <td>{{Client.phone}}</td>
                        </tr>
                        <tr>
                            <td>المدينة</td><td>:</td>
                            <td>{{Client.city.name}}</td>
                        </tr>
                        <tr>
                            <td>العنوان</td><td>:</td>
                            <td>{{Client.address}}</td>
                        </tr>
                        <tr>
                            <td>تاريخ التسجيل</td><td>:</td>
                            <td>{{Client.created_at}}</td>
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
        computed:{
        ...mapState({
            Client:state=>state.admin.Clients.clients.data,
            }),
        },

        created(){
            let client_id=this.$route.params.id;
            store.dispatch('admin/fetchClient',client_id);
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
