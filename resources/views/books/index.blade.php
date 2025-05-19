<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-3xl">
            <h1 class="text-2xl font-bold mb-6 border-b pb-2 text-center">📚 Daftar Buku</h1>

            <ul class="space-y-4">
                @foreach ($books as $book)
                    <li class="p-4 bg-gray-50 border rounded-lg hover:bg-gray-100 transition">
                        <div class="text-lg font-semibold">{{ $book->title }} <span class="text-sm text-gray-500">({{ $book->year }})</span></div>
                        <div class="text-sm text-gray-600">Ditulis oleh <span class="font-medium">{{ $book->author->name }}</span></div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</body>
</html>
