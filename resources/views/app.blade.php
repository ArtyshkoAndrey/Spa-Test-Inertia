<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>Laravel Inertia CRUD</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet"/>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  @routes
  <script src="{{ asset('/js/app.js') }}" defer></script>
</head>
<body>
  @inertia
</body>
</html>