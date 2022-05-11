import HomeAdmin from 'pages/admin/Home.vue'
import PostCategoryDisplay from 'pages/admin/post/post_category/Display.vue'
import PostUserDisplay from 'pages/admin/post/post_user/Display.vue'
import PostTagDisplay from 'pages/admin/post/post_tag/Display.vue'
import PostDisplay from 'pages/admin/post/post/Display.vue'
import SavePost from 'pages/admin/post/post/Save.vue'
import GalleryImageDisplay from 'pages/admin/gallery/image_gallery/Display.vue'
import SaveImageGallery from 'pages/admin/gallery/image_gallery/Save.vue'
import GalleryFileDisplay from 'pages/admin/gallery/file_gallery/Display.vue'
import SaveFileGallery from 'pages/admin/gallery/file_gallery/Save.vue'
import ProductCategoryDisplay from 'pages/admin/product/product_category/Display.vue'
import SaveProductCategory from 'pages/admin/product/product_category/Save.vue'
import ProductSubCategoryDisplay from 'pages/admin/product/product_sub_category/Display.vue'
import SaveProductSubCategory from 'pages/admin/product/product_sub_category/Save.vue'
import ProductTagDisplay from 'pages/admin/product/product_tag/Display.vue'
import ProductDiscountDisplay from 'pages/admin/product/product_discount/Display.vue'
import SaveProductDiscount from 'pages/admin/product/product_discount/Save.vue'
import ProductManufactureDisplay from 'pages/admin/product/product_manufacture/Display.vue'
import SaveProductManufacture from 'pages/admin/product/product_manufacture/Save.vue'
import ProductSearchKeyDisplay from 'pages/admin/product/product_search_key/Display.vue'
import ProductDisplay from 'pages/admin/product/product/Display.vue'
import SaveProduct from 'pages/admin/product/product/Save.vue'
import UserAdminDisplay from 'pages/admin/user/user_admin/Display.vue'
import SaveUserAdmin from 'pages/admin/user/user_admin/Save.vue'
import SaveUserAdminPassword from 'pages/admin/user/user_admin/SavePassword.vue'
import Admin from 'layouts/Admin'

const admin = [
  // HOME
  {
    path: '/admin/home',
    component: Admin,
    children: [{ path: '', component: HomeAdmin, name: 'AdminHome', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // CATEGORIAS DE NOTICIAS
  {
    path: '/admin/categorias-de-noticias',
    component: Admin,
    children: [{ path: '', component: PostCategoryDisplay, name: 'PostCategoryDisplay', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // USUÁRIOS DE NOTICIAS
  {
    path: '/admin/usuarios-de-noticias',
    component: Admin,
    children: [{ path: '', component: PostUserDisplay, name: 'PostUserDisplay', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // ARQUIVOS DE NOTICIAS
  {
    path: '/admin/arquivos-de-noticias',
    component: Admin,
    children: [{ path: '', component: PostTagDisplay, name: 'PostTagDisplay', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // NOTÍCIAS
  {
    path: '/admin/noticias',
    component: Admin,
    children: [{ path: '', component: PostDisplay, name: 'PostDisplay', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // CRIAR NOTÍCIAS
  {
    path: '/admin/noticias/criar',
    component: Admin,
    children: [{ path: '', component: SavePost, name: 'CreatePost', meta: { template: 'admin', requiresAdminAuth: true, action: 'create' } }]
  },

  // EDITAR NOTÍCIAS
  {
    path: '/admin/noticias/editar/:id',
    component: Admin,
    children: [{ path: '', component: SavePost, name: 'EditPost', meta: { template: 'admin', requiresAdminAuth: true, action: 'edit' } }]
  },

  // GALERIA DE IMAGEM
  {
    path: '/admin/galerias-de-imagens',
    component: Admin,
    children: [{ path: '', component: GalleryImageDisplay, name: 'GalleryImageDisplay', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // CRIAR GALERIA DE IMAGEM
  {
    path: '/admin/galerias-de-imagens/criar',
    component: Admin,
    children: [{ path: '', component: SaveImageGallery, name: 'CreateImageGallery', meta: { template: 'admin', requiresAdminAuth: true, action: 'create' } }]
  },

  // EDITAR GALERIA DE IMAGEM
  {
    path: '/admin/galerias-de-imagens/editar/:id',
    component: Admin,
    children: [{ path: '', component: SaveImageGallery, name: 'EditImageGallery', meta: { template: 'admin', requiresAdminAuth: true, action: 'edit' } }]
  },
  // GALERIA DE ARQUIVOS
  {
    path: '/admin/galerias-de-arquivos',
    component: Admin,
    children: [{ path: '', component: GalleryFileDisplay, name: 'GalleryFileDisplay', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // CRIAR GALERIA DE ARQUIVOS
  {
    path: '/admin/galerias-de-arquivos/criar',
    component: Admin,
    children: [{ path: '', component: SaveFileGallery, name: 'CreateFileGallery', meta: { template: 'admin', requiresAdminAuth: true, action: 'create' } }]
  },
  // EDITAR GALERIA DE ARQUIVOS
  {
    path: '/admin/galeria-de-arquivos/editar/:id',
    component: Admin,
    children: [{ path: '', component: SaveFileGallery, name: 'EditFileGallery', meta: { template: 'admin', requiresAdminAuth: true, action: 'edit' } }]
  },

  // CATEGORIAS DE PRODUTOS
  {
    path: '/admin/categorias-de-produtos',
    component: Admin,
    children: [{ path: '', component: ProductCategoryDisplay, name: 'ProductCategoryDisplay', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // CRIAR CATEGORIAS DE PRODUTOS
  {
    path: '/admin/categorias-de-produtos/criar',
    component: Admin,
    children: [{ path: '', component: SaveProductCategory, name: 'CreateProductCategory', meta: { template: 'admin', requiresAdminAuth: true, action: 'create' } }]
  },

  // EDITAR CATEGORIAS DE PRODUTOS
  {
    path: '/admin/categorias-de-produto/editar/:id',
    component: Admin,
    children: [{ path: '', component: SaveProductCategory, name: 'EditProductCategory', meta: { template: 'admin', requiresAdminAuth: true, action: 'edit' } }]
  },
  // SUB CATEGORIAS DE PRODUTOS
  {
    path: '/admin/sub-categorias-de-produtos',
    component: Admin,
    children: [{ path: '', component: ProductSubCategoryDisplay, name: 'ProductSubCategoryDisplay', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // CRIAR SUB CATEGORIAS DE PRODUTOS
  {
    path: '/admin/sub-categorias-de-produto/criar',
    component: Admin,
    children: [{ path: '', component: SaveProductSubCategory, name: 'CreateProductSubCategory', meta: { template: 'admin', requiresAdminAuth: true, action: 'create' } }]
  },

  // EDITAR SUB CATEGORIAS DE PRODUTOS
  {
    path: '/admin/sub-categorias-de-produto/editar/:id',
    component: Admin,
    children: [{ path: '', component: SaveProductSubCategory, name: 'EditProductSubCategory', meta: { template: 'admin', requiresAdminAuth: true, action: 'edit' } }]
  },

  // ARQUIVOS DE PRODUTOS
  {
    path: '/admin/arquivos-de-produtos',
    component: Admin,
    children: [{ path: '', component: ProductTagDisplay, name: 'ProductTagDisplay', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // DESCONTO DE PRODUTOS
  {
    path: '/admin/descontos-de-produtos',
    component: Admin,
    children: [{ path: '', component: ProductDiscountDisplay, name: 'ProductDiscountDisplay', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // CRIAR DESCONTO DE PRODUTOS
  {
    path: '/admin/descontos-de-produtos/criar',
    component: Admin,
    children: [{ path: '', component: SaveProductDiscount, name: 'CreateProductDiscount', meta: { template: 'admin', requiresAdminAuth: true, action: 'create' } }]
  },

  // EDITAR DESCONTO DE PRODUTOS
  {
    path: '/admin/descontos-de-produtos/editar/:id',
    component: Admin,
    children: [{ path: '', component: SaveProductDiscount, name: 'EditProductDiscount', meta: { template: 'admin', requiresAdminAuth: true, action: 'create' } }]
  },

  // FABRICANTES
  {
    path: '/admin/fabricantes-de-produtos',
    component: Admin,
    children: [{ path: '', component: ProductManufactureDisplay, name: 'ProductManufactureDisplay', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // CRIAR FABRICANTES
  {
    path: '/admin/fabricantes-de-produtos/criar',
    component: Admin,
    children: [{ path: '', component: SaveProductManufacture, name: 'CreateProductManufacture', meta: { template: 'admin', requiresAdminAuth: true, action: 'create' } }]
  },

  // EDITAR FABRICANTES
  {
    path: '/admin/fabricantes-de-produtos/editar/:id',
    component: Admin,
    children: [{ path: '', component: SaveProductManufacture, name: 'EditProductManufacture', meta: { template: 'admin', requiresAdminAuth: true, action: 'edit' } }]
  },

  // BUSCAS DE PRODUTO
  {
    path: '/admin/chaves-de-buscas-de-produtos',
    component: Admin,
    children: [{ path: '', component: ProductSearchKeyDisplay, name: 'ProductSearchKeyDisplay', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // PRODUTOS
  {
    path: '/admin/produtos',
    component: Admin,
    children: [{ path: '', component: ProductDisplay, name: 'ProductDisplay', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // CRIAR PRODUTOS
  {
    path: '/admin/produtos/criar',
    component: Admin,
    children: [{ path: '', component: SaveProduct, name: 'CreateProduct', meta: { template: 'admin', requiresAdminAuth: true, action: 'create' } }]
  },

  // EDITAR PRODUTOS
  {
    path: '/admin/produtos/editar/:id',
    component: Admin,
    children: [{ path: '', component: SaveProduct, name: 'EditProduct', meta: { template: 'admin', requiresAdminAuth: true, action: 'edit' } }]
  },
  // USUÁRIO ADMINN
  {
    path: '/admin/usuarios-do-sistema',
    component: Admin,
    children: [{ path: '', component: UserAdminDisplay, name: 'UserAdminDisplay', meta: { template: 'admin', requiresAdminAuth: true } }]
  },

  // CRIAR USUÁRIO ADMINN
  {
    path: '/admin/usuarios-do-sistema/criar',
    component: Admin,
    children: [{ path: '', component: SaveUserAdmin, name: 'CreateUserAdmin', meta: { template: 'admin', requiresAdminAuth: true, action: 'create' } }]
  },

  // EDITAR USUÁRIO ADMIN
  {
    path: '/admin/usuarios-do-sistema/editar/:id',
    component: Admin,
    children: [{ path: '', component: SaveUserAdmin, name: 'EditUserAdmin', meta: { template: 'admin', requiresAdminAuth: true, action: 'edit' } }]
  },

  // ALTERAR SENHA USUÁRIO ADMIN
  {
    path: '/admin/usuarios-do-sistema/editar-senha/:id',
    component: Admin,
    children: [{ path: '', component: SaveUserAdminPassword, name: 'EditUserAdminPassword', meta: { template: 'admin', requiresAdminAuth: true, action: 'edit' } }]
  }

]
export default admin
