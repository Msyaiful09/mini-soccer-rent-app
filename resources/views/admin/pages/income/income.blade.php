<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pendapatan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h3 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h3>Laporan Pendapatan</h3>
    <p>
        Tahun: {{ $year }}
        @if ($month)
            | Bulan: {{ date('F', mktime(0, 0, 0, $month, 1)) }}
        @endif
    </p>
    <p><strong>Total Pendapatan:</strong> Rp {{ number_format($total_income, 0, ',', '.') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Bulan</th>
                <th>Total Pendapatan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($incomes as $index => $income)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $income->year }}</td>
                    <td>{{ date('F', mktime(0, 0, 0, $income->month, 1)) }}</td>
                    <td>Rp {{ number_format($income->total_income, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
