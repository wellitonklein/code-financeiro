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
            hasCashFlows(){
                return store.getters['cashFlow/hasCashFlows']
            }
        },
        created(){
            store.commit('cashFlow/setFirstMonthYear', new Date())
            store.dispatch('cashFlow/query')
        },
        methods: {
            balance(index){
                return store.getters['cashFlow/balance'](index)
            }
        },
    }
</script>