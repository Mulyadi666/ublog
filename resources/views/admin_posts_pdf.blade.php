<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Export Semua Postingan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            /* Ukuran teks utama */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 9px;
            /* Ukuran teks tabel */
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>

</head>

<body>
    <h2>Daftar Semua Postingan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Akun</th>
                <th>Email</th>
                <th>Author</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Tanggal Dibuat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $index => $post)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $post->user->name ?? '-' }}</td>
                    <td>{{ $post->user->email ?? '-' }}</td>
                    <td>{{ $post->author }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td>{{ $post->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $post->is_archived ? 'Arsip' : 'Publik' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
