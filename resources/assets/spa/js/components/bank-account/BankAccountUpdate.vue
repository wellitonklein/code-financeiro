<template src="./_form.html"></template>

<script type="text/javascript">
    import {BankAccount,Bank} from "../../services/resources";
    import PageTitleComponent from '../PageTitle.vue'
    import 'materialize-autocomplete'
    import _ from 'lodash'
    import store from "../../store/store";

    export default {
        components: {
            'page-title': PageTitleComponent
        },
        data(){
            return {
                title: 'Editando conta bancária',
                bankAccount: {
                    name: '',
                    agency: '',
                    account: '',
                    bank_id: '',
                    'default': false
                },
                bank: {
                    name: ''
                },
                banks: []
            }
        },
        computed: {
            banks(){
                return store.state.bank.banks
            }
        },
        created(){
            this.getBanks()
            this.getBankAccount(this.$route.params.id)
        },
        methods: {
            submit(){
                let id = this.$route.params.id
                BankAccount.update({id: id}, this.bankAccount).then(() => {
                    Materialize.toast('Conta bancária atualizada com sucesso',4000)
                    this.$router.go({name: 'bank-account.list'})
                })
            },
            getBanks(){
                store.dispatch('bank/query').then((response) => {
                    this.initAutoComplete()
                })
            },
            initAutoComplete(){
                let self = this
                $(document).ready(() => {
                    $('#bank-id').materialize_autocomplete({
                        limit: 10,
                        multiple: {
                            enable: false
                        },
                        dropdown: {
                            el: '#bank-id-dropdown'
                        },
                        getData(value,callback) {
                            let mapBanks = store.getters['bank/mapBanks']
                            let banks = mapBanks(value)
                            callback(value,banks)
                        },
                        onSelect(item){
                            self.bankAccount.bank_id = item.id
                        }
                    })
                })
            },
            getBankAccount(id){
                BankAccount.get({
                    id: id,
                    include: 'bank'
                }).then((response) => {
                    this.bankAccount = response.data.data
                    this.bank = response.data.data.bank.data
                })
            }
        }
    }
</script>

<style scoped>

</style>