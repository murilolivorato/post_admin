<template>
    <modal  @close="closeModel('deleteImage')" >
        <template slot="header" ><h4>Deletar Imagem</h4></template>
        <template slot="body" >

            <form method="POST" action="" @submit.prevent="destroyImage">
                <div class="modal-body">
                    <p>Tem Certeza que deseja deletar esta Imagem ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="lightOne"  @click="closeModel('deleteImage')" >Fechar</button>
                    <submit-btn :processloading="processingForm"  textbutton="Deletar"  :stylebutton="'btn_cl_left is-link'"  ></submit-btn>
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
  name: 'ModalDeleteImage',
  components: {
    Modal,
    SubmitBtn
  },
  data () {
    return {
      imageIndex: null,
      processingForm: false
    }
  },
  methods: {
    destroyImage () {
      this.processingForm = true

      const wait = setTimeout(() => {
        clearTimeout(wait)

        this.$store.dispatch('adminPostSave/destroy_image', this.imageIndex).then((response) => {
          // PROCESSING FORM
          this.processingForm = false

          // CLOSE MODAL IMAGE
          this.closeModel('deleteImage')
        })
      }, 800)
    },
    ...mapMutations('adminPostSave', {
      closeModel: 'CLOSE_MODAL'
    })
  },
  computed: {
    ...mapGetters('adminPostSave', {
      imageFormBus: 'imageFormBus',
      components: 'components'

    })

  },
  created () {
    const index = this.imageFormBus.index
    // SET ALL INPUT
    this.imageIndex = index
  }
}
</script>

<style scoped>

</style>
