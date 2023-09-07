
<template>
    <nav class="row nav-container" role="navigation" aria-label="pagination">
        <div class="col-md-4  text-center">
        <a class="btn btn-sm btn-custom" @click.prevent="changePage(1)" :class="{'btn-disabled':pagination.current_page <= 1}">الصفحة الأولى</a>
        <a class="btn btn-sm btn-custom" @click.prevent="changePage(pagination.current_page - 1)" :class="{'btn-disabled':pagination.current_page <= 1}" >الى الخلف</a>
        </div>

        <div class="col-md-4 text-center">
          <ul class="pagination">
            <li v-for="(page,index) in pages" :key="index">
                <a class="btn btn-sm btn-custom" :class="isCurrentPage(page) ? 'is-current' : ''" @click.prevent="changePage(page)">{{ page }}</a>
            </li>
           </ul>
        </div>

        <div class="col-md-4 text-center">
        <a class="btn btn-sm btn-custom" @click.prevent="changePage(pagination.current_page + 1)" :class="{'btn-disabled':pagination.current_page >= pagination.last_page}" >الى الامام</a>
        <a class="btn btn-sm btn-custom" @click.prevent="changePage(pagination.last_page)" :class="{'btn-disabled':pagination.current_page >= pagination.last_page}" >الصفحة الأخيرة</a>
        </div>
    </nav>
</template>


<script>
    export default {
        props: ['pagination', 'offset'],
        methods: {
            isCurrentPage(page) {
                return this.pagination.current_page === page;
            },
            changePage(page) {
                if (page > this.pagination.last_page) {
                    page = this.pagination.last_page;
                }

                this.pagination.current_page = page;
                this.$emit('paginate',page);
            }
        },
        computed: {
            pages() {
                let pages = [];
                let from = this.pagination.current_page - Math.floor(this.offset / 2);
                if (from < 1) {
                    from = 1;
                }
                let to = from + this.offset - 1;
                if (to > this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                while (from <= to) {
                    pages.push(from);
                    from++;
                }
                return pages;
            }
        }
    }
</script>

<style scoped>
    a{
        color: white !important;
    }
    .pagination{
        margin: 0 !important;
        justify-content: center;
        padding: 0;
    }
    .btn-custom{
        background: #37517e;
        color: white;
        border-radius: 0px;
    }
    .nav-container{
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .pagination a{
        margin: 1px;
    }
    .btn-disabled{
    color: #ffffff;
    cursor: not-allowed;
    opacity: 0.5;
    text-decoration: none;
    }
    .btn-custom:hover {
        background: #37517e;
        color: white !important;
        border-radius: 0px;
    }
    .is-current{
    background: #052033;
        color: white !important;
        border-radius: 0px;
    }
</style>
