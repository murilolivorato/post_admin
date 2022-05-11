export default {
  'OPEM_MODAL' (state, type) {
    state.modal[type] = 'true'
  },
  'CLOSE_MODAL' (state, type) {
    state.modal[type] = false
  },
  'CLOSE_ALL_MODALS' (state, type) {
    // SEARCH ALL FORM OPTIONS
    for (const prop in state.modal) {
      state.modal[prop] = false
    }
  },
  'SET_FOLDER' (state, folder) {
    state.pageInfo.FOLDER = folder
  },
  'SET_FORM' (state, data) {
    state[data.name].setAll(data.result)
  },
  'SET_COMPONENT' (state, data) {
    const name = data.name
    const value = data.value

    state.components[name] = value
  },
  'SET_ALL_COMPONENT' (state, data) {
    const name = data.name
    const value = data.value

    state.allComponentsLoaded[name] = value
  },
  'SET_COMPONENT_IS_LOADED' (state, data) {
    state.componentIsLoaded = data
  },
  'SET_FORM_OPTIONS' (state, data) {
    state.formOptions.setOptionValueAndKey(data)
  },
  'RELOAD_ONE_COMPONENT' (state, componentName) {
    state.allComponentsLoaded[componentName] = false
    const wait = setTimeout(() => {
      clearTimeout(wait)
      state.allComponentsLoaded[componentName] = true
    }, 400)
  },

  'RESET_FORM' (state) {
    state.form.reset()
  }
}
