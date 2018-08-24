<template>
    <div>{{pages}}</div>
</template>

<script type="text/javascript">
    export default {
        props: {
            currentPage: {
                type: Number,
                'default': 0
            },
            perPage: {
                type: Number,
                required: true
            },
            totalRecords: {
                type: Number,
                required: true
            }
        },
        computed: {
            pages(){
                var pages = Math.ceil(this.totalRecords / this.perPage)
                return Math.max(pages,1)
            }
        }
    }
</script>

<style scoped>

</style>