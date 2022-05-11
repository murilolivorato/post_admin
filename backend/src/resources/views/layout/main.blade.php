<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finance Assessoria</title>

    <!-- Bulma Version 0.7.5-->
    {{--<link rel="stylesheet" href="/assets/css/all/bulma.css" />--}}
    <link rel="stylesheet" type="text/css" href="/assets/css/all/web.css">

</head>

<body>
<div class="whapper" id="pg-{{ $pg }}" >

    <!-- IMAGE MODAL --->
    <modal-image  v-if="modal('image')" @close="closeModal('image')" :imageselected="selectedImage"   ></modal-image>

    <!-- LOAN MODEL -->
    <modal-loan-type v-if="modalservice('loan_type')" ></modal-loan-type>


    <!-- MODAL-OPEN-->
    <modal-register v-if="registerModal('register')"  ></modal-register>

    <!-- NAV MENU MOBILE -->
    <nav-menu-mobile></nav-menu-mobile>

    <!-- MENU MOBILE -->
    <menu-mobile-area v-if="menuMobileAreaStatus"></menu-mobile-area>

    <section class="nav-header">
        <div class="container">
            <!-- START NAV -->
            <nav class="navbar">

                <div class="navbar-brand">
                    <div id="logo"><h1><a href="{{ route('home') }}">Finance</a></h1></div>
                </div>

                <div id="main_nav">
                    <!-- ul -->
                    <ul id='nav'>

                        <li class='top' ><a href='#nogo22' id='servicos' class='top_link'><span class='down'>Serviços</span></a>
                            <ul class='sub' id="solucoes" >
                                <div class="bgsubmenutop bloco-item"></div>
                                <div class="bgsubmenu bloco-item">
                                    <div class="bloco-item submenuic">

                                        <div class="columns">
                                            <div class="column">
                                                <h2>Serviços</h2>

                                                <ul class="menu-top-solucoes">
                                                    <div class="columns" >
                                                        <li class="column"><a href="{{ route('service.loan') }}">Financiamento Imobiliário</a></li>
                                                        <li class="column"><a href="{{ route('service.pay_roll_loan') }}">Empréstimo Consignado</a></li>
                                                    </div>

                                                    <div class="columns" >
                                                        <li class="column"><a href="{{ route('service.consortium') }}">Consórcio</a</li>
                                                        <li class="column"><a href="{{ route('service.credit_card') }}">Cartão de Crédito</a></li>
                                                    </div>

                                                    <div class="columns" >
                                                        <li class="column"><a href="{{ route('service.open_account') }}">Abertura de Conta</a></li>
                                                        <li class="column"><a href="{{ route('service.insurance') }}">Seguro</a></li>
                                                    </div>
                                                </ul>

                                            </div>



                                            <div id="left_col_solucoes_top">
                                                <div class="left_col_solucoes_top_col_one">
                                                    <div class="left-icon-top">
                                                        <font-awesome-icon icon="clipboard"  />

                                                    </div>
                                                    <div class="column col_left_col_solucoes_top_col_one"> <h2><span class="sp1">Temos o financiamento</span><br />
                                                            <span class="sp2">Ideal para você</span></h2></div>
                                                </div>

                                                <div class="columns left_col_solucoes_top_col_two">
                                                    <div class="column">
                                                        <ul class="list-solucoes-menu-top">
                                                            <li>Financie com agilidade</li>
                                                            <li>Descubra seu potencial de compra</li>
                                                            <li>Aprovação sem compromisso</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="columns">
                                                    <div class="column isRelative">

                                                        <p><a  @click.prevent="openServiceModal('loan_type')" class="btn_simulacao" ><span>Faça uma Simulação</span>
                                                                <font-awesome-icon icon="long-arrow-alt-right"  />
                                                            </a></p>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="bgsubmenubottom bloco-item"></div>
                            </ul>

                        </li>

                        <!--<li class='top' id="parceiros"><a href="/cadastro"  class='top_link' ><span>Parceiros</span></a></li>-->


                        <li class='top' id="correspondente">
                            <a href="{{ route('company') }} " class='top_link'>
                                <span>A Empresa</span>
                            </a>
                        </li>


                        <li class='top' id="correspondente">
                            <a href="{{ route('corresponding') }} " class='top_link'>
                                <span>Correspondente Bancário</span>
                            </a>
                        </li>

                        <li class='top' id="noticias">
                            <a href="{{ route('posts') }} " class='top_link'>
                                <span>Notícias</span>
                            </a>
                        </li>

                        <li class='top last' id="contact">
                            <a href="{{ route('contact') }} " class='top_link'>
                                <span>Contato</span>
                            </a>
                        </li>




                    </ul>

                </div>
            </nav>
        </div>
    </section>


    {{--<router-view :key="$route.fullPath" ></router-view>--}}


     @yield('content')

    <!-- END NAV -->


    <section  id="footer">
        <!-- container -->
        <div class="container">
            <div class="columns">
                <div class="column col_footer_one">
                    <div class="row" id="logo_footer_area" >
                        <div id="logo_footer"><h1><a href="#">Finance</a></h1></div>
                    </div>
                    <div class="row">
                        <p>Localizada em 8 cidades do estado de São Paulo , a Finance Assessoria foi fundada em 2001 com o objetivo de prestar assessoria e consultoria ao mercado de financiamento imobiliário e, desde esta data, está sendo uma Correspondente da Caixa Econômica Federal.</p>
                    </div>
                </div>

                <div class="column col_footer_two">
                    <h3>Entre em Contato</h3>

                    <ul class="footer-companies">
                        <div class="columns is-mobile">
                            <li class="column"><a href="/fale-conosco">Ribeirão Preto</a></li>
                            <li class="column"><a href="/fale-conosco">São Carlos</a></li>
                        </div>
                        <div class="columns is-mobile">
                            <li class="column"><a href="/fale-conosco">Araraquara</a></li>
                            <li class="column"><a href="/fale-conosco">Bauru</a></li>
                        </div>
                        <div class="columns is-mobile">
                            <li class="column"><a href="/fale-conosco">Franca</a></li>
                            <li class="column"><a href="/fale-conosco">Presidente Prudente</a></li>
                        </div>
                        <div class="columns is-mobile">
                            <li class="column"><a href="/fale-conosco">Sertãozinho</a></li>
                            <li class="column"><a href="/fale-conosco">Piracicaba</a></li>
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
                    <div class="columns" id="social_media_menu">
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
