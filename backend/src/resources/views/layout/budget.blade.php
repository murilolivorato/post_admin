<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finance Assessoria</title>


    {{--<link rel="stylesheet" href="/assets/css/all/bulma.css" />--}}
    <link rel="stylesheet" type="text/css" href="/assets/css/all/budget.css">


</head>

<body>
<div class="whapper" id="pg-{{ $pg }}" >

    <!-- MODAL-OPEN-->
    <modal-register v-if="registerModal('register')"  ></modal-register>


    <section class="nav-header">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <div class="navbar-brand">
                        <div id="logo"><h1><a href="{{ route('home') }}">Finance</a></h1></div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <a href="#" class="go-back" @click.prevent="goBack()" ><font-awesome-icon icon="long-arrow-alt-left"  />  Voltar</a>
                </div>
            </div>

        </div>
    </section>

    <section id="main-content">
        <div class="container">
            @yield('content')
        </div>
    </section>

    <!-- END NAV -->
    <section  id="footer">
        <!-- container -->
        <div class="container">
            <div class="columns">
                <div class="column col_footer_one">
                    <div class="row">
                        <div id="logo_footer"><h1><a href="#">Finance</a></h1></div>
                    </div>
                    <div class="row">
                        <p>Localizada em 8 cidades do estado de São Paulo , a Finance Assessoria foi fundada em 2001 com o objetivo de prestar assessoria e consultoria ao mercado de financiamento imobiliário e, desde esta data, está sendo uma Correspondente da Caixa Econômica Federal.</p>

                     </div>
                </div>

                <div class="column col_footer_two">
                    <h3>Entre em Contato</h3>

                    <ul class="footer-companies">
                        <div class="columns">
                            <li class="column"><a href="#">Ribeirão Preto</a></li>
                            <li class="column"><a href="#">São Carlos</a></li>
                        </div>
                        <div class="columns">
                            <li class="column"><a href="#">Araraquara</a></li>
                            <li class="column"><a href="#">Bauru</a></li>
                        </div>
                        <div class="columns">
                            <li class="column"><a href="#">Franca</a></li>
                            <li class="column"><a href="#">Presidente Prudente</a></li>
                        </div>
                        <div class="columns">
                            <li class="column"><a href="#">Sertãozinho</a></li>
                            <li class="column"><a href="#">Assis</a></li>
                        </div>
                        <div class="columns">
                            <li class="column"><a href="#">Piracicaba</a></li>
                        </div>
                    </ul>


                </div>


                <div class="column col_footer_three">
                    <div class="box_phone columns">
                        <div class="column">
                            <h3>Receba Informações</h3>
                            <p class="call-us">Fique por dentro de novidades de Financiamento . Cadastre-se .</p>
                            <form   class="footer_register" @submit.prevent="store_register_one()" >
                                <fieldset>
                                    <div class="field has-addons message-bottom-footer">
                                        <div class="control">
                                            <input class="form-control ipone" type="text" v-model="register_form.email" placeholder="E-mail">
                                        </div>
                                        <div class="control">
                                            <submit-btn :processloading="register_form.get('processingForm')"
                                                        :stylebutton="'btn_cl_left button is-orange  btn-footer-register'"
                                                        faicon="chevron-right"></submit-btn>

                                        </div>
                                    </div>
                                    <div class="field">
                                        <p class="error-msg-3" v-if="errors.has('register_form.email') && show_register_error" v-text="errors.get('register_form.email')" ></p>
                                    </div>
                                </fieldset>
                            </form>

                        </div>
                    </div>
                    <div class="social_media_menu columns">
                        <div class="column">
                            <h3>Nos Siga</h3>
                            <ul class="footer-social-media">
                                <li class="facebook" ><a href="https://www.facebook.com/financeassessoria2001" target="_blank" ><font-awesome-icon :icon="{ prefix: 'fab', iconName: 'facebook-f' }"  /></a></li>
                                <!-- <li class="twitter" ><a href="#"><font-awesome-icon :icon="{ prefix: 'fab', iconName: 'twitter' }"  /></a></li>-->
                                <li class="instagram" ><a href="https://www.instagram.com/financeassessoria/" target="_blank" ><font-awesome-icon :icon="{ prefix: 'fab', iconName: 'instagram' }"  /></a></li>
                                <!--<li class="rss" ><a href="#"><font-awesome-icon icon="rss"  /></a></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
<script src="/assets/js/web.js"></script>
</body>

</html>
