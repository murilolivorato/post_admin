<template>
    <modal  @close="closeModel('deleteVideo')"  >
        <template slot="header" ><h2>Deletar Vídeo</h2></template>
        <template slot="body" >

            <form method="POST" action="" @submit.prevent="destroyVideo">
                <div class="modal-body">
                    <p>Tem Certeza que deseja deletar este Vídeo ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="lightOne"  @click="closeModel('deleteVideo')" >Fechar</button>
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
  name: 'ModalDeleteVideo',
  components: {
    Modal,
    SubmitBtn
  },
  data () {
    return {
      videoIndex: null,
      processingForm: false
    }
  },
  methods: {
    destroyVideo () {
      this.processingForm = true

      const wait = setTimeout(() => {
        clearTimeout(wait)

        this.$store.dispatch('adminPostSave/destroy_video', this.videoIndex).then((response) => {
          // PROCESSING FORM
          this.processingForm = false

          // CLOSE MODAL IMAGE
          this.closeModel('deleteVideo')
        })
      }, 800)
    },
    ...mapMutations('adminPostSave', {
      closeModel: 'CLOSE_MODAL'
    })
  },
  computed: {
    ...mapGetters('adminPostSave', {
      videoFormBus: 'videoFormBus',
      components: 'components'

    })

  },
  created () {
    const index = this.videoFormBus.index
    // SET ALL INPUT
    this.videoIndex = index
  }
}
</script>

<style scoped>

</style>
