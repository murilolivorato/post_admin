import axios from 'axios'

export default {
  // LOAD FORM OPTIOONS
  load_form_options: ({ commit, state }) => {
    return new Promise((resolve, reject) => {
      axios.get(state.pageInfo.LOAD_FORM_OPTIONS_URL)
        .then(response => {
          commit('SET_FORM_OPTIONS', response.data)
          /* state.formOptions.setOptionValueAndKey(response.data); */

          resolve(true)
        })
    }).catch(error => {
      console.log(error)
    })
  },

  load_extra_options: ({ commit, state, getters }, data) => {
    const url = getters.urlParamterExtraOption(data)

    return new Promise((resolve, reject) => {
      // IF IS EMPTY URL PARAMTER
      if (!url) {
        resolve(true)
        return
      }

      axios.get(url)
        .then(response => {
          commit('SET_FORM_OPTIONS', response.data)

          resolve(true)
        })
    }).catch(error => {
      console.log(error)
    })
  },

  // LOAD FORM
  load_form: ({ commit, state }, paramter) => {
    const url = paramter != null ? state.pageInfo.LOAD_FORM + '/' + paramter
      : state.pageInfo.LOAD_FORM

    return new Promise((resolve, reject) => {
      axios.get(url)
        .then(response => {
          console.log('-->')
          console.log(response.data)
          resolve(response.data)
        }).catch(error => {
          console.log(error)
        })
    })
  },

  // SET FORM
  set_form: ({ commit, state }, data) => {
    return new Promise((resolve, reject) => {
      axios.get(state.pageInfo.LOAD_FORM + '/' + data.paramter)
        .then(response => {
          // HIDE RESULT
          commit('SET_FORM', { result: response.data, name: data.name })
          resolve(response.data)
        }).catch(error => {
          console.log(error)
        })
    })
  },

  //  STORE
  store: ({ commit, state, getters }, data) => {
    const updateSufix = getters.storeFormURLsufix(data)
    const pageActionURL = getters.storeFormURL({ ...{ action: data.action }, ...{ update_sufix_url: updateSufix } })

    return new Promise((resolve, reject) => {
      axios.post(pageActionURL, data.data)
        .then(response => {
          // RETURN REQUEST
          resolve(response.data)
        })

        .catch(error => {
          console.log(error.response.data)
          reject(error.response.data)
        })
    })
  },

  reload_one_component: ({ commit, state }, componentName) => {
    return new Promise((resolve, reject) => {
      state.allComponentsLoaded[componentName] = false

      const wait = setTimeout(() => {
        clearTimeout(wait)
        state.allComponentsLoaded[componentName] = true
        resolve(true)
      }, 800)

      /*  // RELOAD COMPONENT
            commit('RELOAD_ONE_COMPONENT' , componentName); */
    }).catch(error => {
      console.log(error)
    })
  }

}
