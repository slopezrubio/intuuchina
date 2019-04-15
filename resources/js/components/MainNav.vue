<template>
    <div class="navbar">
        <div class="navbar_menu">
            <a class="logo" href="/"><img src="storage/images/logo.png"></a>
            <component v-bind:is="component"></component>
            <button class="toggleMenu" v-on:click="displayNav"><i class="fas fa-bars" ></i></button>
        </div>
        <ul class="col-lg-9 col-lg-9 navbar_menu navbar_menu--hidden">
            <li v-for="item in menuItems"><a v-bind:href="item.url">{{ item.name }}</a></li>
            <li><a v-on:click="displayLogin" class="modal-trigger" href="#login">Login</a></li>
            <login></login>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ES</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">EN</a>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "main-nav",
        components: {

        },
        data() {
            return {
                menuItems: [
                    {
                        name: 'Prácticas',
                        url: '/internship'
                    },{
                        name: 'Aprende Chino',
                        url: '/learn'
                    },{
                        name: 'Universidad',
                        url: '/university'
                    },{
                        name: 'Why Intuuchina',
                        url: '/why'
                    }
                ],
            }
        },
        methods: {
            displayNav: function(event) {
                $('.navbar_menu--hidden').toggleClass('navbar_menu--display');
            },
            displayLogin: function(event) {
                $('.modal').modal();
            }
        },
        mounted() {

        }
    }
</script>