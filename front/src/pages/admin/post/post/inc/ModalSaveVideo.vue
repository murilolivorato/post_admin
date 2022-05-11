<template>
    <modal    @close="closeVideoModal()"  >
        <template slot="header" ><h2>{{ textAction }} Vídeo</h2></template>
        <template slot="body" >

            <form method="POST"  @submit.prevent="storeForm()">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Site do Vídeo</label>
                    </div>

                    <div class="form-group">
                        <label class="radio radio-blue">
                            <input type="radio"  value="1" v-model="form.video_website_id">
                            You Tube
                        </label>

                        <label class="radio radio-blue">
                            <input type="radio"  value="2" v-model="form.video_website_id">
                            Vímeo
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Url do Vídeo</label>
                        <p class="control has-icons-right">

                            <input class="input" type="text"  v-model="form.reference" :placeholder="videoPlanceHolder">
                            <span class="icon is-small is-right icon_check_ok" v-if="videoReferenceOK" >
                                  <font-awesome-icon icon="check"  />
                             </span>

                        </p>
                        <p class="error-msg" v-if="errors.has('form.reference')" v-text="errors.get('form.reference')"></p>

                    </div>

                    <div class="form-group">
                        <label>Título</label>
                        <input class="input" type="text"  v-model="form.title" placeholder="Título do Vídeo ( Opcional ) ">
                    </div>

                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="textarea"  rows="3" cols="50" v-model="form.description" placeholder="Descrição do Vídeo ( Opcional )"  ></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="button is-light" @close="closeVideoModal()"  >Fechar</button>
                    <submit-btn :processloading="form.get('processingForm')"
                                :stylebutton="'btn_cl_left is-link'"
                                :textbutton="textAction" ></submit-btn>
                </div>
            </form>

        </template>
    </modal>
</template>

<script>

import { mapGetters, mapMutations } from 'vuex'
import FormDisplay from 'src/core/FormDisplay'
import Errors from 'src/core/Errors'
import SubmitBtn from 'src/components/SubmitBtn'
import Modal from 'src/components/Modal'
import ValidateForm from 'src/core/ValidateForm'

export default {
  name: 'ModalSaveVideo',
  props: {
    type: { type: String }
  },
  components: {
    SubmitBtn,
    Modal
  },
  data () {
    return {
      form: new FormDisplay({ index: '', id: 'temp', video_website_id: 1, title: '', description: '', reference: '' }),
      errors: new Errors(),
      videoReferenceMustContain: { youtube: 'https@//youtu.be/', vimeo: 'https@//player.vimeo.com/video/' },
      videoTypeFormError: { youtube: 'deve começar com - https://youtu.be/ ...', vimeo: 'deve começar com - https://player.vimeo.com/video/ ...' },
      videoReferenceOK: false
    }
  },
  methods: {
    storeForm () {
      // SETTING PROCESSING FALSE
      this.form.set('processingForm', true)

      // VERIFY ERRORS
      const errorString = new ValidateForm(this.form.data(), this.getValidateForm, 'form')

      // IF HAS ERROR
      if (errorString.hasError()) {
        // RECORD ERRORS
        this.errors.addManyRecord(errorString.getError())

        // PROCESSING FALSE
        this.form.set('processingForm', false)
        return
      }

      const data = { data: this.form.data(), action: this.type }

      const wait = setTimeout(() => {
        clearTimeout(wait)

        this.$store.dispatch('adminPostSave/store_video', data).then((res) => {
          // SETTING PROCESSING FALSE
          this.form.set('processingForm', false)

          // CLOSE MODAL
          this.closeVideoModal()
        })
      }, 800)
    },
    closeVideoModal () {
      if (this.type === 'create') {
        this.closeModal('createVideo')
        return
      }
      this.closeModal('editVideo')
    },

    validateVideoForm () {
      // VERIFY ERRORS
      const errorString = new ValidateForm(this.form.data(), this.getValidateForm, 'form')

      // IF HAS ERROR
      if (errorString.hasError()) {
        this.videoReferenceOK = false
        return false
      }

      // IF HAS ERROR , CLEAR IT
      if (this.errors.has('videoForm.reference')) {
        this.errors.clearField('videoForm.reference')
      }

      // SET REFERENCE ICON
      this.videoReferenceOK = true
      return true
    },

    ...mapMutations('adminPostSave', {
      closeModal: 'CLOSE_MODAL'
    })

  },
  computed: {
    getValidateForm () {
      return {
        reference: {
          type: 'not-null|must-contain:' + this.videoReferenceMustContainText,
          field_name: 'Url do Vídeo'
        }
      }
    },
    videoReferenceMustContainText () {
      // YOUTUBE
      if (this.form.video_website_id === 1) {
        return this.videoReferenceMustContain.youtube
      }

      // VIMEO
      return this.videoReferenceMustContain.vimeo
    },
    processAction () {
      return this.type === 'edit' ? 'update_video' : 'store_video'
    },
    videoPlanceHolder () {
      // YOUTUBE
      if (this.form.video_website_id === 1) {
        return this.videoTypeFormError.youtube
      }

      // VIMEO
      return this.videoTypeFormError.vimeo
    },
    textAction () {
      return this.type === 'edit' ? 'Editar' : 'Criar'
    },
    modalName () {
      return this.type === 'edit' ? 'editVideo' : 'createVideo'
    },
    ...mapGetters('adminPostSave', {
      selectedIndex: 'selectedIndex',
      formData: 'form',
      components: 'components',
      videoFormBus: 'videoFormBus'
    })
  },
  created () {
    // RESET ERRORS IF HAS
    this.errors.reset()

    if (this.type === 'edit') {
      // VIDEO GALLLERIES
      const videoGalllery = this.components('video_gallery')

      // SET ALL INPUT
      this.form.setFillItem(videoGalllery[this.videoFormBus.index])
    }

    // FAZ O FOCUS NO PRIMEIRO INPUT
    /* this.$nextTick(() => this.$refs.fistinput.focus()); */
  },
  watch: {
    'form.video_website_id': function (val) {
      this.validateVideoForm()
    },
    'form.reference': function (val) {
      this.validateVideoForm()
    }
  }
}
</script>

<style scoped>

    span.icon_check_ok svg {
        color:#147d25;
        font-size:17px;
        margin-top:26px;
        margin-right:14px;
    }
</style>
