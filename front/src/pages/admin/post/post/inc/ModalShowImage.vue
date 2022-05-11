<template>
    <transition name="modal">
        <div class="modal-mask image-modal">
            <div class="modal-wrapper">
                <div id="modal-image-container" class="modal-container">
                    <a class="close-modal" @click="closeModel('showImage')" ></a>
                    <div class="modal-body" id="modal-image-body">
                        {{imageData}}
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'

export default {
  name: 'ModalShowImage',
  data () {
    return {
      image: { imageUrl: '', title: '' }

    }
  },
  methods: {
    ...mapMutations('adminPostSave', {
      closeModel: 'CLOSE_MODAL'
    })
  },
  computed: {
    ...mapGetters('adminPostSave', {
      showImageFormBus: 'showImageFormBus',
      components: 'components'
    }),
    imageData () {
      const image = new Image()

      image.onload = function () {
        const width = image.width
        const height = image.height
        const addClassName = width > height ? 'horizontal' : 'vertical'
        document.getElementById('modal-image-container').classList.add(addClassName)
        document.getElementById('modal-image-body').appendChild(image)
      }
      return this.image.imageUrl
    }

  },
  created () {
    this.image.imageUrl = this.showImageFormBus.image_url
    this.image.title = this.showImageFormBus.title
  }
}
</script>

<style scoped>

</style>
