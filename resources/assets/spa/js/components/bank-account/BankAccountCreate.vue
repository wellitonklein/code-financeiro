<template src="./_form.html"></template>

<script type="text/javascript">
    import {BankAccount,Bank} from "../../services/resources";
    import PageTitleComponent from '../PageTitle.vue'
    import 'materialize-autocomplete'
    import _ from 'lodash'

    export default {
        components: {
            'page-title': PageTitleComponent
        },
        data(){
            return {
                title: 'Nova conta bancária',
                bankAccount: {
                    name: '',
                    agency: '',
                    account: '',
                    bank_id: '',
                    'default': false
                },
                banks: []
            }
        },
        created(){
            this.getBanks()
        },
        methods: {
            submit(){
                BankAccount.save({},this.bankAccount).then(() => {
                    Materialize.toast('Conta bancária criada com sucesso!',4000)
                    this.$router.go({name: 'bank-account.list'})
                })
            },
            getBanks(){
                Bank.query().then((response) => {
                    this.banks = response.data.data
                    this.initAutoComplete()
                })
            },
            initAutoComplete(){
                var self = this
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
                            var banks = self.filterBankByName(value)
                            banks = banks.map((o) => {
                                return {id: o.id, text: o.name}
                            })
                            callback(value,banks)
                        },
                        onSelect(item){
                            self.bankAccount.bank_id = item.id

                        }
                    })
                })
            },
            filterBankByName(name){
                var banks = _.filter(this.banks, (o) => {
                    return _.includes(o.name.toLowerCase(), name.toLowerCase())
                })
                return banks
            }
        }
    }
</script>

<style scoped>

</style>