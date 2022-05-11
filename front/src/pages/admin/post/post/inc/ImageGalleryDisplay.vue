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
                                <li v-for="(item , index )  in imagesFromGallery.images"  :key="index" >

                                       <img-thumb   :imageurl="imageUrl(item)"
                                                    stylelist="list_gallery_post"
                                                    title="item.title"
                                                    :index="index"
                                                    @openimage="openImage"  ></img-thumb>
                                </li>
                            </ul>
                    </div>
                </div>

                <!-- columns -->
                <div  class="columns" >
                    <div class="column">
                        <ul class="list_actions_btns">
                            <li>
                                <a class="hint--top edit_btn"  aria-label="Alterar Galeria" href="#"  @click.prevent="editImageGallery" >
                                    <font-awesome-icon icon="edit" />
                                </a>
                            </li>

                            <li>
                                <a class="hint--top delete_btn"  aria-label="Deletar Galeria" href="#"  @click.prevent="deleteImageGallery" >
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
                    <p><a class='button is-primary btn-create-cpt-one'  href='#' @click.prevent="createImageGallery" title='Inserir Imagem'>
                        <font-awesome-icon icon="images"/>
                        Inserir Galeria de Imagens
                    </a></p>
                </div>
            </div>
            <!-- end columns -->

    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'

import ImgThumb from 'src/components/ImgThumb'

export default {
  name: 'ImageGalleryDisplay',
  data () {
    return {
      galleryInfo: {}
      /* galleryImages : {} */
    }
  },
  components: {
    ImgThumb
  },

  methods: {
    textAction () {
      return this.type === 'create' ? 'Adcionar' : 'Alterar'
    },
    imageUrl (item) {
      return this.pageInfo.IMAGE_GALLERY_PATH + '/' + this.imagesFromGallery.folder + '/' + item.image
    },
    createImageGallery () {
      this.openModal('createImageGallery')
    },
    editImageGallery (item) {
      this.openModal('editImageGallery')
    },
    deleteImageGallery (item) {
      this.openModal('deleteImageGallery')
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
      imagesFromGallery: 'imagesFromGallery'
    })

  },
  created () {
    this.galleryInfo = this.components('image_gallery')
  }

}
</script>

<style scoped>
  @import url("../../../../../../src/css/components/post_image_gallery.css");
  @import url("../../../../../../src/css/components/display_gallery_images.css");
</style>
