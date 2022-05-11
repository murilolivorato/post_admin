<template>
    <div class="columns  is-centered">
        <div class="box column is-7" v-if="formiSLoaded">

            <!-- TOKEN VALID -->
            <div v-if="token_valid">

                <div class="columns header-text-msg">
                    <div class="column">
                        <h1>
                            Alterar Senha
                        </h1>

                    </div>
                </div>

                <form  @submit.prevent="storeForm()">

                    <div class="columns">
                        <div class="column">
                            <div class="form-group">
                                <label  class="txt1 p-b-20">Nova Senha </label >
                                <input class="input100" type="password" v-model="form['password']"  >
                                <p class="error-msg" v-if="errors.has('form.password')" v-text="errors.get('form.password')"></p>

                            </div>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div class="form-group">
                                <label  class="txt1 p-b-20">Confirmação de Senha </label >
                                <input class="input100" type="password" v-model="form['password_confirmation']"  >
                                <p class="error-msg" v-if="errors.has('form.password_confirmation')" v-text="errors.get('form.password_confirmation')"></p>

                            </div>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <router-link :to="{name:'RealEstateLogin'}"  class="txt3" >Área de Acesso</router-link>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div class="container-login100-form-btn">
                                <submit-btn :processloading="form.get('processingForm')" :stylebutton="'btn_full login100-form-btn'" :textbutton="'Alterar Senha'" ></submit-btn>
                            </div>

                        </div>

                    </div>
                </form>

            </div>
            <!-- END TOKEN VALID -->

            <!-- TOKEN NOT VALID -->
            <div v-else>

                <div class="columns header-text-msg">
                    <div class="column">
                        <h1>
                            Link Inválido
                        </h1>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="container-login100-form-btn">
                            <p class="p_sm_1">O Link é inválido ou expirou o prazo de 24 hs para redefinir a sua senha . Nos Informe o seu e-mail de novo na área de acesso em "Esqueceu a Senha" . </p>

                        </div>

                    </div>

                </div>

                <div class="columns">
                    <div class="column">
                        <div class="container-login100-form-btn">
                            <router-link :to="{name:'AdminLogin'}"  class="txt3" >Área de Acesso</router-link>
                        </div>
                    </div>
                </div>

            </div>
            <!-- END TOKEN NOT VALID -->

        </div>

    </div>
</template>

<script>
import Errors from 'src/core/Errors'
import FormDisplay from 'src/core/FormDisplay'
import SubmitBtn from 'src/components/SubmitBtn'

export default {
  name: 'ForgotPassword',
  components: {
    SubmitBtn
  },
  data () {
    return {
      user_info: { name: '' },
      form: new FormDisplay({ password: '', password_confirmation: '' }),
      errors: new Errors(),
      token_valid: false,
      formiSLoaded: false
    }
  },
  methods: {
    // LOAD PAGE
    loadPage () {
      // IS EDITING
      this.$store.dispatch('recoverPassword/load_form', this.$route.params.token).then((res) => {
        this.token_valid = res.token_valid
        this.user_info.name = res.user_info.name

        this.formiSLoaded = true
      }).catch(() => {
        this.token_valid = false
        this.formiSLoaded = true
      })
    },

    // STORE FORM
    storeForm () {
      // PROCESSING
      this.form.set('processingForm', true)

      this.$store.dispatch('recoverPassword/store', { ...this.form.data(), ...{ token: this.$route.params.token } }).then((res) => {
        // PROCESSING
        this.form.set('processingForm', false)

        // SUCCESS MESSAGE
        this.$swal({
          type: 'success',
          title: 'A sua Senha foi Alterada . Acesse a Área de Login com a sua nova senha !',
          confirmButtonText: 'OK',
          timer: 4000
        }).then(() => this.$router.push({ name: 'RealEstateLogin' }))
      }).catch(error => {
        // PROCESSING
        this.form.set('processingForm', false)

        this.errors.record(error.errors, 'form')
      })
    }

  },
  created () {
    // load PAGE
    this.loadPage()
  }
}
</script>

<style scoped>

</style>
