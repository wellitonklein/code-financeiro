<template>
    <ul v-bind:id="o.id" class="dropdown-content" v-for="o in menusDropdown">
        <li v-for="item in o.items">
            <a v-link="{name: item.routeName}">{{ item.name }}</a>
        </li>
    </ul>
    <div class="navbar-fixed">
        <nav class="teal">
            <div class="nav-wrapper container">
                <a href="#" class="right brand-logo">Code Contas</a>
                <a href="#" data-activates="nav-mobile" class="button-collapse">
                    <i class="material-icons">menu</i>
                </a>
                <ul class="left hide-on-med-and-down">
                    <li v-for="o in menus">
                        <a v-for="o.dropdownId" class="dropdown-button" href="!#" v-bind:data-activates="">
                            {{ o.name }} <i class="material-icons right">arrow_drop_down</i>
                        </a>
                        <a v-else v-link="{name: o.routeName}">{{ o.name }}</a>
                    </li>
                </ul>
                <ul id="nav-mobile" class="side-nav">
                    <li v-for="o in menus">
                        <a v-link="{name: o.routeName }">{{ o.name }}</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <p>Qualquer texto</p>
    <router-view></router-view>
</template>

<script type="text/javascript">
    export default {
        props: {
            config: {
                type: Object,
                default(){
                    return {
                        name: '',
                        menus: [],
                        menusDropdown: [],
                        urlLogout: '/admin/logout'
                    }
                }
            }
        },
        ready(){
            $('.button-collapse').sideNav()
            $('.dropdown-button').dropdown()
        },
        data(){
            return {
                menus: [
                    {name: "Contas a pagar", routeName: 'bill-pay.list', dropdownId: 'bill-pay'},
                    {
                        id: 'bill-pay', items: [
                            {id: 0, name: "Listar contas", routeName: 'bill-pay.list'},
                            {id: 1, name: "Criar conta", routeName: 'bill-pay.create'}
                        ]
                    },
                ]
            }
        }
    }
</script>

<style scoped>

</style>