import { LocalStorage } from 'quasar'

export function getAdminLocalUser () {
  const userStr = LocalStorage.getItem('admin_user')

  if (!userStr) {
    return null
  }

  return JSON.parse(userStr)
}

export function getCustomerLocalUser () {
  const userStr = LocalStorage.getItem('customer_user')

  if (!userStr) {
    return null
  }

  return JSON.parse(userStr)
}

export function getRealEstateLocalUser () {
  const userStr = LocalStorage.getItem('real_estate_user')

  if (!userStr) {
    return null
  }

  return JSON.parse(userStr)
}
