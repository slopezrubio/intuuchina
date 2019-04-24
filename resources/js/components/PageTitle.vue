<template>
    <div class="main-title row">
        <div class="title-card col-8 col-sm-8 col-md-8 col-lg-10 col-xl-10">
            <h1 class="title-card-header">{{ pages[0].title }}</h1>
            <div class="title-card-footer">
                <div class="media">
                    <p>Comparte nuestras ofertas</p>
                    <a href="https://www.linkedin.com/company/intuuchina"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://www.facebook.com/intuuchina"><i class="fab fa-facebook-f"></i></a>
                    -<a href="https://twitter.com/intuuchina"><i class="fab fa-twitter"></i></a>
                </div>
                <button class="body-button_primary">Ver Ofertas <i class="fas fa-angle-right"></i></button>
            </div>
        </div>

    </div>
    <!--<div class="mi-slider">-->
        <!--<ul>-->
            <!--<li>-->
                <!--<div class="box">-->
                    <!--<h3>Prácticas en <strong>primeras empresas</strong> del sector <br>-->
                        <!--tecnologico en <strong>Shanghai</strong> </h3>-->
                    <!--<div class="space-between">-->
                        <!--<p>comparte nuestras ofertas...</p>-->
                        <!--<h4 href="#">Ver <strong>ofertas <span>&rarr;</span></strong></h4>-->
                    <!--</div>-->
                    <!--<div class="space-between">-->
                        <!--<div class="media">-->
                            <!--<a href="https://www.linkedin.com/company/intuuchina"><i class="fab fa-linkedin-in"></i>-->
                                <!--<a href="https://www.facebook.com/intuuchina"><i class="fab fa-facebook-f"></i></a>-->
                                <!--<a href="https://twitter.com/intuuchina"><i class="fab fa-twitter"></i></a>-->
                        <!--</div>-->

                    <!--</div>-->
                <!--</div>-->
            <!--</li>-->
            <!--&lt;!&ndash;<li>-->
              <!--<div class="box">-->
                <!--<h3>Estudios en las <strong>mejores universidades</strong> del país</h3>-->
                <!--<div class="space-between">-->
                  <!--<p>Encuentra tu Universidad...</p>-->
                  <!--<h4 href="#">Ver <strong>Universidades <span>&rarr;</span></strong></h4>-->
                <!--</div>-->
                <!--<div class="space-between">-->
                  <!--<div class="media">-->
                    <!--<a href="https://www.linkedin.com/company/intuuchina"><i class="fab fa-linkedin-in"></i>-->
                      <!--<a href="https://www.facebook.com/intuuchina"><i class="fab fa-facebook-f"></i></a>-->
                      <!--<a href="https://twitter.com/intuuchina"><i class="fab fa-twitter"></i></a>-->
                  <!--</div>-->

                <!--</div>-->
              <!--</div>-->
            <!--</li>-->
              <!--<li>-->
              <!--<div class="box">-->
                <!--<h3>Prácticas en <strong>primeras empresas</strong> del sector <br>-->
                  <!--tecnologico en <strong>Shanghai</strong> </h3>-->
                <!--<div class="space-between">-->
                  <!--<p>comparte nuestras ofertas...</p>-->
                  <!--<h4 href="#">Ver <strong>ofertas <span>&rarr;</span></strong></h4>-->
                <!--</div>-->
                <!--<div class="space-between">-->
                  <!--<div class="media">-->
                    <!--<a href="https://www.linkedin.com/company/intuuchina"><i class="fab fa-linkedin-in"></i>-->
                      <!--<a href="https://www.facebook.com/intuuchina"><i class="fab fa-facebook-f"></i></a>-->
                      <!--<a href="https://twitter.com/intuuchina"><i class="fab fa-twitter"></i></a>-->
                  <!--</div>-->

                <!--</div>-->
              <!--</div>-->
            <!--</li>&ndash;&gt;-->
        <!--</ul>-->
    <!--</div>-->
</template>
<script>
    export default {
        name: "page-title",
        data() {
            return {
                pages: [
                    {
                        title: 'Prácticas en primeras empresas del sector tecnológico en Shangai.'
                    }
                ]
            }
        }
    }
</script>