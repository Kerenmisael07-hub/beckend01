<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<h2>Profile</h2>
<p>
    Nama:<br/>
    <b>{{$body['data']['name']}}</b>
</p>
<p>
    Username:<br/>
    <b>{{$body['data']['username']}}</b>
</p>

<a href="{{route('profile.edit')}}">Edit</a>
<a href="{{route('dashboard.index')}}">Kembali</a>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>