<template>
    <div class="columns  is-centered" id="container-area">
        <div class="box column is-7">
            <div class="columns header-text-msg">
                <div class="column">
                    <h1>
                        Esqueceu a Senha
                    </h1>
                    <p class="p_sm_1">Esqueceu a sua Senha ? Não tem problema , preencha os dados e nós  enviaremos por e-mail as instruções .</p>
                </div>
            </div>

            <form  @submit.prevent="storeForm()">
                <div class="columns">
                    <div class="column">
                        <div class="form-group">
                            <label  class="txt1 p-b-20">E-mail </label >
                            <input class="input100" type="email" v-model="form['email']"  >
                            <p class="error-msg" v-if="errors.has('form.email')" v-text="errors.get('form.email')"></p>

                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <router-link :to="{name:'AdminLogin'}"  class="txt3" >Acesso a Área de Login</router-link>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="container-login100-form-btn">
                            <submit-btn :processloading="form.get('processingForm')"
                                        :stylebutton="'btn_full login100-form-btn'"
                                        :textbutton="'Acesse'" ></submit-btn>
                        </div>

                    </div>

                </div>
            </form>
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
      form: new FormDisplay({ email: '' }),
      errors: new Errors()
    }
  },
  methods: {
    storeForm () {
      // PROCESSING
      this.form.set('processingForm', true)

      this.$store.dispatch('forgotPassword/store', this.form.data()).then((res) => {
        // PROCESSING
        this.form.set('processingForm', false)

        // SUCCESS MESSAGE
        this.$swal({
          type: 'success',
          title: 'Foi Enviado as Instruções para o Seu E-mail , Verifique as Instruções!',
          confirmButtonText: 'OK',
          timer: 4000
        }).then(() => this.$router.push({ name: 'RealEstateLogin' }))
      }).catch(error => {
        console.log(error)
        // PROCESSING
        this.form.set('processingForm', false)

        this.errors.record(error.errors, 'form')
      })
    }

  }

}
</script>

<style scoped>

</style>
