<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 500px;
            border: 1px solid #ddd;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }
    </style>
</head>

<body class="antialiased">

    <h1>Data</h1>
    <div style="overflow-x:auto;">
        <table>
            <tr>
                <th>Name</th>
                <th>Color</th>
            </tr>
            {{-- FOR EACH LOOP --}}
            {{-- WHERE TO FIND $SODAS? CHECK CONTROLLER @GET --}}
            {{-- ALSO CHECK ROUTES/WEB.PHP FOR MOUNTING THE METHOD @GET --}}
            @foreach ($sodas as $soda)
                <tr>
                    <td>{{ $soda->name }}</td>
                    <td>{{ $soda->color }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
