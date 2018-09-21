<template src="./_cash-flow-list.html"></template>

<script type="text/javascript">
    import PageTitleComponent from '../PageTitle.vue'
    import store from '../../store/store'

    export default {
        name: 'CashFlowList',
        components: {
            'page-title': PageTitleComponent,
        },
        data(){
            return {
                modal: {
                    id: 'modal-delete'
                },
                table: {
                    headers: {
                        id: {
                            label: '#',
                            width: '10%'
                        },
                        name: {
                            label: 'Nome',
                            width: '25%'
                        },
                        agency: {
                            label: 'Agência',
                            width: '15%'
                        },
                        account: {
                            label: 'C/C',
                            width: '15%'
                        },
                        'banks:bank_id|banks.name': {
                            label: 'Banco',
                            width: '20%'
                        }
                    }
                }
            }
        },
        computed: {
            bankAccounts(){
                let resp = store.state.bankAccount.bankAccounts
                return resp
            },
            searchOptions(){
                return store.state.bankAccount.searchOptions
            },
            search: {
                get(){
                    return store.state.bankAccount.searchOptions.search
                },
                set(value){
                    store.commit('bankAccount/setFilter',value)
                }
            },
            bankAccountDelete(){
                return store.state.bankAccount.bankAccountDelete
            }
        },
        created(){
            store.dispatch('cashFlow/query')
        },
        methods: {
            destroy(){
                store.dispatch('bankAccount/delete').then((response) => {
                    Materialize.toast('Conta bancária excluída com sucesso!',4000)
                })
            },
            openModalDelete(bankAccount){
                store.commit('bankAccount/setDelete', bankAccount)
                $('#modal-delete').modal('open')
            },
            sortBy(key){
                store.dispatch('bankAccount/queryWithSortBy',key)
            },
            filter(){
                store.dispatch('bankAccount/queryWithFilter')
            }
        },
        events: {
            'pagination::changed'(page){
                store.dispatch('bankAccount/queryWithPagination',page)
            }
        }
    }
</script>