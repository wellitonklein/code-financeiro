<template>
    <div :id="modal.id" class="modal">
        <div class="modal-content">
            <slot name="content"></slot>
        </div>
        <div class="modal-footer">
            <slot name="footer"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            modal: {
                type: Object,
                default(){
                    return {
                        id:'',
                        options: {}
                    }
                }
            }
        },
        ready(){
            var id = this.modal.id
            $(document).ready(() => {
                $(`#${id}`).modal(this.modal.options)
            })
        }
    }
</script>

<style scoped>

</style>