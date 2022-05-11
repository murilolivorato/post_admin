export default {
  'SET_FILTER_DISPLAY' (state, data) {
    state.selectSearch.set(data.prop, data.valueFilter)
  },
  'SET_DISPLAY_DATA' (state, data) {
    state.displayItems = data
  },
  'SET_DISPLAY_PAGINATION' (state, data) {
    state.pagination.loadData(data)
  },
  'SET_DISPLAY_PAGINATION_NUMBERS' (state) {
    state.pagination.setPagesNumber()
  },
  'SET_DISPLAY_PAGINATION_CHANGED' (state, pageNumber) {
    state.pagination.changePage(pageNumber)
  },
  'SET_DISPLAY_LOADING_PAGE' (state, status) {
    state.loadingPage = status
  },
  'SET_DISPLAY_SEARCH_URL' (state, newUrl) {
    state.searchUrl = newUrl
  },
  'SET_DISPLAY_OLD_FILTER' (state, filter) {
    state.oldFilters = filter
  },
  'SET_FORM' (state, item, index = state.displayItems.indexOf(item)) {
    state.formList.setFillItem(item, index)
  },
  'RECORD_ERRORS' (state, errors) {
    // PROCESSING IS FALSE
    state.form.processingForm = false
    // RECORD ERRORS
    state.errors.record(errors.error_list.errors, 'form')
  },
  'SET_COMPONENT_IS_LOADED' (state, data) {
    state.componentIsLoaded = data
  },
  'SET_TOOGLE' (state, data) {
    state.toggleAllData = data
  },
  'SET_SELECT_ITEM' (state, item, index = state.displayItems.indexOf(item)) {
    state.selectedItems = []
    state.selectedItems.push(index)
  },
  'SET_SELECT_MANY_ITEM' (state, indexes) {
    state.selectedItems = indexes
  },
  'SET_DATA_CREATED' (state, data) {
    // SET NEW TOTAL PAGE
    const newTotalPage = state.pagination.get('total') + 1
    state.pagination.set('total', newTotalPage)

    // get all fields dinamic from request
    state.displayItems.unshift(data)
  },
  'SET_FILTER' (state, data) {
    state.selectSearch.set(data.name, data.value)
    state.pagination.changePage(1)
  },
  'REMOVE_FILTER_ELEMENT' (state, data) {
    state.selectSearch.removeElementFromFilter(data.name, data.value)
  },
  'RESET_SEARCH' (state) {
    state.selectSearch.reset()
  },
  'SET_HAS_FILTERS' (state, data) {
    state.hasFilterSelected = false
  },
  'SET_VERIFY_HAS_FILTERS' (state, status) {
    state.hasFilterSelected = status
  },
  'SET_SELECTED_INDEX' (state, index) {
    state.selectedIndex = index
  }

}
