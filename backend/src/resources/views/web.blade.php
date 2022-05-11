<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Finance Acessoria</title>
    <link rel="stylesheet"  type="text/css"  href="/assets/css/all/preloader.css">
    <link rel="stylesheet" id="stylesheet-data" type="text/css"  href="/assets/css/all/admin.css">
</head>
<body>

<div class="whapper" id="main-app" >
    <div id="loading-app"><p>Carregando</p></div>
    <main-app v-if="$route.meta.template == 'web'" ></main-app>
    <login-app v-if="$route.meta.template == 'login'"  ></login-app>
    <admin-app v-if="$route.meta.template == 'admin'" ></admin-app>
</div>


<script src="/assets/js/web.js" id="javascript-data" ></script>
</body>
</html>
