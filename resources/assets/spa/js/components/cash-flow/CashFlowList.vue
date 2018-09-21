<template src="./_cash-flow-list.html"></template>

<script type="text/javascript">
    import PageTitleComponent from '../PageTitle.vue'
    import store from '../../store/store'
    import Papa from 'papaparse'

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
            },
            isCurrentMonthYear(monthYear){
                return this.$options.filters.monthYear(new Date) === this.$options.filters.monthYear(monthYear)
            },
            getCsv(){
                let csvResult = []
                csvResult.push([])
                $('table thead .text-csv').each((key, item) => {
                    csvResult[0].push($(item).text().trim())
                })

                $('table tbody tr').each((key,tr) => {
                    csvResult.push([])
                    $(tr).find('.text-csv').each((k, element) => {
                        csvResult[csvResult.length-1].push($(element).text().trim())
                    })
                })
                return Papa.unparse(csvResult)
            },
            downloadCsv(){
                let anchor = $('<a/>')
                anchor.css('display','none')
                anchor.attr('download','fluxo-de-caixa.csv')
                    .attr('target','_blank')
                    .attr('href',`data:text/csv;charset=UTF-8,${encodeURIComponent(this.getCsv())}`)
                anchor.html('Download CSV')
                $('body').append(anchor)
                anchor[0].click()
                anchor.remove()
            },
        },
    }
</script>

<style type="text/css" scoped>
    th{
        border-radius: 0px;
    }
</style>