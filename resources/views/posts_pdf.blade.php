<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List Postingan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .footer {
            margin-top: 30px;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <h2>Daftar Postingan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Author</th>
                <th>Isi</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $i => $post)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name ?? $post->author }}</td>
                    <td>{{ Str::limit($post->content, 100) }}</td>
                    <td>{{ $post->is_archived ? 'Arsip' : 'Publik' }}</td>
                    <td>{{ $post->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d-m-Y H:i') }}</p>
    </div>
</body>
</html>
