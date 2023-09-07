<template>
    <li class="nav-item dropdown"  :class="{'active':Active}">
        <a href="http://example.com" :id="MainId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
            <i class="material-icons">{{Icon}}</i>
            <span class="notification">{{MainTitle}}</span>
        </a>
        <div :aria-labelledby="MainId" class="dropdown-menu dropdown-menu-right">
            <router-link v-for="(item,index) in Items" :key="index" :to="{name:item.path}" class="dropdown-item">{{item.name}}</router-link>
        </div>
    </li>
</template>

<script>
    export default {
        props:{
            MainId:{
                type:String,
                default:'',
            },
            MainTitle:{
                type:String,
                default:'',
            },
            Items:{
                type:Array,
                default:[],
            },
            Icon:{
                type:String,
                default:'',
            },
            Active:{
                type:Boolean,
                default:false,
            }
        }
    }
</script>

<style>

</style>
