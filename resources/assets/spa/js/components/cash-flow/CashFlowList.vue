<template src="./_cash-flow-list.html"></template>

<script type="text/javascript">
    import PageTitleComponent from '../PageTitle.vue'
    import store from '../../store/store'

    export default {
        name: 'CashFlowList',
        components: {
            'page-title': PageTitleComponent,
        },
        computed: {
            cashFlows(){
                return store.state.cashFlow.cashFlows
            },
            monthsList(){
                return this.cashFlows.months_list
            },
            categoriesMonths(){
                return this.cashFlows.categories_months
            },
            hasFirstMonthYear(){
                return store.getters['cashFlow/hasFirstMonthYear']
            },
            firstMonthYear(){
                return store.state.cashFlow.firstMonthYear
            },
            firstBalance(){
                return store.getters['cashFlow/firstBalance']
            },
            secoundBalance(){
                return store.getters['cashFlow/secoundBalance']
            },
            monthsListBalanceFinal(){
                return store.getters['cashFlow/monthsListBalanceFinal']
            },
            monthsListBalancePrevious(){
                return store.getters['cashFlow/monthsListBalancePrevious']
            },
            hasCashFlows(){
                return store.getters['cashFlow/hasCashFlows']
            },
            balanceBeforeFirstMonth(){
                return this.cashFlows.balance_before_first_month
            }
        },
        created(){
            store.commit('cashFlow/setFirstMonthYear', '2018-12-01')
            store.dispatch('cashFlow/query')
        },
        methods: {
            balance(index){
                return store.getters['cashFlow/balance'](index)
            },
            categoryTotal(category, monthYear){
                return store.getters['cashFlow/categoryTotal'](category, monthYear)
            }
        },
    }
</script>