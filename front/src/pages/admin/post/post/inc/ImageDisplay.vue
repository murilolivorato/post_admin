<template>
    <div>

        <!-- columns -->
        <div class="display_img columns" v-if="! componentIsEmpty">
                <div class="column">

                    <div class="columns top_img_display">
                        <div class="column">

                            <img-thumb   :imageurl="imageUrlDisplay"
                                         stylethumb="imgthumb1"
                                         :index="imageindex"
                                         title="image['title']"
                                         :stylelist="'list_img_post'"
                                         @openimage="openImage"  ></img-thumb>

                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                                <ul class="list_actions_btns">
                                    <li>
                                        <a  href='#' class="hint--bottom list_btn"  aria-label="Alterar Imagem" @click.prevent="createImage()" >
                                            <font-awesome-icon icon="list-alt" />
                                        </a>
                                    </li>

                                    <li>
                                        <a  href="#" class="hint--bottom edit_btn" aria-label="Editar Informações"  @click.prevent="editImageInfo()"   >
                                            <font-awesome-icon icon="edit" />
                                        </a>
                                    </li>

                                    <li>
                                        <a  href="#" class="hint--bottom delete_btn" aria-label="Deletar"  @click.prevent="deleteImage()"     >
                                            <font-awesome-icon icon="trash-alt"/>
                                        </a>
                                    </li>

                                </ul>
                        </div>
                    </div>

                </div>
        </div>
        <!-- end columns -->

        <!-- columns -->
        <div class="columns" v-if="componentIsEmpty" >
            <div class="column">

                    <p><a class='button is-primary btn-create-cpt-one'  href='#' @click.prevent="createImage" title='Inserir Imagem'>
                        <font-awesome-icon icon="images"/>
                        Inserir {{ name }}
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
  name: 'ImageDisplay',
  components: {
    ImgThumb
  },
  props: {
    imageindex: { type: Number },
    description: { type: String, default: null },
    name: { type: String }
  },
  methods: {
    openImage (image) {
      this.setShowImageFormBus(image)
      this.openModal('showImage')
      /* this.$emit('openimage', this.imageUrlDisplay ); */
    },
    createImage () {
      this.setImageFormBusEvent()
      this.openModal('createImage')
    },
    editImageInfo () {
      this.setImageFormBusEvent()
      this.openModal('editImageInfo')
    },
    deleteImage () {
      this.setImageFormBusEvent()
      this.openModal('deleteImage')
    },
    setImageFormBusEvent () {
      this.setImageFormBus({
        index: this.imageindex,
        name: this.name,
        description: this.description
      })
    },
    ...mapMutations('adminMain', {
      setLoadingPage: 'SET_LOADING_PAGE'
    }),
    ...mapMutations('adminPostSave', {
      openModal: 'OPEM_MODAL',
      setImageFormBus: 'SET_IMAGE_FORM_BUS',
      setShowImageFormBus: 'SET_SHOW_IMAGE_FORM_BUS'
    })
  },
  computed: {
    imageData () {
      return this.components('images')
    },
    image () {
      return this.imageData[this.imageindex]
    },
    imagePath () {
      return this.image.id !== 'temp' ? this.pageInfo.URL_PATH + '/' + this.pageInfo.FOLDER + '/'
        : this.pageInfo.TEMP_PATH + '/'
    },
    imageUrlDisplay () {
      return this.imagePath + this.image.image
    },
    componentIsEmpty () {
      return this.image.image === ''
    },
    ...mapGetters('adminPostSave', {
      pageInfo: 'pageInfo',
      components: 'components'
    })

  }

}
</script>

<style scoped>
    .list_actions_btns {
        width:100px;
    }
</style>
