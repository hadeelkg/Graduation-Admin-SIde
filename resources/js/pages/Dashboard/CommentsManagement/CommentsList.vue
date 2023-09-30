<template>
  <div class="container-fluid">
    <ConfirmAlert ref="MyConfirmAlert" :title="Alert.title" :message="Alert.message" @Sure="YesIamSure($event)" :sureResult="sureResult" />
    <SuccessAlert ref="MySuccessAlert" :title="Alert.title" :message="Alert.message" />
    <div class="col-md-12">
      <div class="col-lg-12 col-md-12 ">
        <!-- <div class="row">
          <div class="col-md-8"></div>
          <div class="col-md-4">
              <router-link :to="{name: 'admin.dashboard.comment.create'}" class="btn btn-primary btn-md add_btn" >
                  اضافة تعليق
              </router-link>
          </div>
        </div> -->
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary" style="text-align: center;">
          <h4 class="card-title">قائمة تعليقات وتقييمات الزبائن</h4>
          <p class="card-category">التعليقات والتقييمات الموجودة في النظام</p>
        </div>

        <div class="card-body" style="text-align:center;">
          <div class="table-responsive">
              <table class="table" style="width: 100%;">
                <thead class="text-primary">
                  <tr>
                    <th>#</th>
                    <th >اسم العميل</th>
                    <th style="width: 45%;">محتوى التعليق</th>
                    <th>التقييم</th>
                    <th>اجراءات</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in CommentsList.data" :key="index">
                    <td>{{index+1}}</td>
                    <td>{{item.client.name}}</td>
                    <td>{{item.content}}</td>
                    <td>{{item.rate}}</td>
                    <!-- <td>{{(item.is_approved)?'مقبول':'غير مقبول'}}</td> -->
                    <td class="text-primary">
                    <router-link :to="{name:'admin.dashboard.comment.details',params:{id:item.id}}" type="button" class="btn my_btn btn-sm">
                      <i class="material-icons details_icon">folder_open</i>
                    </router-link>
                    <!-- <router-link :to="{name:'admin.dashboard.comment.edit', params:{id:item.id}}" type="button" class="btn my_btn btn-sm">
                      <i class="material-icons edit_icon">edit</i>
                    </router-link> -->
                    <button  @click="deleteComment(item.id)" type="button" class="btn my_btn btn-sm">
                      <i class="material-icons delete_icon">delete</i>                      
                    </button>
                    </td>
                  </tr>
                  <tr v-if="!CommentsList.data.length" centre>
                    <td colspan="9">
                        لاتوجد بيانات لعرضها
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {mapState,mapMutations} from 'vuex';
  import store from '../../../store/index';
  import ConfirmAlert from '../../../components/ConfirmAlert'
  import SuccessAlert from '../../../components/SuccessAlert'

  export default {
      data(){
        return{
          Alert:{
            title:'معلومات',
            message:'',
          },

          sureResult:true,
          comment_id:'',
        }
      },

      components:{
        ConfirmAlert,
        SuccessAlert,
      },

      computed:{
        ...mapState({
          CommentsList:state=>state.admin.CommentsAndRates.comments,
        }),
      },

      created(){
        store.commit('admin/PleaseStartLoading');
        store.dispatch('admin/fetchComments').then((response) => {
          store.commit('admin/PleaseStopLoading');
        });
      },

    methods:{

      deleteComment(comment_id){
        this.comment_id = comment_id;
        this.Alert.message='هل تريد حذف هذا التعليق؟';
        this.$refs.MyConfirmAlert.showModel();
      },

      YesIamSure(value){
        if(value && this.sureResult){
          this.sureResult=false;
          this.onDelete();
        }
      },

      CancelAlert(){
        this.sureResult=false;
      },

      onDelete(){
          this.$refs.MyConfirmAlert.hideModel();
          store.commit('admin/PleaseStartLoading');
          store.dispatch('admin/deleteComment',this.comment_id).then((response) => {
            store.dispatch('admin/fetchComments').then((response) => {
              store.commit('admin/PleaseStopLoading');
              this.sureResult=true;
              this.Alert.message='تم حذف التعليق بنجاح';
              this.$refs.MySuccessAlert.showModel();
            }).catch((error) => {
            });
          }).catch((error) => {
                this.Alert.message='لا يمكن حذف هذا التعليق !';
                this.$refs.MyConfirmAlert.showModel();
          });
        },

      }
  }
</script>

<style scoped lang="scss">
  .add_btn{
    background: linear-gradient(60deg, #343a40, #37517e);
  }
  .my_btn{
    box-shadow: 6px 8px 5px #dcd5d9;
    background: linear-gradient(white, white) padding-box,
              linear-gradient(to right,  #ffe3ed, #e9e3e7) border-box;
    // border-radius: 50em;
    border: 2px solid transparent;
    margin:3px;
  }
  .my_btn:hover{
    box-shadow: 0 2px 2px 0 #37517e, 0 3px 1px -2px #37517e, 0 1px 5px 0 rgb(170 71 186 / 12%);
    background: linear-gradient(white, white) padding-box,
              linear-gradient(to right,  #ffe3ed, #e9e3e7) border-box;
  }
  .details_icon{
    color: #37517e;
    }
    .edit_icon{
    color: #39ae00c7;
    }
    .delete_icon{
      color: #ff1e1ec7;
    }
</style>
