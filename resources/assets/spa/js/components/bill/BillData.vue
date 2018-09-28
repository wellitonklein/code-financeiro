<template>
    <table class="grey-text text-darken-2">
        <tbody class="left">
        <tr>
            <td><strong>{{ paidText }}</strong></td>
            <td><strong>{{ billdata.total_paid | numberFormat true }}</strong></td>
        </tr>
        <tr>
            <td><strong>{{ toPayText }}</strong></td>
            <td><strong>{{ billdata.total_to_pay | numberFormat true }}</strong></td>
        </tr>
        <tr>
            <td><strong>Vencidas</strong></td>
            <td><strong>{{ billdata.total_expired | numberFormat true }}</strong></td>
        </tr>
        <tr>
            <td><strong>{{totalFinalText}}</strong></td>
            <td><strong>{{ (billdata.total_paid + billdata.total_to_pay) | numberFormat true }}</strong></td>
        </tr>
        </tbody>
    </table>
</template>

<script type="text/javascript">
    import store from '../../store/store'

    export default {
        name: "BillData",
        props: ['namespace'],
        computed: {
            billdata(){
                return store.state[this.namespace].billData
            },
            paidText(){
                return this.namespace === 'billReceive' ? 'Recebidas' : 'Pagas'
            },
            toPayText(){
                return this.namespace === 'billReceive' ? 'A receber' : 'A pagar'
            },
            totalFinalText(){
                return this.namespace === 'billReceive' ? 'Total de Recebimentos' : 'Total de Pagamentos'
            },
        }
    }
</script>