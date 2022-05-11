import axios from 'axios'
import { getLastPropLocation, getLastNewPropLocation, getLastPropSearchString, getLastNewPropSearchString, getLastPostSearchString } from '../../helpers/storage'
export const lastPropLocation = getLastPropLocation()

export const lastNewPropLocation = getLastNewPropLocation()

export const lastPropSearchString = getLastPropSearchString()

export const lastNewPropSearchString = getLastNewPropSearchString()

export const lastPostSearchString = getLastPostSearchString()

const state = {
  // MODAL
  modal: { login: false, image: false },
  loadingPage: false,
  selectedImage: '',
  scrowHeader: 'top',
  lastSearchLocations: { prop: lastPropLocation, newProp: lastNewPropLocation },
  lastSearchString: { prop: lastPropSearchString, newProp: lastNewPropSearchString, post: lastPostSearchString },
  menuMobileAreaStatus: false,
  // PAGE INFO
  pageInfo: {
    // LOAD
    SET_ONE_REGISTRATION: '/api/contact/register-one',
    SET_TWO_REGISTRATION: '/api/contact/register-two'
  },
  registerEmail: ''
}

const mutations = {
  'OPEM_MODAL' (state, type) {
    state.modal[type] = 'true'
  },
  'CLOSE_MODAL' (state, type) {
    state.modal[type] = false
  },
  'SET_IMAGE' (state, imageUrl) {
    state.selectedImage = imageUrl
    state.modal.image = true
  },
  'SET_LOADING_PAGE' (state, status) {
    state.loadingPage = status
  },
  'DETECT_PAGE_SCROW' (state) {
    window.onscroll = () => {
      if (window.scrollY > 700) {
        state.scrowHeader = 'top_fixed'
        return
      }
      state.scrowHeader = 'top'
    }
  },

  //  SEARCH_LOCATION_SESSION
  'SET_SEARCH_LOCATION_SESSION' (state, data) {
    if (data.name === 'prop') {
      localStorage.setItem('last_prop_location_search', JSON.stringify(data.data))
    }

    if (data.name === 'newProp') {
      localStorage.setItem('last_prop_new_location_search', JSON.stringify(data.data))
    }
  },
  'SET_SEARCH_LOCATION_DATA' (state, data) {
    state.lastSearchLocations[data.name] = data.data
  },
  //  SET_SEARCH_STRING_DATA
  //  SEARCH_LOCATION_SESSION
  'SET_SEARCH_STRING_SESSION' (state, data) {
    if (data.name === 'prop') {
      localStorage.setItem('last_prop_search_string', JSON.stringify({ query: data.query, path: data.path, page: data.page }))
    }

    if (data.name === 'newProp') {
      localStorage.setItem('last_new_prop_search_string', JSON.stringify({ query: data.query, path: data.path, page: data.page }))
    }

    if (data.name === 'post') {
      localStorage.setItem('last_post_search_string', JSON.stringify({ query: data.query, path: data.path, page: data.page }))
    }
  },
  'SET_SEARCH_STRING_DATA' (state, data) {
    state.lastSearchString[data.name] = { query: data.query, path: data.path, page: data.page }
  },
  'SET_MENU_MOBILE_AREA' (state) {
    if (state.menuMobileAreaStatus === false) {
      state.menuMobileAreaStatus = true
      return
    }

    state.menuMobileAreaStatus = false
  },
  'SET_REGISTRATION_EMAIL' (state, email) {
    state.registerEmail = email
  },
  'SET_EMPTY_REGISTRATION_EMAIL' (state) {
    state.registerEmail = ''
  }

}

const actions = {
  record_search_locations: ({ commit }, data) => {
    // SET STATUS
    commit('SET_SEARCH_LOCATION_SESSION', data)

    commit('SET_SEARCH_LOCATION_DATA', data)
  },
  record_search_string: ({ commit, getters }, data) => {
    const searchData = { name: data.name, query: data.query, path: getters.removeStrPage({ str: data.path, page: data.page }), page: data.page }

    // SET STATUS
    commit('SET_SEARCH_STRING_SESSION', searchData)

    commit('SET_SEARCH_STRING_DATA', searchData)
  },
  change_search_string_page: ({ commit, getters }, data) => {
    const searchData = { name: data.name, query: state.lastSearchString[data.name].query, path: state.lastSearchString[data.name].path, page: data.page }

    // SET STATUS
    commit('SET_SEARCH_STRING_SESSION', searchData)

    commit('SET_SEARCH_STRING_DATA', searchData)
  },
  store_one_register: ({ commit, getters }, data) => {
    return new Promise((resolve, reject) => {
      axios.post(state.pageInfo.SET_ONE_REGISTRATION, data)
        .then(response => {
          commit('SET_REGISTRATION_EMAIL', data.email)
          // RETURN REQUEST
          resolve(true)
        })
        .catch(error => {
          reject(error.response.data)
        })
    })
  },

  store_two_register: ({ commit, getters }, data) => {
    console.log(data)
    return new Promise((resolve, reject) => {
      axios.post(state.pageInfo.SET_TWO_REGISTRATION, data)
        .then(response => {
          commit('SET_EMPTY_REGISTRATION_EMAIL')
          // RETURN REQUEST
          resolve(true)
        })
        .catch(error => {
          reject(error.response.data)
        })
    })
  }

}

const getters = {
  modal: state => type => {
    return state.modal[type]
  },
  loadingPage: state => {
    return state.loadingPage
  },
  selectedImage: state => {
    return state.selectedImage
  },
  scrowHeader: state => {
    return state.scrowHeader
  },
  lastSearchLocations: state => {
    return state.lastSearchLocations
  },
  lastSearchString: state => {
    return state.lastSearchString
  },
  removeStrPage: state => data => {
    if (data.str.includes('&pagina=')) {
      return data.str.replace('&pagina=' + data.page, '')
    }
    if (data.str.includes('pagina=')) {
      return data.str.replace('pagina=' + data.page, '')
    }
    return data.str
  },
  menuMobileAreaStatus: state => {
    return state.menuMobileAreaStatus
  },
  registerEmail: state => {
    return state.registerEmail
  }

}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
