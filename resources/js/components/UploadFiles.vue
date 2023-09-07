<template>
  <div>
     <SuccessAlert ref="MySuccessAlert" :title="AlertTitle" :message="AlertMessage" :back="false"/>
     <ConfirmAlert ref="MyConfirmAlert" :title="AlertTitle" :message="AlertMessage" @Sure="YesIamSure($event)" :sureResult="sureResult" />
 
      <div class="text-right" v-if="manageService('can_add')">
        <div v-if="progressInfos">
          <div class="mb-2" v-for="(progressInfo, index) in progressInfos" :key="index">
            <span>{{progressInfo.fileName}}</span>
            <div class="progress">
              <div class="progress-bar progress-bar-info"
                role="progressbar"
                :aria-valuenow="progressInfo.percentage"
                aria-valuemin="0"
                aria-valuemax="100"
                :style="{ width: progressInfo.percentage + '%' }">
                {{progressInfo.percentage}}%
              </div>
            </div>
          </div>
        </div>

        <label class="btn btn-primary">
          <input type="file" multiple @change="selectFile($event)"/>
        </label>

        <button class="btn btn-success"
          :disabled="!selectedFiles"
          @click="uploadFiles">
          رفع الملفات
        </button>

        <div v-if="message" class="alert alert-light" role="alert">
          <ul>
            <li v-for="(ms, i) in message.split('\n')" :key="i">
              {{ ms }}
            </li>
          </ul>
        </div>
    </div>

    <div class="card">
      <div class="card-header text-right">قائمة بالمحتوى المتاح</div>
      <div class="table-responsive">
        <table class="table" style="text-align:center">
          <thead class=" text-primary">
            <th>#</th>
            <th class="title">عنوان</th>
            <th class="title">غلاف</th>
            <th class="status">الحالة</th>
            <th class="watch">مشاهدة</th>
            <th class="created_at">تاريخ الإضافة</th>
            <th class="inserted_by">اضيف بواسطة</th>
            <th class="operations" v-if="manageService('can_update') || manageService('can_delete')">
              إجراءات
            </th>
          </thead>
          <tbody>
            <tr v-for="(file, index) in DailyContent.data" :key="index">
              <td class="id" v-if="DailyContent.current_page === 1">
                {{ index + 1 }}
              </td>
              <td v-else> {{ index + 1 +(DailyContent.current_page - 1) * DailyContent.per_page}}</td>
              <td class="title">{{file.title}}</td>
              <td class="video_cover">
                <template v-if="file.video_cover">
                    <img width="150" :src="'https://www.3via.ly/'+(file.video_cover)" />
                </template>
                <template v-else>لايوجد</template>
              </td>
              <td class="status">{{getStatus(file.status)}}</td>
              <td class="watch">
                <video :key="file.path" width="150" height="150" controls>
                    <source :src="'/storage/DailyContent/'+file.path" type="video/mp4">
                </video>
              </td>
              <td class="created_at">{{file.created_at | DateFormat}}</td>
              <td class="inserted_by">{{(file.user)?file.user.user_name:''}}</td>
              <td class="text-primary operations" v-if="manageService('can_update') || manageService('can_delete')">
                <InputFile class_bs="col-md-12" id="video_cover" title="غلاف الفيديو" @Input="ChangeVideoCover(file,$event)" Mykey="video_cover" :errors="{}"/>
                <router-link v-if="manageService('can_update')" :to="{name: 'admin.daily.content.question.list', params: {content_uuid: file.uuid},query:{Content:file.title}}" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"> </i>
                  اسئلة</router-link>
                <router-link v-if="manageService('can_update')" :to="{name: 'admin.daily.content.edit.form', params: {uuid: file.uuid}}" class="btn btn-warning btn-sm" > <i class="fas fa-pencil-alt"> </i>
                  تعديل</router-link>
                <a href="" class="btn btn-danger btn-sm" @click.prevent="ShowConfirm(file)" v-if="manageService('can_delete')">
                  حذف</a> 
              </td>
            </tr>
          </tbody> 
        </table>
      </div>
      <div class="col-md-12">
        <pagination v-if="DailyContent.last_page > 1" :pagination="DailyContent" :offset="5" @paginate="onPaginationChage"></pagination> 
      </div>
    </div>
  </div>
</template>

<script>
  import UploadService from "../services/UploadFilesService";
  import store from '../store/index'
  import Pagination from '../../../components/Pagination.vue'  
  import {mapState,mapMutations} from 'vuex';
  import SuccessAlert from '../../../components/SuccessAlert'
  import ConfirmAlert from '../../../components/ConfirmAlert'
  import InputFile from '../../../components/Form/InputFile'
  import moment from 'moment';
  export default {
    name: "upload-files",
      computed:{
        ...mapState({
            DailyContent:state=>state.admin.DailyContent.DailyContentList,
        }),
        manageService: (state) => (service) => {
          return store.getters['admin/canManageService'](service);
        },
      }, 

      filters:{
        DateFormat:function(data){
          return moment(data).locale("en").format("YYYY-MM-DD HH:mm:ss");
        }
      },

      components:{
        Pagination,
        SuccessAlert,
        ConfirmAlert,
        InputFile
      },

      data() {
        return {
          selectedFiles: undefined,
          progress: 0,
          message: "",
          NumberUploadedFiles:0,
          NumberSelectedFiles:0,
          progressInfos: [],
          AlertTitle:'',
          AlertMessage:'',
          SelectedFileForDelete:'',
          sureResult:true,
          filter:{
            search:'',
            page:1,
            paginate:1,
          }, 
        };
      },
  
      methods: {
        YesIamSure(value){
          if(value && this.sureResult){
            this.sureResult=false;
            this.onDelete();
          }
        },

        ChangeVideoCover(content,cover){
            let formData=new FormData(); 
            formData.append('uuid',content.uuid);
            formData.append('video_cover',cover);
            store.dispatch('admin/updateDailyContentCover',formData).then((Response)=>{
                this.sure=false;
                this.$refs.MyConfirmAlert.hideModel();
                this.AlertTitle="معلومات",
                this.AlertMessage="تم تغيير غلاف الفيديو بنجاح";
                this.$refs.MySuccessAlert.showModel();
                store.dispatch('admin/fetchDailyContentList',this.filter).then(()=>{
                  this.sureResult=true;
                }).catch(error=>{

                })
              }).catch((error)=>{

            });
        },

        ShowConfirm(file){
          this.AlertTitle="معلومات",
          this.AlertMessage="هل انت متاكد من الحذف ؟";
          this.$refs.MyConfirmAlert.showModel();
          this.SelectedFileForDelete=file;
        },

        onDelete(){
          store.dispatch('admin/deleteDailyContent',this.SelectedFileForDelete.uuid).then((Response)=>{
            this.sure=false;
            this.$refs.MyConfirmAlert.hideModel();
            this.AlertTitle="معلومات",
            this.AlertMessage="تمت الحذف بنجاح";
            this.$refs.MySuccessAlert.showModel();
            store.dispatch('admin/fetchDailyContentList',this.filter).then(()=>{
              this.sureResult=true;
            }).catch(error=>{

            })
          }).catch((error)=>{

        });
        },

        getStatus(val){
          if(val == 0){
            return 'لم يتم عرضه';
          }else if (val == 1){
            return 'يعرض الأن'
          }else if( val ==2 ){
            return 'تم عرضه';
          }else{
            return 'غير معروف';
          }
        },

        selectFile(event) {
          this.progressInfos = [];
          this.selectedFiles = event.target.files;
          this.NumberSelectedFiles= this.selectedFiles.length;
        },

        uploadFiles() {
          this.message = "";
          for (let i = 0; i < this.selectedFiles.length; i++) {
            this.upload(i, this.selectedFiles[i]);
          }
        },

        upload(idx, file) {
          console.log(file);
          this.progressInfos[idx] = { percentage: 0, fileName: file.name };
          UploadService.upload(file, (event) => {
            this.progressInfos[idx].percentage = Math.round(100 * event.loaded / event.total);
          })
            .then((response) => {
              let prevMessage = this.message ? this.message + "\n" : "";
              this.message = prevMessage + response.data.message;
              return UploadService.getFiles();
            })
            .then((files) => {
                this.NumberUploadedFiles++;
                if(this.NumberSelectedFiles == this.NumberUploadedFiles){
                  this.AlertTitle="معلومات",
                  this.AlertMessage="تم رفع الملفات بنجاح";
                  this.$refs.MySuccessAlert.showModel();

                  this.progressInfos=[],
                  this.selectedFiles=undefined;
                  this.message='';
                  this.NumberSelectedFiles=0;
                  this.NumberUploadedFiles=0;
                }
            })
            .catch(() => {
              this.progressInfos[idx].percentage = 0;
              this.message = "حدث مشكلة اثناء رفع الملف:" + file.name;
            });
          },

          onPaginationChage(page){
              this.filter.page=page;
              store.dispatch('admin/fetchDailyContentList',this.filter).then((response)=>{
              }).catch((error)=>{
              })
            },
      },
  };
</script>

<style scoped>
  .btn-success:disabled{
    color: #fff;
    background-color: #d2d2d2;
    border-color: #343a40;
    box-shadow: none;
  }
  .btn-success:disabled:hover{
    color: #fff;
    background-color: #d2d2d2;
    border-color: #343a40;
    box-shadow: none;
    }    
   .title{
     max-width: 200px !important;
   } 
   .status{
     max-width: 150px !important;
   } 
   .watch{
     max-width: 150px !important;
   } 
   .created_at{
     max-width: 150px !important;
   } 
   .inserted_by{
     max-width: 150px !important;
   } 
   .operations{
     max-width: 180px !important;
   } 
</style>