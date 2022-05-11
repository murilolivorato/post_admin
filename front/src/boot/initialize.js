
import { initialize } from 'src/helpers/general'
import MiddlewareStylesheet from 'src/helpers/stylesheets'

export default async ({ store, router }) => {
  router.beforeEach(MiddlewareStylesheet)
  initialize(store, router)
}
