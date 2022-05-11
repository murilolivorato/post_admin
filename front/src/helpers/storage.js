import { LocalStorage } from 'quasar'

// LOCATION STRING
export function getLastPropLocation () {
  const lastPropLocation = LocalStorage.getItem('last_prop_location_search')

  if (!lastPropLocation || lastPropLocation === 'undefined') {
    return null
  }

  return JSON.parse(lastPropLocation)
}

export function getLastNewPropLocation () {
  const lastNewPropLocation = LocalStorage.getItem('last_prop_new_location_search')

  if (!lastNewPropLocation || lastNewPropLocation === 'undefined') {
    return null
  }

  return JSON.parse(lastNewPropLocation)
}

// SEARCH STRING
export function getLastPropSearchString () {
  const lastPropSearchString = LocalStorage.getItem('last_prop_search_string')

  if (!lastPropSearchString || lastPropSearchString === 'undefined') {
    return null
  }

  return JSON.parse(lastPropSearchString)
}

export function getLastNewPropSearchString () {
  const lastNewPropSearchString = LocalStorage.getItem('last_new_prop_search_string')

  if (!lastNewPropSearchString || lastNewPropSearchString === 'undefined') {
    return null
  }

  return JSON.parse(lastNewPropSearchString)
}

export function getLastPostSearchString () {
  const lastPostSearchString = LocalStorage.getItem('last_post_search_string')

  if (!lastPostSearchString || lastPostSearchString === 'undefined') {
    return null
  }

  return JSON.parse(lastPostSearchString)
}
