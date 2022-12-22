<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../../css/reset.css">
  @yield('pageCss')
  <style>
    .content-wrapper {
      width: 100%;
      height: 100%;
    }

    .ttl {
      margin: 30px auto 0px;
      text-align: center;
      font-size: 30px;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <main>
    <div class="content-wraper">
      <h1 class="ttl">@yield('title')</h1>
      @yield('content')
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/fetch-jsonp@1.1.3/build/fetch-jsonp.min.js"></script>
</body>

</html>