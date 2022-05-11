/**
 * Define our route selectable stylesheets
 *
 * @type {Object}
 */

const javascript = {
  web:
        '/assets/js/web.js',
  login:
        '/assets/js/web.js',
  admin:
        '/assets/js/admin.js'
}

const javascriptElement = document.getElementById('javascript-data')
/**
 * Set the default fallback stylesheet
 * @type {[type]}
 */
const defaultJavascript = javascript.public

export default function stylesheet (to, from, next) {
  if (to.meta.template !== from.meta.template) {
    javascriptElement.href = javascript[to.meta.template] || defaultJavascript
  }

  return next()
}
