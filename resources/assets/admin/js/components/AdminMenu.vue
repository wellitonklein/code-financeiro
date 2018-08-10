<template>
    <ul :id="o.id" class="dropdown-content" v-for="o in config.menusDropdown">
        <li v-for="item in o.items">
            <a :href="item.url">{{ item.name }}</a>
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
                    <li v-for="o in config.menus">
                        <a v-if="o.dropdownId" class="dropdown-button" href="!#" :data-activates="o.dropdownId">
                            {{ o.name }} <i class="material-icons right">arrow_drop_down</i>
                        </a>
                        <a v-else :href="o.url">{{ o.name }}</a>
                    </li>
                </ul>
                <ul id="nav-mobile" class="side-nav">
                    <li v-for="o in config.menus">
                        <a :href="o.url">{{ o.name }}</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
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
        }
    }
</script>>