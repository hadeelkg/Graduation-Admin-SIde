<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="modal-box">
                    <!-- Modal -->
                    <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="MyPrettyModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <div class="modal-body">
                                    <!-- <div class="icon"><i class="fa fa-user"></i></div> -->
                                    <h3 class="title">{{title}}</h3>
                                    <p class="description">{{message}}</p>
                                    <div class="row mb-5">
                                        <slot name="content"></slot>
                                    </div>
                                    <button class="subscribe" @click="DoAction()">{{button_title}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            id:{
                type:String,
                default:'',
            }, 
            title:{
                type:String,
                default:'',
            },
            message:{
                type:String,
                default:'',
            },
            sureResult:{
                type:Boolean,
                default:true,
            },
            button_title:{
                type:String,
                default:'تاكيد'
            }
        },

        methods:{
            DoAction(){
                this.$emit('DoAction',this.sureResult);
            },
            showModel() {
                $("#"+this.id).modal('show');
            },
            hideModel() {
                $("#"+this.id).modal('hide');
            },
        }
    }
</script>

<style scoped>
    .demo{ background: linear-gradient(to right,#25b7d3,#18c0d6,#25b7d3); }
    .modal-box{ font-family: 'Varela Round', sans-serif; }
    .modal-box .show-modal{
        color: #222;
        background-color: #fff;
        font-size: 18px;
        font-weight: 600;
        text-transform: capitalize;
        padding: 10px 15px;
        margin: 80px auto 0;
        border: none;
        outline: none;
        box-shadow: 0 0 10px #555;
        display: block;
    }
    .modal-box .show-modal:hover,
    .modal-box .show-modal:focus{
        color: #222;
        background-color: #fff;
        border: none;
        outline: none;
        text-decoration: none;
    }
    .modal-backdrop.in{ opacity: 0.1; }
    .modal-box .modal{ top: 70px !important; }
    .modal-box .modal-dialog{
        width: 500px;
        margin: 30px auto 10px;
    }
    .modal-box .modal-dialog .modal-content{
        border-radius: 25px;
        box-shadow: 0 0 25px -8px #555;
    }
    .modal-box .modal-dialog .modal-content .close{
        color: #e74c3c;
        background-color: #fff;
        font-size: 28px;
        text-shadow: none;
        line-height: 33px;
        height: 33px;
        width: 33px;
        opacity: 1;
        border-radius: 50%;
        box-shadow: 0 0 5px #555;
        position: absolute;
        left: auto;
        right: -5px;
        top: -5px;
        z-index: 1;
        transition: all 0.3s;
    }
    .modal-box .modal-dialog .modal-content .close span{
        margin: -1px 0 0 0;
        display: block;
    }
    .modal-box .modal-dialog .modal-content .close:hover{
        color: #fff;
        background-color: #e74c3c;
    }
    .modal-box .modal-dialog .modal-content .modal-body{ padding: 50px 20px !important; }
    .modal-box .modal-dialog .modal-content .modal-body .icon{
        color: #25b7d3;
        font-size: 36px;
        text-align: center;
        text-shadow: 4px 0 0 #fff, 0 -3px 0 #fff;
        line-height: 40px;
        height: 50px;
        width: 50px;
        margin: 0 auto 30px;
        position: relative;
        z-index: 1;
    }
    .modal-box .modal-dialog .modal-content .modal-body .icon:after{
        content: '';
        height: 45px;
        width: 45px;
        border: 5px solid #c1c1c1;
        border-radius: 50%;
        position: absolute;
        left: -5px;
        top: 3px;
        z-index: -1;
    }
    .modal-box .modal-dialog .modal-content .modal-body .title{
        margin: 0 0 20px 0;
        font-size: 20px;
        color: #222;
        text-transform: capitalize;
        font-weight: 600;
        text-align: center;
    }
    .modal-box .modal-dialog .modal-content .modal-body .description{
        color: #999;
        text-align: center;
        margin: 0 0 15px;
    }
    .modal-box .modal-dialog .modal-content .modal-body .subscribe{
        color: #fff;
        background-color: #25b7d3;
        font-size: 18px;
        text-transform: uppercase;
        padding: 10px 20px;
        margin: 0 auto;
        border: 0 solid #222;
        border-radius: 50px;
        overflow: hidden;
        display: block;
        position: relative;
        z-index: 1;
        transition: all 0.3s;
    }
    .modal-box .modal-dialog .modal-content .modal-body .subscribe:hover{ background-color: #18c0d6; }
    @media only screen and (max-width: 768px){
        .modal-dialog{ width: 400px !important; }
    }
    @media only screen and (max-width: 576px){
        .modal-dialog{ width: auto !important; }
    }
    button:focus {
        outline: 1px dotted;
        outline: 0px auto -webkit-focus-ring-color  !important;
    }
</style>