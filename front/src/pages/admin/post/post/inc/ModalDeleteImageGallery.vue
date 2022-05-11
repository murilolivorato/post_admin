<template>
    <modal  @close="closeModel('deleteImageGallery')"  >
        <template slot="header" ><h2>Deletar Galeria de Imagem</h2></template>
        <template slot="body" >

            <form method="POST" action="" @submit.prevent="destroyImageGallery">
                <div class="modal-body">
                    <p>Tem Certeza que deseja deletar esta Galeria de Imagem ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="lightOne"  @click="closeModel('deleteImageGallery')" >Fechar</button>
                    <submit-btn :processloading="false"  textbutton="Deletar"  :stylebutton="'btn_cl_left is-link'"  ></submit-btn>
                </div>
            </form>
        </template>
    </modal>

</template>

<script>
import { mapGetters, mapMutations } from 'vuex'

import Modal from 'src/components/Modal'
import SubmitBtn from 'src/components/SubmitBtn'

export default {
  name: 'ModalDeleteImageGallery',
  components: {
    Modal,
    SubmitBtn
  },
  methods: {
    destroyImageGallery () {
      this.$store.dispatch('adminPostSave/destroy_image_gallery').then((response) => {
        // CLOSE MODAL IMAGE
        this.closeModel('deleteImageGallery')
      })
    },
    ...mapMutations('adminPostSave', {
      closeModel: 'CLOSE_MODAL'
    })
  },
  computed: {
    ...mapGetters('adminPostSave', {
      components: 'components'

    })

  }
}
</script>

<style scoped>

</style>
