<template>

    <modal   @close="closeModel(type + 'FileGallery')"  >
        <template slot="header" ><h4>{{ textAction }} Galeria de Arquivo</h4></template>
        <template slot="body" >

            <form method="POST" action="" @submit.prevent="storeForm">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="is-required" >Galeria de Arquivo</label>
                        <select-box-one v-model="form.gallery_id"
                                        :selected="form.gallery_id"
                                        :options="formOptions('file_gallery')"
                                        :nametitleinput="'title'"
                                        placeholder="Galeria de Arquivo" v-if="componentIsLoaded" ></select-box-one>

                        <span class="error-msg" v-if="errors.has('form.gallery_id')" v-text="errors.get('form.gallery_id')"></span>
                    </div>

                    <div class="form-group">
                        <label class="is-required" >Título da Galeria</label>
                        <label>
                            <input class="form-control border-input" type="text"  ref="fistinput" v-model="form.title" placeholder="Título da Galeria">
                        </label>
                        <span class="error-msg" v-if="errors.has('form.title')" v-text="errors.get('form.title')"></span>
                    </div>

                    <div class="form-group">
                        <label>Descrição da Galeria</label>
                        <textarea class="textarea small-one"  placeholder="Escreva aqui mais Informações da Galeria"  v-model="form.description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="lightOne"  @click="closeModel(type + 'FileGallery')" >Fechar</button>
                    <submit-btn :processloading="form.get('processingForm')" :textbutton="textAction"  :stylebutton="'submit_1 btn_side_left'"  ></submit-btn>
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
import SelectBoxOne from 'src/components/SelectBoxOne'

// CORS
import FormDisplay from 'src/core/FormDisplay'
import Errors from 'src/core/Errors'
import ValidateForm from 'src/core/ValidateForm'

export default {
  name: 'ModalSaveFileGallery',
  data () {
    return {
      form: new FormDisplay({ id: 'temp', gallery_id: '', title: '', description: '' }),
      errors: new Errors(),
      componentIsLoaded: false

    }
  },
  components: {
    Modal,
    SubmitBtn,
    SelectBoxOne
  },
  props: {
    type: { type: String }
  },
  methods: {
    countSelectText (item) {
      const fileTitle = item.files_count > 1 ? 'Arquivo' : 'Arquivos'
      return item.title + ' ,  ' + item.files_count + ' ' + fileTitle
    },
    storeForm () {
      // PROCESSING
      this.form.set('processingForm', true)

      // VERIFY ERRORS
      const errorString = new ValidateForm(this.form.data(), this.getValidation, 'form')

      // IF HAS ERROR
      if (errorString.hasError()) {
        // RECORD ERRORS
        this.errors.addManyRecord(errorString.getError())

        // PROCESSING FALSE
        this.form.set('processingForm', false)
        return
      }

      this.$store.dispatch('adminPostSave/store_file_gallery', this.form.data()).then((res) => {
        // PROCESSING
        this.form.set('processingForm', false)

        // CREATE
        this.type === 'create' ? this.closeModel('createFileGallery')
          : this.closeModel('editFileGallery')

        // LOADING PAGE IS FALSE
        this.setLoadingPage(false)
      }).catch(error => {
        // PROCESSING
        this.form.set('processingForm', false)

        this.errors.record(error.errors, 'form')
      })
    },
    ...mapMutations('adminPostSave', {
      closeModel: 'CLOSE_MODAL'
    }),
    ...mapMutations('adminMain', {
      setLoadingPage: 'SET_LOADING_PAGE'
    })
  },
  computed: {
    getValidation () {
      return {
        gallery_id: {
          type: 'not-null',
          field_name: 'Galeria'
        },
        title: {
          type: 'not-null',
          field_name: 'Título'
        }
      }
    },
    textAction () {
      return this.type === 'create' ? 'Adcionar' : 'Alterar'
    },
    ...mapGetters('adminPostSave', {
      components: 'components',
      formOptions: 'formOptions'
    })

  },
  created () {
    // RESET FORM
    this.form.reset()

    const fileGallery = this.components('file_gallery')

    // SET ALL INPUT
    this.form.setFillItem(fileGallery)

    // FAZ O FOCUS NO PRIMEIRO INPUT
    this.$nextTick(() => {
      this.componentIsLoaded = true
    })

    /*   // FAZ O FOCUS NO PRIMEIRO INPUT
               this.$nextTick(() => this.$refs.fistinput.focus()); */
  }
}
</script>

<style scoped>

</style>
