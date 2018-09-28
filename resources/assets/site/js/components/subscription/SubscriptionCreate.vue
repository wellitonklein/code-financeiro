<template src="./_template.html"></template>

<script type="text/javascript">
    export default {
        name: 'SubscriptionCreate',
        props: ['plan'],
        data(){
            return {
                payment_type: 'credit_card'
            }
        }
    }
</script>