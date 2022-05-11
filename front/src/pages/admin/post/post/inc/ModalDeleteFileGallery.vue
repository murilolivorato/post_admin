<template>
    <modal  @close="closeModel('deleteFileGallery')"  >
        <template slot="header" ><h2>Deletar Galeria de Arquivos</h2></template>
        <template slot="body" >

            <form method="POST" action="" @submit.prevent="destroyFileGallery">
                <div class="modal-body">
                    <p>Tem Certeza que deseja deletar esta Galeria de Arquivo ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="lightOne"  @click="closeModel('deleteFileGallery')" >Fechar</button>
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
  name: 'ModalDeleteFileGallery',
  components: {
    Modal,
    SubmitBtn
  },
  data () {
    return {
      processingForm: false
    }
  },
  methods: {
    destroyFileGallery () {
      this.processingForm = true

      const wait = setTimeout(() => {
        clearTimeout(wait)

        this.$store.dispatch('adminPostSave/destroy_file_gallery').then((response) => {
          this.processingForm = false

          // CLOSE MODAL IMAGE
          this.closeModel('deleteFileGallery')
        })
      }, 800)
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
