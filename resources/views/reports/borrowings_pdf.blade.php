<!DOCTYPE html>
<html>

<head>
    <title>Borrowing Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Borrowing Report</h2>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Book</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Fine</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowings as $borrowing)
                <tr>
                    <td>{{ $borrowing->user->name }}</td>
                    <td>{{ $borrowing->book->title }}</td>
                    <td>{{ $borrowing->borrow_date->format('Y-m-d') }}</td>
                    <td>{{ $borrowing->return_date->format('Y-m-d') }}</td>
                    <td>{{ ucfirst($borrowing->status) }}</td>
                    <td>Rp {{ number_format($borrowing->fine, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>