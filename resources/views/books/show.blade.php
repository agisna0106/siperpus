<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Daftar Buku</h2>
    @foreach ($book->bookshelf as $bookshelf)
        <div>
            Buku : {{ $bookshelf->id ?? 'Tidak ada' }}
            Nama : {{ $bookshelf->name ?? 'Tidak ada' }}
        </div>
    @endforeach
</body>
</html>