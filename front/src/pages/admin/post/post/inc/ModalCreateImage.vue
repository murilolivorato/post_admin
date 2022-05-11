<template>
    <modal-upload   @close="closeModel('createImage')"  :loadingprocess="ImageForm.processingForm" >
        <template>
            <div v-if="! ImageForm.processingForm">

                <p>{{ imageFormBus.description }}</p>

                <form>
                    <div class="field">
                        <!-- is-primary -->
                        <div class="file is-primary is-centered">
                            <label class="file-label">
                                <input id="image_upload" class="file-input upload" type="file" name="image"  @change="storeImage">
                                <span class="file-cta">
                                      <span class="file-icon">
                                        <font-awesome-icon icon="images"/>
                                      </span>
                                      <span class="file-label">
                                        Faça o Upload
                                      </span>
                                    </span>
                            </label>
                        </div>
                        <!-- is-primary -->
                    </div>
                </form>

            </div>
        </template>
    </modal-upload>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'

import ModalUpload from 'src/components/ModalUpload'
import FormSet from 'src/core/FormSet'

export default {
  name: 'ModalCreateImage',
  data () {
    return {
      ImageForm: new FormSet({ index: null, id: '', image: null, title: '', position: 1 })
    }
  },
  components: {
    ModalUpload
  },
  methods: {
    storeImage () {
      this.ImageForm.processingForm = true
      const data = this.ImageForm.data()

      this.$store.dispatch('adminPostSave/store_image', data).then((response) => {
        // CLOSE MODAL IMAGE
        this.closeModel('createImage')
      })
    },
    ...mapMutations('adminPostSave', {
      closeModel: 'CLOSE_MODAL'
    })

  },
  computed: {
    ...mapGetters('adminPostSave', {
      imageFormBus: 'imageFormBus'

    })
  },
  created () {
    console.log('--->')
    console.log(this.imageFormBus)
    const index = this.imageFormBus.index

    // SET ALL INPUT
    this.ImageForm.set('index', index)
  }
}
</script>

<style scoped>

</style>
