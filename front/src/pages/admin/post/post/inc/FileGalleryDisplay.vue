<template>
    <div>
        <!-- columns -->
        <div class="columns" v-if="! componentIsEmpty" >
            <div class="column">

                <div  class="columns gallery_post_box" >
                    <div class="column">
                        <h3 class="title is-3" >{{ galleryInfo.title }} </h3>
                        <p class="subtitle is-6" >{{ galleryInfo.description  }} </p>
                        <ul id="display_gallery_images">

                            <li v-for="(item , index )  in filesFromGallery.files" :key="index" >

                                <file-thumb   :filename="item.file"
                                              :filepath="filePath(item)"
                                              :iconpath="pageInfo.ICON_PATH"   ></file-thumb>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- columns -->
                <div  class="columns" >
                    <div class="column">
                        <ul class="list_actions_btns">
                            <li>
                                <a class="hint--top edit_btn"  aria-label="Alterar Galeria" href="#"  @click.prevent="editFileGallery" >
                                    <font-awesome-icon icon="edit" />
                                </a>

                            </li>

                            <li>
                                <a class="hint--top delete_btn"  aria-label="Deletar Galeria" href="#"  @click.prevent="deleteFileGallery" >
                                    <font-awesome-icon icon="trash-alt"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end columns -->

            </div>
        </div>
        <!-- end columns -->

        <!-- columns -->
        <div class="columns" v-if="componentIsEmpty" >
            <div class="column">
                <p><a class='button is-primary btn-create-cpt-one'  href='#' @click.prevent="createFileGallery" >
                    <font-awesome-icon icon="file-alt"/>
                    Inserir Galeria de Arquivos
                </a></p>
            </div>
        </div>
        <!-- end columns -->

    </div>
</template>

<script>

import { mapGetters, mapMutations } from 'vuex'

import FileThumb from 'src/components/FileThumb'

export default {
  name: 'FileGalleryDisplay',
  data () {
    return {
      galleryInfo: {}
    }
  },
  components: {
    FileThumb
  },

  methods: {
    textAction () {
      return this.type === 'create' ? 'Adcionar' : 'Alterar'
    },
    filePath (item) {
      return this.pageInfo.FILE_GALLERY_PATH + '/' + this.filesFromGallery.folder
    },
    createFileGallery () {
      this.openModal('createFileGallery')
    },
    editFileGallery (item) {
      this.openModal('editFileGallery')
    },
    deleteFileGallery (item) {
      this.openModal('deleteFileGallery')
    },
    openImage (image) {
      this.setShowImageFormBus(image)
      this.openModal('showImage')

      /*  this.setImageGalleryFormBusEvent(index);
                  */
    },
    setImageGalleryFormBusEvent (index) {
      this.setImageGalleryFormBus({
        index: index
      })
    },
    ...mapMutations('adminMain', {
      setLoadingPage: 'SET_LOADING_PAGE'
    }),
    ...mapMutations('adminPostSave', {
      openModal: 'OPEM_MODAL',
      setImageGalleryFormBus: 'SET_IMAGE_GALLERY_FORM_BUS',
      setShowImageFormBus: 'SET_SHOW_IMAGE_FORM_BUS'
    })
  },
  computed: {
    componentIsEmpty () {
      return this.galleryInfo.gallery_id === ''
    },
    ...mapGetters('adminPostSave', {
      pageInfo: 'pageInfo',
      components: 'components',
      filesFromGallery: 'filesFromGallery'
    })

  },
  created () {
    this.galleryInfo = this.components('file_gallery')
  }

}
</script>

<style scoped>
    @import url("../../../../../../src/css/components/post_image_gallery.css");
    @import url("../../../../../../src/css/components/display_gallery_images.css");
</style>
