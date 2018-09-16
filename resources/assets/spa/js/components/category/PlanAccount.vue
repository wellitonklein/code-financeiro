<template>
    <div class="row">
        <page-title>
            <h5>Plano de contas</h5>
        </page-title>
        <div class="card-panel z-depth-5">
            <h5>Categorias de Receitas</h5>
            <category-revenue v-ref="revenue"></category-revenue>
            <h5>Categorias de Despesas</h5>
            <category-expense v-ref="expense"></category-expense>
        </div>
        
        <div class="fixed-action-btn horizontal">
            <a class="btn-floating btn-large">
                <i class="large material-icons">add</i>
            </a>
            <ul>
                <li>
                    <a href="#" class="btn-floating" @click.prevent="newRevenue()" title="Nova categoria de receita">
                        <i class="material-icons">attach_money</i>
                    </a>
                </li>
                <li>
                    <a href="#" class="btn-floating red" @click.prevent="newExpense()" title="Nova categoria de despesa">
                        <i class="material-icons">money_off</i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script type="text/javascript">
    import PageTitleComponent from '../PageTitle.vue'
    import CategoryRevenueComponent from './CategoryRevenue.vue'
    import CategoryExpenseComponent from './CategoryExpense.vue'

    export default {
        name: "PlanAccount",
        components: {
            'page-title': PageTitleComponent,
            'category-revenue': CategoryRevenueComponent,
            'category-expense': CategoryExpenseComponent
        },
        methods: {
            newRevenue(){
                this.$refs.revenue.modalNew(null)
            },
            newExpense(){
                this.$refs.expense.modalNew(null)
            }
        }
    }
</script>