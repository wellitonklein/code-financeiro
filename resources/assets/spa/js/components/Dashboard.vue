<template>
    <div class="row">
        <div class="col s8">
            <div class="row"></div>
            <div class="row" v-if="hasCashFlowsMonthly">
                <vue-chart
                        :chart-type="chartOptions.chartType"
                        :columns="chartOptions.columns"
                        :rows="chartOptions.rows"
                        :options="chartOptions.options"
                ></vue-chart>
            </div>
        </div>
        <div class="col s4">
            <ul class="collection">
                <li class="collection-item avatar" v-for="o in bankAccounts">
                    <img :src="o.bank.data.logo" class="circle"/>
                    <span class="title"><strong>{{o.name}}</strong></span>
                    <p>{{o.balance | numberFormat true}}5</p>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import store from '../store/store'
    import VueCharts from 'vue-charts'
    import ValidatorOffRemoveMin from '../mixins/validator-off-remove-mixin'

    Vue.use(VueCharts)

    export default {
        name: 'Dashboard',
        mixins: [ValidatorOffRemoveMin],
        computed:{
            bankAccounts(){
                return store.state.bankAccount.bankAccounts
            },
            clientId(){
                return store.state.auth.user.client_id
            },
            cashFlows(){
                return store.state.cashFlow.cashFlowsMonthly
            },
            hasCashFlows(){
                return store.getters['cashFlow/hasCashFlowsMonthly']
            },
            chartOptions(){
                let obj = {
                    chartType: 'ColumnChart',
                    columns: [
                        {'type': 'string', 'label': 'Dias'},
                        {'type': 'number', 'label': 'Receita'},
                        {'type': 'string', 'role': 'style'},
                        {'type': 'number', 'label': 'Despesa'},
                        {'type': 'string', 'role': 'style'},
                    ],
                    rows: [],
                    options: {
                        title: 'Fluxo de Caixa Mensal',
                        isStacked: true,
                        bar: {groupWidth: '40%'},
                        legend: {position: 'top'},
                        colors: ['green','red']
                    }
                }
                
                for (let period of this.cashFlows.period_list){
                    obj.rows.push([
                        this.$options.filters.dayMonth(period.period),
                        period.revenues.total === 0 ? null : period.revenues.total,
                        'green',
                        period.expenses.total === 0 ? null : -period.expenses.total,
                        'red',
                    ])
                }
                return obj
            },
            hasCashFlowsMonthly(){
                return store.getters['cashFlow/hasCashFlowsMonthly']
            }
        },
        created(){
            this.store()
            this.echo()
        },
        methods: {
            store(){
                store.commit('bankAccount/setOrder', 'balance')
                store.commit('bankAccount/setSort', 'desc')
                store.commit('bankAccount/setLimit', 5)
                store.dispatch('bankAccount/query')

                store.dispatch('cashFlow/monthly')
            },
            echo(){
                Echo.private(`client.${this.clientId}`)
                    .listen('.CodeFin.Events.BankAccountBalanceUpdatedEvent',(event) => {
                        this.updateBalance(event.bankAccount)
                        // console.log(event)
                    })
            },
            findIndexBankAccount(id){
                // console.log(`id : ${id}`)
                // console.log(`bankAccounts : ${this.bankAccounts}`)
                return this.bankAccounts.findIndex(item => {
                    return item.id === id ? id : -1
                })

                // return index
            },
            updateBalance(bankAccount){
                let bankAccountIndex = this.findIndexBankAccount(bankAccount.id)

                if (bankAccountIndex !== -1 && bankAccountIndex !== 'undefined'){
                    store.commit('bankAccount/updateBalance', {index: bankAccountIndex, balance: bankAccount.balance})
                }
                let balance = this.$options.filters.numberFormat.read(bankAccount.balance, true);
                Materialize.toast(`Novo saldo para ${bankAccount.name} - ${balance}`,5000);
            }
        }
    }
</script>