// CORS
import FormOptions from '../../../core/FormOptions'
import FormDisplay from '../../../core/FormDisplay'

import { generalMutation } from '../form_display/generalMutation'
import { generalActions } from '../form_display/generalActions'
import { generalGetters } from '../form_display/generalGetters'

import { imageMutations } from '../form_display/imageMutations'
import { imageActions } from '../form_display/imageActions'
import { imageGetters } from '../form_display/imageGetters'

import { ShowImageMutations } from '../form_display/ShowImageMutations'
import { ShowImageGetters } from '../form_display/ShowImageGetters'

import { importImageGalleryMutations } from '../form_display/importImageGalleryMutations'
import { importImageGalleryActions } from '../form_display/importImageGalleryActions'
import { importImageGalleryGetters } from '../form_display/importImageGalleryGetters'

import { importFileGalleryMutations } from '../form_display/importFileGalleryMutations'
import { importFileGalleryActions } from '../form_display/importFileGalleryActions'
import { importFileGalleryGetters } from '../form_display/importFileGalleryGetters'

import { videoMutations } from '../form_display/videoMutations'
import { videoActions } from '../form_display/videoActions'
import { videoGetters } from '../form_display/videoGetters'

const state = {

  // ALL OPTIONS GOES INSIDE HERE
  formOptions: new { status: [], category: [], post_user: [], post_tag: [], image_gallery_style: [], image_gallery: [], file_gallery: [] },

  // MODAL
  modal: {
    showImage: false,
    createImage: false,
    editImageInfo: false,
    deleteImage: false,
    createVideo: false,
    editVideo: false,
    deleteVideo: false,
    createImageGallery: false,
    editImageGallery: false,
    deleteImageGallery: false,
    createFileGallery: false,
    editFileGallery: false,
    deleteFileGallery: false
  },

  // BUS
  showImageFormBus: { imageUrl: '', title: '' },
  imageFormBus: { index: null, name: '', description: '' },
  videoFormBus: { index: null },
  imageGalleryFormBus: { index: null },
  fileGalleryFormBus: { index: null },

  // IMAGES
  components: {
    images: [{ index: 0, id: 'temp', image: '', title: '', position: 1 }, { index: 1, id: 'temp', image: '', title: '', position: 1 }],
    image_gallery: { id: 'temp', gallery_id: '', title: '', description: '' },
    file_gallery: { id: 'temp', gallery_id: '', title: '', description: '' },
    video_gallery: []
  },

  imagesFromGallery: { folder: '', images: [] },
  filesFromGallery: { folder: '', files: [] },

  // PAGE INFO
  pageInfo: {

    PAGE_URL: '/area-administrativa/noticias',

    // TITLES
    TITLE_NAME: 'Notícia',
    TITLE_NAME_PLURAL: 'Notícias',

    // PATH
    ICON_PATH: process.env.API_URL + '/assets/images/icons',
    TEMP_PATH: process.env.API_URL + '/assets/temp',
    URL_PATH: process.env.API_URL + '/assets/arquivos/posts',
    FOLDER: '',

    IMAGE_GALLERY_PATH: process.env.API_URL + '/assets/arquivos/galerias_de_imagens/',
    FILE_GALLERY_PATH: process.env.API_URL + '/assets/arquivos/arquivos/',

    // LOAD
    LOAD_FORM: process.env.API_URL + 'api/admin/post/load-form',
    LOAD_FORM_OPTIONS_URL: process.env.API_URL + 'api/admin/post/load-form-options',

    LOAD_IMAGE_GALLERY: process.env.API_URL + 'api/admin/image-gallery/load-form',
    LOAD_FILE_GALLERY: process.env.API_URL + 'api/admin/file-gallery/load-form',
    UPLOAD_IMAGE: process.env.API_URL + 'api/admin/post/upload-images',

    // ACTIONS
    STORE: process.env.API_URL + 'api/admin/post/store',
    UPDATE: process.env.API_URL + 'api/admin/post/update',
    DESTROY: process.env.API_URL + 'api/admin/post/destroy'

  }

}

const mutations = {
  ...generalMutation,
  ...imageMutations,
  ...importImageGalleryMutations,
  ...importFileGalleryMutations,
  ...videoMutations,
  ...ShowImageMutations

}

const actions = {
  ...generalActions,
  ...imageActions,
  ...importImageGalleryActions,
  ...importFileGalleryActions,
  ...videoActions,
  reset_components: ({ commit, state }) => {
    commit('RESET_IMAGE', 0)
    commit('RESET_IMAGE', 1)
    commit('RESET_IMAGE_GALLERY')
    commit('RESET_FILE_GALLERY')
    commit('RESET_VIDEO_GALLERY')
  }
}

const getters = {
  ...generalGetters,
  ...imageGetters,
  ...importImageGalleryGetters,
  ...importFileGalleryGetters,
  ...videoGetters,
  ...ShowImageGetters
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
