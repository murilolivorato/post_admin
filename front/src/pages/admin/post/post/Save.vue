<template>
    <div class="content">

        <!-- modal images -->
       <modal-create-image v-if="modal('createImage')"  ></modal-create-image>
       <modal-edit-image-info v-if="modal('editImageInfo')"  ></modal-edit-image-info>
       <modal-delete-image v-if="modal('deleteImage')"  ></modal-delete-image>

        <!--  modal videos -->
        <modal-save-video type="create" v-if="modal('createVideo')"  ></modal-save-video>
        <modal-save-video type="edit" v-if="modal('editVideo')"  ></modal-save-video>
        <modal-delete-video v-if="modal('deleteVideo')"  ></modal-delete-video>

        <!-- modal import image -->
        <modal-save-image-gallery type="create" v-if="modal('createImageGallery')"  ></modal-save-image-gallery>
        <modal-save-image-gallery type="edit" v-if="modal('editImageGallery')"  ></modal-save-image-gallery>
        <modal-delete-image-gallery  v-if="modal('deleteImageGallery')"  ></modal-delete-image-gallery>

        <!-- file gallery --->
        <modal-save-file-gallery type="create" v-if="modal('createFileGallery')"  ></modal-save-file-gallery>
        <modal-save-file-gallery type="edit" v-if="modal('editFileGallery')"  ></modal-save-file-gallery>
        <modal-delete-file-gallery  v-if="modal('deleteFileGallery')"  ></modal-delete-file-gallery>

        <!-- modal import image -->
        <modal-show-image  v-if="modal.showImage" ></modal-show-image>

        <!-- card -->
        <div class="card">

                <div class="card-header form-list-header">
                    <h3>{{ textAction }} Notícias</h3>
                </div>

                <!-- card-body -->
                <div class="card-body  card_form " >
                    <form class="main_form" @submit.prevent="storeForm()" >

                        <!-- tabs -->
                        <tabs :nametab="'tab_one'" :showstatus="true" >
                            <!-- tab -->
                            <tab name="Informações"  url_title="informacoes" :selected="true">

                                <fieldset>
                                    <legend>Informações</legend>

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="is-required">Status da Notícia </label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">

                                                <select-box-one v-model="form.status"
                                                                :selected="form.status"
                                                                :options="formOptions('status')"
                                                                :nametitleinput="'title'"
                                                                placeholder="Status" v-if="componentIsLoaded" ></select-box-one>

                                                <p class="error-msg" v-if="errors.has('form.status')" v-text="errors.get('form.status')" ></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- field block -->

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="is-required">Categoria da Notícia</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <select-box-one v-model="form.category_id"
                                                                :selected="form.category_id"
                                                                :options="formOptions('category')"
                                                                :nametitleinput="'title'"
                                                                placeholder="Categoria da Notícia" v-if="componentIsLoaded" ></select-box-one>

                                                <p class="error-msg" v-if="errors.has('form.category_id')" v-text="errors.get('form.category_id')" ></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- field block -->

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="is-required">Usuário de Notícia</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <select-box-one v-model="form.post_user_id"
                                                                :selected="form.post_user_id"
                                                                :options="formOptions('post_user')"
                                                                :nametitleinput="'title'"
                                                                placeholder="Usuário da Notícia" v-if="componentIsLoaded" ></select-box-one>

                                                <p class="error-msg" v-if="errors.has('form.post_user_id')" v-text="errors.get('form.post_user_id')" ></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- field block -->

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="is-required">Arquivo de Notícias</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <select-box-many v-model="form.post_tag_id"
                                                                 :selected="form.post_tag_id"
                                                                 :options="formOptions('post_tag')"
                                                                 :nametitleinput="'title'"
                                                                 placeholder="Arquivo da Notícia" v-if="componentIsLoaded"></select-box-many>

                                                <p class="error-msg" v-if="errors.has('form.post_tag_id')" v-text="errors.get('form.post_tag_id')" ></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- field block -->

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="is-required">Título</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <input class="form-control"  v-model="form['title']"  placeholder="Título"  type="text"  >
                                                <p class="error-msg" v-if="errors.has('form.title')" v-text="errors.get('form.title')" ></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- field block -->

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label>Sub Título</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <input class="form-control border-input"  v-model="form['sub_title']"  placeholder="Título"  type="text"  >
                                                <p class="error-msg" v-if="errors.has('form.sub_title')" v-text="errors.get('form.sub_title')" ></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- field block -->

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                          <label>Data</label>
                                        </div>
                                        <div class="field-body">
                                            <date-picker format="DD/MM/YYYY" class="form-control border-input"  value-type="YYYY.MM.DD" v-model="form['post_date']" type="date"  placeholder="Selecione a Data"></date-picker>
                                            <!--  <div class="q-pa-md">
                                                <div class="q-mb-sm">
                                                  <q-badge color="teal">
                                                     {{ form['post_date'] }}
                                                  </q-badge>
                                                </div>
                                                <q-btn icon="event" round color="primary">
                                                  <q-popup-proxy  transition-show="scale" transition-hide="scale">
                                                    <q-date v-model="form['post_date']">
                                                      <div class="row items-center justify-end q-gutter-sm">
                                                        <q-btn label="Cancel" color="primary" flat v-close-popup />
                                                        <q-btn label="OK" color="primary" flat  v-close-popup />
                                                      </div>
                                                    </q-date>
                                                  </q-popup-proxy>
                                                </q-btn>
                                              </div>-->
                                              <p class="error-msg" v-if="errors.has('form.post_date')" v-text="errors.get('form.post_date')"  ></p>
                                       </div>
                                    <!-- field-body -->
                                    </div>
                                </fieldset>

                            </tab>
                            <!-- END TAB -->

                            <!-- TAB -->
                            <tab name="Textos"  url_title="textos" >

                                <fieldset>
                                    <legend>Textos</legend>

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="is-required">Descrição</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <textarea class="textarea"  placeholder="Escreva aqui a descrição da Notícia"  v-model="form['description']"></textarea>
                                                <span class="error-msg" v-if="errors.has('form.description')" v-text="errors.get('form.description')"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- field block -->

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label>Chamada</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <textarea class="textarea"  placeholder="Escreva aqui a chamada da Notícia"  v-model="form['short_description']"></textarea>
                                                <span class="error-msg" v-if="errors.has('form.short_description')" v-text="errors.get('form.short_description')"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- field block -->

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label>Key Words</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <textarea class="textarea"  placeholder="Google Key Words"  v-model="form['key_words']"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- field block -->

                                </fieldset>
                            </tab>

                            <!-- mídias -->
                            <tab name="Midias"  url_title="midias" >

                                <fieldset>
                                    <legend>Mídias</legend>

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label>Imagem 1</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">

                                                <image-display  :imageindex="0"
                                                                description="'Tamanho Aconselhável - 830 px x 314 px"
                                                                name="Imagem 1"
                                                                v-if="componentIsLoaded" >
                                                </image-display>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- field block -->

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label>Imagem 2</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">

                                                <image-display  :imageindex="1"
                                                                description="Tamanho Aconselhável - Tamanho Aconselhável - 268 px de Largura"
                                                                name="Imagem 2"
                                                                v-if="componentIsLoaded" >
                                                </image-display>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- field block -->

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label>Importar Galeria de Imagem</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <image-gallery-display v-if="componentIsLoaded"  ></image-gallery-display>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- field block -->

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label>Importar Galeria de Arquivos</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">

                                                <file-gallery-display v-if="componentIsLoaded"  ></file-gallery-display>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- field block -->

                                    <!-- field block -->
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label>Vídeo</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">

                                                    <video-display v-if="componentIsLoaded"  ></video-display>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- field block -->

                                </fieldset>

                            </tab>
                            <!-- END TAB -->

                        </tabs>
                        <!-- END TABS -->

                        <div class="columns" v-if="hasErrors">
                            <div class="column">
                                <p class="has-error-msg" >CONFIRA OS ERRORS A CIMA</p>

                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <submit-btn :processloading="form.get('processingForm')" :textbutton="textAction"  stylebutton="btn_cl_left is-link"  ></submit-btn>
                            </div>
                        </div>

                    </form>

            </div>
        </div>
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'

import FormDisplay from 'src/core/FormDisplay'
import Tabs from 'src/components/Tabs'
import Tab from 'src/components/Tab'
import Errors from 'src/core/Errors'
import SubmitBtn from 'src/components/SubmitBtn'
import SelectBoxOne from 'src/components/SelectBoxOne'
import SelectBoxMany from 'src/components/SelectBoxMany'

// POST COMPONENTS
import VideoDisplay from './inc/VideoDisplay'
import ModalSaveVideo from './inc/ModalSaveVideo'
import ModalDeleteVideo from './inc/ModalDeleteVideo'

import ImageGalleryDisplay from './inc/ImageGalleryDisplay'
import ModalSaveImageGallery from './inc/ModalSaveImageGallery'
import ModalDeleteImageGallery from './inc/ModalDeleteImageGallery'

import FileGalleryDisplay from './inc/FileGalleryDisplay'
import ModalDeleteFileGallery from './inc/ModalDeleteFileGallery'
import ModalSaveFileGallery from './inc/ModalSaveFileGallery'

// MODAL IMAGES
import ImageDisplay from './inc/ImageDisplay'
import ModalCreateImage from './inc/ModalCreateImage'
import ModalEditImageInfo from './inc/ModalEditImageInfo'
import ModalDeleteImage from './inc/ModalDeleteImage'

// SHOW BIG IMAGE
import ModalShowImage from './inc/ModalShowImage'

export default {
  name: 'Save',
  data () {
    return {
      form: new FormDisplay({ id: '', status: 'active', category_id: '', post_user_id: '', post_tag_id: [], post_date: '', title: '', sub_title: '', url_title: '', short_description: '', description: '', key_words: '', folder: '' }),
      componentIsLoaded: false,
      action: '',
      errors: new Errors()

    }
  },
  components: {
    Tabs,
    Tab,
    SubmitBtn,
    ImageDisplay,
    ModalCreateImage,
    ModalEditImageInfo,
    ModalDeleteImage,
    VideoDisplay,
    ModalSaveVideo,
    ModalDeleteVideo,
    ImageGalleryDisplay,
    ModalSaveImageGallery,
    ModalDeleteImageGallery,
    ModalShowImage,
    FileGalleryDisplay,
    ModalSaveFileGallery,
    ModalDeleteFileGallery,
    SelectBoxOne,
    SelectBoxMany
  },
  methods: {
    setDataLOaded () {
      // set the component is loaded
      this.componentIsLoaded = true

      // loading page is false
      this.setLoadingPage(false)
    },
    storeForm () {
      // PROCESSING
      this.form.set('processingForm', true)

      const data = { data: this.form.data(), action: this.action }

      this.$store.dispatch('adminPostSave/store', data).then((res) => {
        // PROCESSING
        this.form.set('processingForm', false)

        // RESET
        this.form.reset()

        // SUCCESS MESSAGE
        this.$swal({
          icon: 'success',
          title: 'Notícia Cadastrada com Sucesso',
          showConfirmButton: false,
          timer: 2000
        }).then(() => this.$router.push({ name: 'PostDisplay' }))
      }).catch(error => {
        // PROCESSING
        this.form.set('processingForm', false)

        this.errors.record(error.errors, 'form')
      })
    },
    // LOAD PAGE
    loadPage () {
      // shows
      Promise.all([
        this.$store.dispatch('adminPostSave/reset_components'),
        // SET FILTERS
        this.$store.dispatch('adminPostSave/load_form_options')

      ]).then((res) => {
        // IS CREATING
        if (this.action === 'create') {
          return this.setDataLOaded()
        }

        // IS EDITING
        this.$store.dispatch('adminPostSave/load_form', this.$route.params.id).then((res) => {
          // SET FOLDER
          this.setFolder(res.folder)

          // IMAGE 1
          if (res.images[0].id !== 'temp') {
            this.addImage(res.images[0])
          }

          // IMAGE 2
          if (res.images[1].id !== 'temp') {
            this.addImage(res.images[1])
          }

          // VIDEO
          if (res.video_gallery.length) {
            res.video_gallery.forEach((item, i) => {
              this.createVideo(item)
            })
          }

          // STORE_IMAGE GALLERY
          if (res.image_gallery.id !== 'TEMP') {
            this.$store.dispatch('adminPostSave/store_image_gallery', res.image_gallery)
          }

          // STORE_IMAGE GALLERY
          if (res.file_gallery.id !== 'TEMP') {
            this.$store.dispatch('adminPostSave/store_file_gallery', res.file_gallery)
          }

          // SET ALL FORM
          this.form.setAll(res)
          return this.setDataLOaded()
        })
      })
    },

    ...mapMutations('adminPostSave', {
      /* resetComponents:'RESET_COMPONENTS' , */
      setFolder: 'SET_FOLDER',
      addImage: 'ADD_IMAGE',
      createVideo: 'CREATE_VIDEO'
    }),
    ...mapMutations('adminMain', {
      setLoadingPage: 'SET_LOADING_PAGE'
    })
  },
  computed: {
    ...mapGetters('adminPostSave', {
      pageInfo: 'pageInfo',
      formOptions: 'formOptions',
      modal: 'modal',
      components: 'components'

    }),
    hasErrors () {
      return this.errors.any()
    },
    textAction () {
      return this.action === 'create' ? 'Criar' : 'Editar'
    }
  },

  mounted: function () {
    this.action = this.$route.meta.action

    // load PAGE
    this.loadPage()
  }
}
</script>

<style scoped>

</style>
