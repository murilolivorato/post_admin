export default {
  pageInfo: state => {
    return state.pageInfo
  },
  urlValue: state => name => {
    const url = window.location.href
    name = name.replace(/[[\]]/g, '\\$&')
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url)
    if (!results) return null
    if (!results[2]) return ''
    return decodeURIComponent(results[2].replace(/\+/g, ' '))
  },
  getSegment: state => numberSegment => {
    const path = window.location.pathname
    const segments = path.split('/')
    return segments[numberSegment]
  },
  uppercaseText: state => text => {
    return text.toUpperCase()
  },
  capitalizeText: (state, getters) => text => {
    if (!text) {
      return
    }

    const splitText = text.split(' ')

    const newString = []
    for (var i = 0; i < splitText.length; i++) {
      newString.push(getters.capitalizeFirstLetter(splitText[i]))
    }

    return newString.join(' ')
  },
  capitalizeFirstLetter: state => string => {
    return string.charAt(0).toUpperCase() + string.slice(1)
  },
  getCurrentUserHeader: state => {
    if (!state.currentUser) {
      return null
    }
    return state.currentUser.token
  }
}
