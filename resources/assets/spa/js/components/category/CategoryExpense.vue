<template>
    <div>
        <category-tree :categories="categories"></category-tree>

        <category-save
                :modal-options="modalOptionsSave"
                :category.sync="categorySave"
                :cp-options="cpOptions"
                @save-category="saveCategory">
            <span slot="title">{{title}}</span>
            <div slot="footer">
                <button type="submit" class="btn waves-effect modal-close modal-action">
                    OK
                </button>
                <button type="button" class="btn btn-flat waves-effect waves-red modal-close modal-action">Cancelar</button>
            </div>
        </category-save>

        <modal :modal="modalOptionsDelete">
            <div slot="content" v-if="categoryDelete">
                <h4>Mensagem de confirmação</h4>
                <p><strong>Deseja excluir esta categoria?</strong></p>
                <div class="divider"></div>
                <p>Nome: <strong>{{categoryDelete.name}}</strong></p>
                <div class="divider"></div>
            </div>
            <div slot="footer">
                <button @click="destroy()" class="btn waves-effect modal-close modal-action">
                    OK
                </button>
                <button type="button" class="btn btn-flat waves-effect waves-red modal-close modal-action">Cancelar</button>
            </div>
        </modal>
    </div>
</template>

<script type="text/javascript">
    import categoryMixin from '../../mixins/category-mixin'

    export default {
        name: "CategoryExpense",
        mixins: [categoryMixin],
        methods: {
            namespace(){
                return 'categoryExpense'
            }
        }
    }
</script>