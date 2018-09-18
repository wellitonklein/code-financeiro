<template src="../_form.html"></template>

<script type="text/javascript">
    import billPayMix from '../../../mixins/bill-mixin'

    export default {
        name: "BillPayCreate",
        mixins: [billPayMix],
        methods:{
            namespace(){
                return 'billPay'
            },
            title(){
                return 'Novo pagamento'
            }
        }
    }
</script>