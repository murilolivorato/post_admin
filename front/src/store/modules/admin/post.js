import axios from 'axios'

// CORS
import PageFilter from '../../../core/PageFilter'
import Pagination from '../../../core/Pagination'
import FormOptions from '../../../core/FormOptions'

import displayMutation from '../display/mutations'
import filterMutation from '../filter/mutations'
import dispayActions from '../display/actions'

import filterActions from '../filter/actions'
import displayGetters from '../display/getters'
import filterGetters from '../filter/getters'
import generalGetters from '../general/getters'
import crudActions from '../cruds/actions'
import crudMutation from '../cruds/mutations'

const state = {

  // PAGE INFO
  pageInfo: {
    PAGE_URL: '/admin/noticias',

    // TITLES
    TITLE_NAME: 'Notícia',
    TITLE_NAME_PLURAL: 'Notícias',

    // PATH
    URL_PATH: process.env.API_URL + '/assets/arquivos/posts',
    ICON_PATH: process.env.API_URL + '/assets/images/icons/',
    IMAGE_GALLERY_PATH: process.env.API_URL + '/assets/arquivos/galerias_de_imagens/',
    FILE_GALLERY_PATH: process.env.API_URL + '/assets/arquivos/arquivos/',
    TEMP_PATH: '/assets/temp/',

    // LOAD
    LOAD_FORM: process.env.API_URL + 'api/admin/post/load-form',
    LOAD_FORM_OPTIONS_URL: process.env.API_URL + 'api/admin/post/load-form-options',
    LOAD_DISPLAY_URL: process.env.API_URL + 'api/admin/post/load-display',

    // ACTIONS
    STORE: process.env.API_URL + 'api/admin/post/store',
    UPDATE: process.env.API_URL + 'api/admin/post/update',
    DESTROY: process.env.API_URL + 'api/admin/post/destroy',

    PRIMARY_KEY: 'id'
  },

  /* WILL SEACH AND PUTT THE DATA INSIDE HERE  */
  selectSearch: new PageFilter({
    title: { value: null, translated: 'titulo', type: 'list-text-value', is_unique_search: true },
    category: { value: [], translated: 'categoria' },
    post_user: { value: [], translated: 'usuario' },
    post_tag: { value: [], translated: 'arquivo' }
  }),

  /* PAGINATION */
  pagination: new { total: 0, per_page: 10, from: 1, to: 0, current_page: 1, last_page: 1, offset: 3, pagination_numbers: [] },

  /* ALL THE PROPERTIES TO BE DISPLAYED  */
  displayItems: [{ }],

  primaryKey: 'id',

  loadingPage: true,

  toggleAllData: false,
  selectedItems: [],
  oldFilters: { filters: '', pagination: '' },
  modal: { delete: false, delete_many: false, view: false },

  /* ALL OPTIONS GOES INSIDE HERE */
  formOptions: new { status: [], category: [], post_user: [], post_tag: [], image_gallery_style: [], image_gallery: [], file_gallery: [] },

  /* COMPONENT IS LOADED */
  componentIsLoaded: false
}

const mutations = {
  // CLEAR  SELECT SEARCH
  'CLEAR_ALL_FILTERS' (state) {
    state.selectSearch.resetField('title')
    state.selectSearch.resetField('category')
    state.selectSearch.resetField('post_user')
    state.selectSearch.resetField('post_tag')
  },
  'OPEM_MODAL' (state, type) {
    state.modal[type] = 'true'
  },
  'CLOSE_MODAL' (state, type) {
    state.modal[type] = false
  },
  ...displayMutation,
  ...filterMutation,
  ...crudMutation
}

const actions = {
  ...dispayActions,
  ...filterActions,
  ...crudActions,

  // LOAD EXTRA OPTIONS
  load_extra_options: ({ commit, state, getters }) => {
    const urlParamters = getters.urlParamterExtraOption({ city: getters.getSegment(2), neighborhood: getters.urlValue('bairro') })

    return new Promise((resolve, reject) => {
      // IF IS EMPTY URL PARAMTER
      if (!urlParamters) {
        resolve(true)
        return
      }

      axios.get(state.pageInfo.LOAD_EXTRA_OPTION_URL + '/' + urlParamters)
        .then(response => {
          commit('SET_FORM_OPTIONS', response.data)

          resolve(true)
        })
    }).catch(error => {
      console.log(error)
    })
  }

}

const getters = {
  ...displayGetters,
  ...filterGetters,
  ...generalGetters

}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
