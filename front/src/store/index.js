import Vue from 'vue'
import Vuex from 'vuex'
// WEB
import adminLogin from 'src/store/modules/adminLogin'
import helpers from 'src/store/modules/helpers'
import main from 'src/store/modules/main'
import posts from 'src/store/modules/posts'
import post from 'src/store/modules/post'
import contact from 'src/store/modules/contact'
import lastPosts from 'src/store/modules/lastPosts'
import captcha from 'src/store/modules/captcha'
import forgotPassword from 'src/store/modules/forgotPassword'
import recoverPassword from 'src/store/modules/recoverPassword'
import services from 'src/store/modules/services'
import register from 'src/store/modules/register'
// ADMIN
import adminMain from 'src/store/modules/admin/adminMain'
import adminPostCategory from 'src/store/modules/admin/postCategory'
import adminPostUser from 'src/store/modules/admin/postUser'
import adminPostTag from 'src/store/modules/admin/postTag'
import adminPost from 'src/store/modules/admin/post'
import adminPostSave from 'src/store/modules/admin/postSave'
import adminProduct from 'src/store/modules/admin/product'
import adminProductSave from 'src/store/modules/admin/productSave'
import adminProductCategory from 'src/store/modules/admin/productCategory'
import adminProductCategorySave from 'src/store/modules/admin/productCategorySave'
import adminProductSubCategory from 'src/store/modules/admin/productSubCategory'
import adminProductSubCategorySave from 'src/store/modules/admin/productSubCategorySave'
import adminProductDiscount from 'src/store/modules/admin/productDiscount'
import adminProductDiscountSave from 'src/store/modules/admin/productDiscountSave'
import adminProductGlobalOption from 'src/store/modules/admin/productGlobalOption'
import adminProductGlobalOptionSave from 'src/store/modules/admin/productGlobalOptionSave'
import adminProductManufacture from 'src/store/modules/admin/productManufacture'
import adminProductManufactureSave from 'src/store/modules/admin/productManufactureSave'
import adminProductSearchKey from 'src/store/modules/admin/productSearchKey'
import adminProductTag from 'src/store/modules/admin/productTag'
import adminImageGallery from 'src/store/modules/admin/imageGallery'
import adminImageGallerySave from 'src/store/modules/admin/imageGallerySave'
import adminFileGallery from 'src/store/modules/admin/fileGallery'
import adminFileGallerySave from 'src/store/modules/admin/fileGallerySave'
import adminUserAdmin from 'src/store/modules/admin/userAdmin'
import adminUserAdminSave from 'src/store/modules/admin/userAdminSave'

Vue.use(Vuex)

/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Store instance.
 */

export default function (/* { ssrContext } */) {
  const Store = new Vuex.Store({
    modules: {
      adminLogin,
      helpers,
      main,
      services,
      captcha,
      lastPosts,
      posts,
      post,
      contact,
      forgotPassword,
      recoverPassword,
      register,
      adminMain,
      adminPostCategory,
      adminPostUser,
      adminPostTag,
      adminPost,
      adminPostSave,
      adminImageGallery,
      adminImageGallerySave,
      adminFileGallery,
      adminFileGallerySave,
      adminProduct,
      adminProductSave,
      adminProductCategory,
      adminProductCategorySave,
      adminProductSubCategory,
      adminProductSubCategorySave,
      adminProductDiscount,
      adminProductDiscountSave,
      adminProductGlobalOption,
      adminProductGlobalOptionSave,
      adminProductManufacture,
      adminProductManufactureSave,
      adminProductSearchKey,
      adminProductTag,
      adminUserAdmin,
      adminUserAdminSave
    },

    // enable strict mode (adds overhead!)
    // for dev mode only
    strict: process.env.DEBUGGING
  })

  return Store
}
