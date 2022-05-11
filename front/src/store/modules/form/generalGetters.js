export default {
  formOptions: state => optionName => {
    return state.formOptions.get(optionName)
  },
  allFormOptions: state => {
    return state.formOptions
  },
  pageInfo: state => {
    return state.pageInfo
  },
  components: state => name => {
    return state.components.get(name)
  },
  allComponents: state => {
    return state.components.data()
  },
  allComponentsLoaded: state => name => {
    return state.allComponentsLoaded[name]
  },
  modal: state => name => {
    return state.modal[name]
  },
  componentIsLoaded: state => {
    return state.componentIsLoaded
  },
  storeFormURLsufix: state => data => {
    if (Object.prototype.hasOwnProperty.call(data, 'key')) {
      return data.key
    }

    if (Object.prototype.hasOwnProperty.call(data, 'id')) {
      return data.id
    }

    if (Object.prototype.hasOwnProperty.call(data, 'url_title')) {
      return data.url_title
    }

    return null
  },
  storeFormURL: state => data => {
    // CREATE
    if (data.action === 'create') {
      return state.pageInfo.STORE
    }

    // UPDATE
    if (data.update_sufix_url) {
      return state.pageInfo.UPDATE + '/' + data.update_sufix_url
    }

    return state.pageInfo.UPDATE
  },
  getCurrentUserHeader: state => userData => {
    if (!userData) {
      return null
    }

    if (!Object.prototype.hasOwnProperty.call(userData, 'user')) {
      return null
    }

    return { headers: { Authorization: 'Bearer ' + userData.token } }
  }

}
