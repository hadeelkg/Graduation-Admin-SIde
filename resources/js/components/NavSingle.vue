<template>
    <li class="nav-item " :class="{'active':Active}" @click="logout">
        <router-link  class="nav-link" :to="{name:Path}">
            <i class="material-icons">{{Icon}}</i>
            <p>{{MainTitle}}</p>
        </router-link>
    </li>
</template>

<script>
    export default {
        props:{
            Icon:{
                type:String,
                default:'',
            },
            MainTitle:{
                type:String,
                default:'',
            },
            Path:{
                type:String,
                default:'',
            },
            Active:{
                type:Boolean,
                default:false,
            }
        },
        methods:{
            logout(){
                this.$emit('logout',true);
            }
        }
    }
</script>

<style>

</style>