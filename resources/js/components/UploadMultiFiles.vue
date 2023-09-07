<template>
  <!-- Modal HTML -->
  <div id="UploadMultiFiles" class="modal fade">
    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <div class="icon-box">
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body text-center">
          <div class="text-right"  >
            <span style="display:none;">{{d}}</span>
            <div v-if="progressInfos">
              <div class="mb-2" v-for="(progressInfo, index) in progressInfos" :key="index">
                  <span>{{progressInfo.fileName}}</span>
                  <div class="progress" :key="index+'_progress'">
                    <div class="progress-bar progress-bar-info"   :key="index+'_progress1'"
                        role="progressbar"
                        :aria-valuenow="progressInfo.percentage"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        :style="{ width: progressInfos[index].percentage + '%' }">
                        {{progressInfo.percentage}}%
                    </div>
                  </div>
              </div>
            </div>
            <label class="btn btn-primary">
              <input type="file" multiple @change="selectFile($event)"  />
            </label>

            <button class="btn btn-success" :disabled="!selectedFiles" @click="uploadFiles">
            رفع الملفات
            </button>

            <div v-if="uploadedInfos.length" class="alert alert-light" role="alert">
                <ul>
                    <li v-for="(info, index) in uploadedInfos" :key="index">
                    {{ info.message }}
                    </li>
                </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</template>

<script>
  import http from '../../utils/axios/admin';
  import store from '../store/index'
  export default {
    data(){
      return{
        selectedFiles: undefined,
        progress: 0,
        NumberUploadedFiles:0,
        NumberSelectedFiles:0,
        d:0,
        progressInfos: [],
        uploadedInfos: [],
      }
    },   

    props:{
      title:{
        type:String,
        default:'',
      },
      back:{
        type:Boolean,
        default:false,
      },
      redirectTo:{
        type:Boolean,
        default:false,
      },
      redirectName:{
        type:String,
        default:'',
      },
      url:{
        type:String,
        default:'',
      },
      nextDispatch:{
        type:String,
        default:'',
      },
      dispatchData:{
        type:Object,
        default:'',
      }
    },

    methods:{
        showModel() {
            $("#UploadMultiFiles").modal('show');
        },

        hideModel() {
          $("#UploadMultiFiles").modal('hide');
          if(this.back){
          this.$router.go(-1); 
          }
          if(this.redirectTo){
            this.$router.push({name:this.redirectName})
          }
        },

        selectFile(event) {
          this.uploadedInfos = [];
          this.progressInfos = [];
          this.selectedFiles = event.target.files;
          this.NumberSelectedFiles= this.selectedFiles.length;
        },

        uploadFiles() {
          this.progressInfos = [];
          for (let i = 0; i < this.selectedFiles.length; i++) {
            this.upload(i, this.selectedFiles[i]);
          }
        },

        upload(idx,file){
            this.progressInfos.push({ percentage: 0, fileName: file.name });
            let formData = new FormData();
            formData.append("name", file?file.name:Math.floor(Math.random() * 10) + 1);
            formData.append("path", file);
            formData.append("category_uuid", this.dispatchData.category_uuid);
            formData.append("sub_category_uuid", this.dispatchData.sub_category_uuid);
            
            http.post(this.url, formData,{
            onUploadProgress: function( progressEvent ) {
              this.progressInfos[idx].percentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ) );
              this.d=parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ) );
            }.bind(this)

            }).then((response) => {
              this.uploadedInfos.push({message: "تم رفع الملف بنجاح :"+ file.name });
              this.NumberUploadedFiles++;
              if(this.NumberSelectedFiles == this.NumberUploadedFiles){
                store.dispatch(this.nextDispatch, this.dispatchData).then((res)=>{
                })
              }
            }).catch((error) => {
            this.uploadedInfos.push("حدث مشكلة اثناء رفع الملف:" + file.name);
      
            })
        },

        submitUploadFiles(idx, file) {
          this.progressInfos[idx] = { percentage: 0, fileName: file.name };
          this.upload(file, idx);
        },
    }
  }
</script>

<style scoped lang="scss">
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