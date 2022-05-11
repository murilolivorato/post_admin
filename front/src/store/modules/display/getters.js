
export default {
  /* modal: state =>  {
        return state.modal;
    } , */
  modal: state => type => {
    return state.modal[type]
  },
  pageLoading: state => {
    return state.loadingPage
  },
  formList: state => {
    return state.formList
  },
  formErrors (state, formName) {
    return state.errors.get(formName)
  },
  pagination: state => {
    return state.pagination
  },
  displayItems: state => {
    return state.displayItems
  },
  paginationData: state => {
    return state.pagination.data()
  },
  paginationTotal: state => {
    return state.pagination.pagination.total
  },
  toggleAllData: state => {
    return state.toggleAllData
  },
  selectedItems: state => {
    return state.selectedItems
  },
  formOptions: state => optionName => {
    return state.formOptions.get(optionName)
  },
  formOptionTitleFromId: state => data => {
    return state.formOptions.getTitleFromId(data.name, data.id)
  },
  tempOptions: state => optionName => {
    return state.tempOptions.get(optionName)
  },
  // HAS FILTER SELECTED
  hasFilterSelected: state => {
    return state.selectSearch.hasFilterSelected()
  },
  // SELECT SEARCH
  selectSearch: state => optionName => {
    return state.selectSearch.get(optionName)
  },
  // SELECT SEARCH
  allselectSearch: state => {
    return state.selectSearch.data()
  },

  // COMPONENT IS LOADED
  componentIsLoaded: state => {
    return state.componentIsLoaded
  },
  formOptionExtention: state => data => {
    if (!data) {
      return ''
    }
    return '?' + Object.keys(data) + '=' + data[Object.keys(data)]
  },
  firstLoad: state => data => {
    if (!data) {
      return true
    }

    if (!Object.prototype.hasOwnProperty.call(data, 'firstLoad')) {
      return true
    }

    return data.firstLoad
  },
  newSearchUniqueUrl: state => data => {
    return state.pageInfo.LOAD_UNIQUE_OPTION_URL + '?' + data.optionName + '=' + data.searchString
  },
  selectedIndex: state => {
    return state.selectedIndex
  }

}
