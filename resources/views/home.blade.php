<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FFXIV Shop</title>
</head>
<body>
    <div id="app">
        <main></main>
    </div>

    <script>
        @if(auth()->check())
        var login = true;
        @else
        var login = false;
        @endif
    </script>
    <script type="" src="/js/index.js"></script>
</body>
</html>