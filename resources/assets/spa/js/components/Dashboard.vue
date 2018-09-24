<template>
    <div class="row">
        <div class="col s8">
            <div class="row"></div>
            <div class="row"></div>
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
    import ValidatorOffRemoveMin from '../mixins/validator-off-remove-mixin'

    export default {
        name: 'Dashboard',
        mixins: [ValidatorOffRemoveMin],
        computed:{
            bankAccounts(){
                return store.state.bankAccount.bankAccounts
            },
            clientId(){
                return store.state.auth.user.client_id
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
            },
            echo(){
                Echo.private(`client.${this.clientId}`)
                    .listen('.CodeFin.Events.BankAccountBalanceUpdatedEvent',(event) => {
                        this.updateBalance(event.bankAccount)
                    })
            },
            findIndexBankAccount(id){
                let index = this.bankAccounts.findIndex(item => {
                    return item.id === id
                })

                return index
            },
            updateBalance(bankAccount){
                let bankAccountIndex = this.findIndexBankAccount(bankAccount.id)
                
                if (bankAccountIndex !== -1){
                    store.commit('bankAccount/updateBalance', {
                        bankAccountIndex,
                        balance: bankAccountIndex.balance
                    })
                }
                let balance = this.$options.filters.numberFormat.read(bankAccount.balance, true)
                let message = `Novo saldo de - ${bankAccount.name} - ${balance}.`
                Materialize.toast(message, 4000)
            }
        }
    }
</script>