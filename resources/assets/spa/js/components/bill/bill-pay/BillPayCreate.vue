<template src="../_form.html"></template>

<script type="text/javascript">
    import billPayMix from '../../../mixins/bill-mixin'
    import ValidatorOffRemoveMin from '../../../mixins/validator-off-remove-mixin'

    export default {
        name: "BillPayCreate",
        mixins: [billPayMix, ValidatorOffRemoveMin],
        ready(){
            this.initSelect2()
        },
        methods:{
            namespace(){
                return 'billPay'
            },
            categoryNamespace(){
                return 'categoryExpense'
            },
            title(){
                return 'Novo pagamento'
            }
        }
    }
</script>

<style type="text/css" scoped src="../_style.css"></style>