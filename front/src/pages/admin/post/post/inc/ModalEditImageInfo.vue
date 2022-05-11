<template>
    <modal  @close="closeModel('editImageInfo')"  >
        <template>
            <template slot="header" ><h4>Editar informações da Imagem</h4></template>
            <template slot="body" >

                <form method="POST" action="" @submit.prevent="updateImage">
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Título</label>
                            <input class="input" ref="fistinput" type="text"  v-model="ImageForm.title" placeholder="Título da Imagem" >
                        </div>

                        <div class="form-group">
                            <label>Posição da Imagem</label>
                        </div>

                        <div class="form-group">

                            <label class="radio radio-blue">
                                <input type="radio"  value="1" v-model="ImageForm.position">
                                <i></i>Esquerda
                            </label>

                            <label class="radio radio-blue">
                                <input type="radio"  value="2" v-model="ImageForm.position">
                                <i></i>Topo
                            </label>

                            <label class="radio radio-blue">
                                <input type="radio"  value="3" v-model="ImageForm.position">
                                <i></i>Esquerda
                            </label>

                            <label class="radio radio-blue">
                                <input type="radio"  value="4" v-model="ImageForm.position">
                                <i></i>Em Baixo
                            </label>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="lightOne"  @click="closeModel('editImageInfo')" >Fechar</button>
                        <submit-btn :processloading="ImageForm.get('processingForm')"  textbutton="Alterar"  :stylebutton="'btn_cl_left is-link'"  ></submit-btn>
                    </div>
                </form>

            </template>

        </template>
    </modal>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'

// COMPONENTS
import Modal from 'src/components/Modal'
import SubmitBtn from 'src/components/SubmitBtn'

// CORS
import FormDisplay from 'src/core/FormDisplay'
import Errors from 'src/core/Errors'

export default {
  name: 'ModalEditImageInfo',
  components: {
    Modal,
    SubmitBtn
  },
  data () {
    return {
      ImageForm: new FormDisplay({ index: '', id: '', image: '', title: '', position: 1 }),
      errors: new Errors()

    }
  },
  methods: {
    updateImage () {
      // PROCESSING
      this.ImageForm.set('processingForm', true)

      const data = this.ImageForm.data()

      const wait = setTimeout(() => {
        clearTimeout(wait)

        this.$store.dispatch('adminPostSave/update_image_info', data).then((response) => {
          // CLOSE MODAL IMAGE
          this.closeModel('editImageInfo')
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
    // RESET FORM
    this.ImageForm.reset()

    const index = this.imageFormBus.index
    const images = this.components('images')

    // SET ALL INPUT
    this.ImageForm.setFillItem(images[index])

    // FAZ O FOCUS NO PRIMEIRO INPUT
    this.$nextTick(() => this.$refs.fistinput.focus())
  }
}
</script>

<style scoped>

</style>
