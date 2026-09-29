<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<h2>Edit Profile</h2>

<form action="{{route('profile.edit.store')}}" method="post">
    @csrf
    <p>
        Nama:<br/>
        <input type="text" name="name" value="{{$body['data']['name']}}" placeholder="Nama">
    </p>

    <p>
        <input type="submit" value="Simpan">
    </p>
</form>

<a href="{{route('profile.index')}}">Kembali</a>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>