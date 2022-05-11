
import { getAdminLocalUser } from '../../../helpers/auth'
export const user = getAdminLocalUser()

const state = {
  currentUser: user,
  loadingPage: true
}

const mutations = {
  'SET_LOADING_PAGE' (state, status) {
    state.loadingPage = status
  }
}

const actions = {

}

const getters = {
  loadingPage: loadingPage => {
    return state.loadingPage
  },
  currentUser: state => {
    return state.currentUser
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
