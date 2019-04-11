<template>
    <div class="navbar">
        <div class="container">
            <a class="col-xs-0 col-sd-0" href="/"><img src="storage/images/logo.png"></a>
            <ul class="col-xs-12 col-sd-12">
                <li v-for="item in menuItems"><a v-bind:href="item.url">{{ item.name }}</a></li>
                <li class=""><a href="#">Login</a></li>
                <li class="nav-item dropdown"><a class="dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ES</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">EN</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "main-nav",
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
                    },{
                        name: 'Login',
                        url: '/login'
                    }
                ]
            }
        },
        mounted() {

        }
    }
</script>