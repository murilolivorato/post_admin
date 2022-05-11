import axios from 'axios'

export default {
  store: ({ commit, state }, data) => {
    return new Promise((resolve, reject) => {
      const pageAction = data.action === 'create' ? state.pageInfo.STORE
        : state.pageInfo.UPDATE + '/' + data.data.id

      axios.post(pageAction, data.data)
        .then(response => {
          data.action === 'create' ? commit('SET_DATA_CREATED', response.data.new_record)
            : commit('SET_DATA_UPDATED', response.data.new_record)

          // RETURN REQUEST
          resolve(response.data)
        })

        .catch(error => {
          reject(error.response.data)
        })
    })
  },

  destroy: ({ commit, state }, data) => {
    return new Promise((resolve, reject) => {
      axios.post(state.pageInfo.DESTROY, data)
        .then(response => {
          commit('SET_DATA_DELETED', response.data)
          commit('RESET_SELECT_ITEMS')

          // RETURN REQUEST
          resolve(true)
        })

        .catch(error => {
          reject(error.response.data)
        })
    })
  }
}
