<template>
    <div class="navbar">
        <div class="container navbar-menu">
            <a class="" href="/"><img src="storage/images/logo.png"></a>
            <button><i class="fas fa-bars" ></i></button>
            <ul class="col-lg-9 col-lg-9">
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