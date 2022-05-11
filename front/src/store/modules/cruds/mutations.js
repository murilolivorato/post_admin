export default {
  'SET_DATA_CREATED' (state, data) {
    // SET NEW TOTAL PAGE
    const newTotalPage = state.pagination.get('total') + 1
    state.pagination.set('total', newTotalPage)

    // get all fields dinamic from request
    state.displayItems.unshift(data)
  },

  'SET_DATA_UPDATED' (state, data) {
    for (var prop in data) {
      state.displayItems[data.index][prop] = data[prop]
    }
  },
  'SET_DATA_DELETED' (state, data) {
    let count = 0

    for (const prop in data.index) {
      state.displayItems.splice(data.index[prop], 1)
      count++
    }
    // set pagination
    state.pagination.changePageStatus('remove', count)
  },
  'SET_SELECTED_ITEMS' (state, index) {
    // PUSH INDEX
    if (state.selectedItems.includes(index)) {
      state.selectedItems.splice(state.selectedItems.indexOf(index), 1)
      return
    }

    state.selectedItems.push(index)
  },
  'RESET_SELECT_ITEMS' (state, index) {
    state.selectedItems = []
  },
  'TOOGLE_ALL_SELECTIONS' (state, index) {
    const selectedValue = state.selectedItems

    if (!selectedValue.length) {
      state.selectedItems = []
      for (const prop in state.displayItems) {
        state.selectedItems.push(Number(prop))
      }

      return
    }

    state.selectedItems = []
  }

}
