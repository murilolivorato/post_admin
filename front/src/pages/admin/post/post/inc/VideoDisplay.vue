<template>
    <div>

        <!-- columns -->
        <div class="columns"  v-if="! componentIsEmpty">
            <div class="column">

                    <div class="display_video" v-for="(video , index ) in videoList" :key="index" >
                            <!-- columns -->
                            <div  class="columns" >
                                <div class="column">

                                        <h3>{{ video.title }} </h3>
                                        <p>{{ video.description }} </p>

                                    <figure class="image is-16by9" >
                                        <iframe class="has-ratio" width="640" height="360" :src="videoUrl(video)" frameborder="0" allowfullscreen></iframe>
                                    </figure>

                                </div>
                            </div>
                           <!-- end columns -->

                        <!-- columns -->
                        <div class="columns">
                            <div class="column">
                                <ul class="list_actions_btns">
                                    <li>

                                        <a href="#" class="hint--bottom edit_btn" aria-label="Alterar Vídeo"  @click.prevent="editVideo(video)" >
                                            <font-awesome-icon icon="edit" />
                                        </a>

                                    </li>

                                    <li>
                                        <a href="#" class="hint--bottom delete_btn" aria-label="Deletar Vídeo" @click.prevent="deleteVideo(video)" >
                                            <font-awesome-icon icon="trash-alt"/>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end columns -->

                    </div>
                <!-- end display video -->
            </div>
        </div>
        <!--  end columns -->

        <!-- columns -->
        <div class="columns">
            <div class="column">
                <a :class="statusCreateButton"  href='#' @click.prevent="createVideo()" title='Alterar Vídeo' >
                    <font-awesome-icon icon="video"/>
                    Inserir Vídeo
                </a>
            </div>
        </div>
        <!-- end columns -->

    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'

export default {
  name: 'VideoDisplay',
  data () {
    return {
      videoList: [],
      max_number_videos: 5
    }
  },

  methods: {
    createVideo () {
      if (this.videoList.length < this.max_number_videos) {
        this.openModal('createVideo')
      }
    },
    editVideo (item) {
      this.setVideoFormBusEvent(item)
      this.openModal('editVideo')
    },
    deleteVideo (item) {
      this.setVideoFormBusEvent(item)
      this.openModal('deleteVideo')
    },
    videoUrl (video) {
      return video.video_website_id === 1 ? 'https://www.youtube.com/embed/' + video.reference.replace('https://youtu.be/', '')
        : 'https://player.vimeo.com/video/' + video.reference.replace('https://vimeo.com/', '')
    },
    ...mapMutations('adminMain', {
      setLoadingPage: 'SET_LOADING_PAGE'
    }),
    ...mapMutations('adminPostSave', {
      openModal: 'OPEM_MODAL',
      setVideoFormBus: 'SET_VIDEO_FORM_BUS'
    }),
    setVideoFormBusEvent (item, index = this.videoList.indexOf(item)) {
      this.setVideoFormBus({
        index: index
      })
    }
  },
  computed: {
    componentIsEmpty () {
      return !this.videoList.length
    },
    statusCreateButton () {
      return this.videoList.length >= this.max_number_videos ? 'button is-primary desable btn-create-cpt-one' : 'button is-primary btn-create-cpt-one '
    },
    ...mapGetters('adminPostSave', {
      pageInfo: 'pageInfo',
      components: 'components'
    })
  },
  created () {
    this.videoList = this.components('video_gallery')
  }
}
</script>

<style scoped>
  @import url("../../../../../../src/css/components/display_video.css");
</style>
