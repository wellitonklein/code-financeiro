<template>
    <div class="row">
        <page-title>
            <h5>Administração de categorias</h5>
        </page-title>
        <div class="card-panel z-depth-5">

        </div>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large" v-link="{name: 'bank-account.create'}">
                <i class="large material-icons">add</i>
            </a>
        </div>

    </div>
</template>

<script type="text/javascript">
    import PageTitleComponent from '../PageTitle.vue'
    export default {
        components: {
            'page-title': PageTitleComponent,
        },
    }
</script>