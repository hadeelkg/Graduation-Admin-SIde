<template>
<!-- Modal HTML -->
	<div id="MyPrettyConfirmAlert" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header justify-content-center">
					<div class="icon-box">
						<i class="material-icons">warning</i>
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body text-center">
					<h4>{{title}}</h4>	
					<p>{{message}}</p>
					<button class="btn btn-success" data-dismiss="modal" @click="sure()"><span>موافق</span></button>
					<button class="btn btn-success cancel" style="background: #b1b1b1 !important;" data-dismiss="modal" @click="hideModel()"><span>الغاء</span></button>
				</div>
			</div>
		</div>
	</div> 
</template>

<script>
	export default {
		props:{
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
			}
		},

		methods:{
			sure(){
				this.$emit('Sure',this.sureResult);
			},
			
			showModel() {
					$("#MyPrettyConfirmAlert").modal('show');
			},

			hideModel() {
				$("#MyPrettyConfirmAlert").modal('hide');
			},
		}
	}
</script>

<style scoped lang="scss">
	.modal-confirm {		
		color: #434e65;
		width: 525px;
	}
	.modal-confirm .modal-content {
		padding: 20px;
		font-size: 16px;
		border-radius: 5px;
		border: none;
	}
	.modal-confirm .modal-header {
		background: #ffb445;
		border-bottom: none;   
		position: relative;
		text-align: center;
		margin: -20px -20px 0;
		border-radius: 5px 5px 0 0;
		padding: 35px;
	}
	.modal-confirm h4 {
		text-align: center;
		font-size: 36px;
		margin: 10px 0;
	}
	.modal-confirm .form-control, .modal-confirm .btn {
		min-height: 40px;
		border-radius: 3px; 
	}
	.modal-confirm .close {
		position: absolute;
		top: 15px;
		right: 15px;
		color: #fff;
		text-shadow: none;
		opacity: 0.5;
	}
	.modal-confirm .close:hover {
		opacity: 0.8;
	}
	.modal-confirm .icon-box {
		color: #fff;
		width: 100px;
		height: 99px;
		display: inline-block;
		border-radius: 50%;
		z-index: 9;
		border: 5px solid #fff;
		padding: 7px;
		text-align: center;
	}
	.modal-confirm .icon-box i {
		font-size: 64px;
		margin: -4px 0 0 -4px;
	}
	.modal-confirm.modal-dialog {
		margin-top: 170px;
	}
	.modal-confirm .btn, .modal-confirm .btn:active {
		color: #fff;
		border-radius: 4px;
		background: #eeb711 !important;
		text-decoration: none;
		transition: all 0.4s;
		line-height: normal;
		border-radius: 30px;
		margin-top: 10px;
		padding: 6px 20px;
		border: none;
	}
	.modal-confirm .btn:hover, .modal-confirm .btn:focus {
		background: #eda645 !important;
		outline: none;
	}
	.modal-confirm .btn span {
		margin: 1px 3px 0;
	}
	.modal-confirm .btn i {
		margin-left: 1px;
		font-size: 20px;
		float: right;
	}
	.trigger-btn {
		display: inline-block;
		margin: 100px auto;
	}
	.cancel{
	background: #b1b1b1 !important;
	}

	@media only screen and (max-width: 414px) {
		.modal-confirm {		
		width: 325px;
		}
	}
</style>