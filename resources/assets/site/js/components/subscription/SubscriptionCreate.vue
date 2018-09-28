<template src="./_template.html"></template>

<script type="text/javascript">
    export default {
        name: 'SubscriptionCreate',
        props: ['plan','csrfToken','action'],
        data(){
            return {
                payment_type: 'credit_card',
                credit_card: {
                    number: '',
                    cvv: '',
                    expiration: '',
                    first_name: '',
                    last_name: ''
                }
            }
        },
        methods: {
            submit(){

            }
        }
    }
</script>