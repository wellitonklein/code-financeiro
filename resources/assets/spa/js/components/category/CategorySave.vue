<template>
    <div>
        <modal :modal="modalOptions">
            <div slot="content">
                <h4>
                    <slot name="title"></slot>
                </h4>
                <form @submit="submit" name="form" method="POST">
                    <div class="row">
                        <div class="input-field col s12">
                            <label class="active">Nome</label>
                            <input type="text" v-model="category.name" placeholder="Digite o nome" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <label class="active">Categoria pai</label>
                            <input type="text" placeholder="Digite o nome" required/>
                        </div>
                    </div>
                </form>
            </div>
            <div slot="footer">
                <slot name="footer"></slot>
            </div>
        </modal>
    </div>
</template>

<script type="text/javascript">
    import ModalComponent from '../../../../_default/components/Modal.vue'

    export default {
        components:{
            'modal' : ModalComponent,
        },
        props:{
            category: {
                type: Object,
                required: true
            },
            modalOptions: {
                type: Object,
                required: true
            }
        },
        methods:{
            submit(){
                this.$emit('save-category')
            }
        }
    }
</script>