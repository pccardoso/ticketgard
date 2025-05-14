<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $titulo }}</title>
    <style>
        body {
            font-family: Helvetica, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        h1, h2, h3 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 150px;
        }

        .tabela {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .tabela th, .tabela td {
            border: 1px solid #B3CFFF;
            padding: 5px;
            text-align: left;
            vertical-align: top;
        }

        .tabela th {
            background-color: #3176F5;
            font-weight: bold;
            color: white;
        }

        .tabela-striped tr:nth-child(even) {
            background-color: #B0CCFF;
        }

        .footer {
            position: fixed;
            bottom: 20px;
            left: 20px;
            right: 20px;
            text-align: center;
            font-size: 10px;
            color: #999;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .small {
            font-size: 10px;
        }
    </style>

</head>
<body>
    <div class="logo">
        <img src="{{ public_path('images/logo-azul.png') }}" alt="Logo" width="150px">
    </div>

    <h3>RELATÓRIO DE TICKETS</h3>

    <table class="tabela tabela-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Status</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
            </tr>
            <tr>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
            </tr>
            <tr>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
            </tr>
            <tr>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
            </tr>
            <tr>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
            </tr>
            <tr>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
            </tr>
            <tr>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
            </tr>
            <tr>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
            </tr>
            <tr>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
            </tr>
            <tr>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
                <td>Valor</td>
            </tr>

        </tbody>
    </table>

    <div class="footer">
        Gerado em {{ now()->format('d/m/Y H:i') }} - Ticket Gard
    </div>


</body>
</html>