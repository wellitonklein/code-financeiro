<template>
    <div class="container">
        <div class="row">
            <div class="card-panel col s8 offset-s2 z-depth-2">
                <h5 class="center">Saindo do sistema . . .</h5>
                <div class="progress">
                    <div class="indeterminate"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import Auth from "../services/auth"

    export default {
        ready(){
            setTimeout(() => {this.logout()},1000)
        },
        methods: {
            logout(){
                var goToLogin = () => this.$router.go({name: 'auth.login'})
                Auth.logout()
                    .then(goToLogin)
                    .catch(goToLogin)
            }
        }
    }
</script>

<style scoped>

</style>