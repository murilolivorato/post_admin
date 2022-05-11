export default {
  modal: state => {
    return state.modal
  },
  filter: state => filterName => {
    return state.selectSearch.get(filterName)
  },
  pageLoading: state => {
    return state.loadingPage
  },
  formList: state => {
    return state.formList
  },
  pageInfo: state => {
    return state.pageInfo
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
  imageFormBus: state => {
    return state.imageFormBus
  },
  showImageFormBus: state => {
    return state.showImageFormBus
  },
  videoFormBus: state => {
    return state.videoFormBus
  },
  imagesFromGallery: state => {
    return state.imagesFromGallery
  },
  filesFromGallery: state => {
    return state.filesFromGallery
  },
  formOptions: state => optionName => {
    return state.formOptions.get(optionName)
  }
}
