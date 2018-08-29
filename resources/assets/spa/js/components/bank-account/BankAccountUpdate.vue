<template src="./_form.html"></template>

<script type="text/javascript">
    import {BankAccount,Bank} from "../../services/resources";
    import PageTitleComponent from '../PageTitle.vue'

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
                    name:''
                },
                banks: []
            }
        },
        created(){
            this.getBanks()
            this.getBankAccount(this.$route.params.id)
        },
        methods: {
            submit(){
                var id = this.$route.params.id
                BankAccount.update({id: id}, this.bankAccount).then(() => {
                    Materialize.toast('Conta bancária atualizada com sucesso',4000)
                    this.$router.go({name: 'bank-account.list'})
                })
            },
            getBanks(){
                Bank.query().then((response) => {
                    this.banks = response.data.data
                    this.initAutoComplete()
                })
            },
            getBankAccount(id){
                BankAccount.get({id: id}).then((response) => {
                    this.bankAccount = response.data.data
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
                $('#bank-id').parent().find('label').insertAfter('#bank-id')
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