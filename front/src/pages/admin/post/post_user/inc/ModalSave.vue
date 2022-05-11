<template>
    <!--@close=""-->
    <modal @close="closeModel(type)"  :closeoutside="true" modalstyle="big1" >
        <template slot="header" ><h4>{{ titleText }}</h4></template>
        <template slot="body" >

            <form method="POST" action="" @submit.prevent="storeForm()">
                <div class="modal-body">

                    <!-- USUÁRIO DE NOTÍCIA -->
                    <div class="field">
                        <label >Nome do usuário</label>
                        <input class="form-control" ref="fistinput" v-model="form['title']"  placeholder="título"  type="text"  >
                        <span class="error-msg" v-if="errors.has('form.title')" v-text="errors.get('form.title')"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="lightOne"  @click="closeModel(type)" >Fechar</button>
                    <submit-btn :processloading="form.get('processingForm')"
                                :textbutton="textAction"
                                :stylebutton="'btn_cl_left is-link'"  ></submit-btn>
                </div>

            </form>
        </template>
    </modal>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'

// COMPONENTS
import Modal from 'src/components/Modal'
import SubmitBtn from 'src/components/SubmitBtn'

// CORS
import FormDisplay from 'src/core/FormDisplay'
import Errors from 'src/core/Errors'

export default {
  name: 'ModalSave',
  components: {
    Modal,
    SubmitBtn
  },
  data () {
    return {
      form: new FormDisplay({ id: '', index: '', title: '' }),
      errors: new Errors(),
      formIsSetted: false
    }
  },
  props: {
    type: { type: String }
  },
  methods: {
    storeForm () {
      // PROCESSING
      this.form.set('processingForm', true)

      const data = { data: this.form.data(), action: this.type }

      this.$store.dispatch('adminPostUser/store', data).then((res) => {
        // PROCESSING
        this.form.set('processingForm', false)

        // RESET
        this.form.reset()

        this.type === 'create' ? this.closeModel('create')
          : this.closeModel('edit')

        // loading page is false
        this.setLoadingPage(false)

        // DELETED MESSAGE
        this.$swal({
          icon: 'success',
          title: 'Cadastro Salvo',
          showConfirmButton: false,
          timer: 2000
        })

        if (this.type === 'create') {
          this.reloadPage()
        }
      }).catch(error => {
        // PROCESSING
        this.form.set('processingForm', false)

        this.errors.record(error.errors, 'form')
      })
    },
    reloadPage () {
      Promise.all([

        // CHENGE PAGE ONE
        this.$store.dispatch('adminPostUser/setFirstPaginationPagination')

      ]).then((res) => {
        // LOAD THE PAGE
        this.$store.dispatch('adminPostUser/load_pages')
      })
    },
    ...mapMutations('adminPostUser', {
      closeModel: 'CLOSE_MODAL'
    }),
    ...mapMutations('adminMain', {
      setLoadingPage: 'SET_LOADING_PAGE'
    })
  },
  computed: {
    ...mapGetters('adminPostUser', {
      modal: 'modal',
      selectedIndex: 'selectedIndex',
      displayItems: 'displayItems',
      pageInfo: 'pageInfo'
    }),

    ...mapGetters('adminLogin', {
      getToken: 'getToken'
    }),

    textAction () {
      return this.type === 'create' ? 'Adcionar' : 'Alterar'
    },
    titleText () {
      return this.textAction + ' ' + this.pageInfo.TITLE_NAME
    }
  },
  created () {
    if (this.type === 'edit') {
      // SET FORM
      this.form.setFillItem(this.displayItems[this.selectedIndex], this.selectedIndex)
    }

    // RESET ERRORS IF HAS
    this.errors.reset()

    // FAZ O FOCUS NO PRIMEIRO INPUT
    this.$nextTick(() => this.$refs.fistinput.focus())

    // SET FORM SETTED
    this.$nextTick(() => {
      this.formIsSetted = true
    })
  }

}
</script>

<style scoped>

</style>
