<template src="./_template.html"></template>

<script type="text/javascript">
    export default {
        name: 'SubscriptionCreate',
        props: ['plan','csrfToken','action'],
        data(){
            return {
                payment_type: 'credit_card',
                credit_card: {
                    number: '411111111111111',
                    cvv: '123',
                    expiration: '12/10',
                    first_name: 'Nome',
                    last_name: 'Sobrenome'
                }
            }
        },
        methods: {
            submit(){

            }
        }
    }
</script>