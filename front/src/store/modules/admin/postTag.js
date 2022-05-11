
// CORS
import PageFilter from '../../../core/PageFilter'
import Pagination from '../../../core/Pagination'

import displayMutation from '../display/mutations'
import filterMutation from '../filter/mutations'
import dispayActions from '../display/actions'

import filterActions from '../filter/actions'
import displayGetters from '../display/getters'
import filterGetters from '../filter/getters'
import generalGetters from '../general/getters'

import crudActions from '../cruds/actions'
import crudMutation from '../cruds/mutations'
import axios from 'axios'

const state = {

  // PAGE INFO
  pageInfo: {
    URL_PATH: process.env.API_URL + '/assets/fotos/',

    PAGE_URL: '/area-administrativa/arquivos-de-noticias',
    TITLE_NAME: 'Arquivos de Notícia',
    TITLE_NAME_PLURAL: 'Arquivos de Notícias',

    LOAD_DISPLAY_URL: process.env.API_URL + 'api/admin/post-tag/load-display',
    STORE: process.env.API_URL + 'api/admin/post-tag/store',
    UPDATE: process.env.API_URL + 'api/admin/post-tag/update',
    DESTROY: process.env.API_URL + 'api/admin/post-tag/destroy',
    LOAD_FORM: process.env.API_URL + 'api/admin/post-tag/load-form',
    PRIMARY_KEY: 'id'

  },

  selectSearch: { title: { value: '', translated: 'titulo', type: 'list-text-value', is_unique_search: true } },

  /* PAGINATION */
  pagination:  { total: 0, per_page: 10, from: 1, to: 0, current_page: 1, last_page: 1, offset: 3, pagination_numbers: [] },

  /* ALL THE PROPERTIES TO BE DISPLAYED  */
  displayItems: [{ }],
  /* formList:new FormDisplay({id:'' , index:'' , title:'' }) , */

  /* FORM PRICE LIST */
  selectedIndex: null,
  selectedItems: [],

  primaryKey: 'id',

  loadingPage: true,

  toggleAllData: false,

  oldFilters: { filters: '', pagination: '' },
  modal: { create: false, delete: false, delete_many: false, edit: false, view: false },

  /* COMPONENT IS LOADED */
  componentIsLoaded: false

}

const mutations = {
  // CLEAR  SELECT SEARCH
  'CLEAR_ALL_FILTERS' (state) {
    state.selectSearch.resetField('title')
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
