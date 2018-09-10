<template>
    <div>
        {{consoles}}
        <form @submit.prevent="submit" name="form" method="POST">
            <modal :modal="modalOptions">
                <div slot="content">
                    <h4>
                        <slot name="title"></slot>
                    </h4>
                    <div class="row">
                        <div class="input-field col s12">
                            <label class="active">Nome</label>
                            <input type="text" v-model="category.name" placeholder="Digite o nome" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <select-material :options="cpOptions" :selected.sync="category.parent_id"></select-material>
                            <label class="active">Categoria pai</label>
                        </div>
                    </div>
                </div>
                <div slot="footer">
                    <slot name="footer"></slot>
                </div>
            </modal>
        </form>
    </div>
</template>

<script type="text/javascript">
    import ModalComponent from '../../../../_default/components/Modal.vue'
    import SelectMaterialComponent from "../../../../_default/components/SelectMaterial.vue"

    export default {
        components:{
            'modal' : ModalComponent,
            'select-material': SelectMaterialComponent
        },
        props:{
            category: {
                type: Object,
                required: true
            },
            modalOptions: {
                type: Object,
                required: true
            },
            cpOptions: {
                type: Object,
                required: true
            }
        },
        computed: {
            consoles(){
                return console.log(this.category)
            }
        },
        methods:{
            submit(){
                this.$emit('save-category')
            }
        }
    }
</script>