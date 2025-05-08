<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dawrat Passbook Statement</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .passbook-statement {
            max-width: 800px;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 20px;
        }

        .passbook-statement h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }



        .passbook-statement table {
            width: 100%;
            border-collapse: collapse;
        }

        .passbook-statement th,
        .passbook-statement td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        .passbook-statement th {
            background-color: #f2f2f2;
        }

        .passbook-statement tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Apply a different style to the last row */
        .passbook-statement tr:last-child {
            background-color: #e6f7ff;
        }

        /* Style the balance cell in the last row */
        .passbook-statement tr:last-child td:last-child {
            color: #007bff;
            font-size: 18px;
            font-weight: bold;
            padding-top: 12px;
            /* Add some spacing at the top */
        }

        .company-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.company-header img {
    height: 28px;
}
.company-header div {
    flex: 1;
    text-align: right;
}
     

      
    </style>
</head>

<body>
    

    <div class="company-header">
        <div>
            <img src="{{ URL::asset('assets/images/dawrat_logo.png') }}" alt="logo" height="28" />
        </div>
        <div class="text-muted">
            <p class="mb-1">{{ $data['address'] }}</p>
            <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> {{ $data['email'] }}</p>
            <p><i class="uil uil-phone me-1"></i> {{ $data['phone'] }}</p>
        </div>
    </div>


    <div class="passbook-statement">


        <div style="display: flex ">

            <h4 >Dawrat Passbook Statement</h4>
         
        </div>
        <table>
         
            </tr>
            
            <tr>
                <th>Date</th>
                <th>Particulars</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Balance</th>
            </tr>

            @foreach ($order as $statement)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($statement->created_at)->format('d-M-y') }}</td>
                    <td>{{ $statement->transection_type }}</td>
                    @if ($statement->transection_type == 'Credited')
                        <td></td>
                        <td>{{ $statement->amount }}</td>
                    @endif

                    @if ($statement->transection_type == 'Debited')
                        <td>{{ $statement->amount }}</td>
                        <td></td>
                    @endif

                    <td>{{ $statement->wallet_amount }}</td>
                </tr>
            @endforeach
            {{-- 
            <tr>
                <td>2023-07-01</td>
                <td>Opening Balance</td>
                <td></td>
                <td></td>
                <td>10000</td>
            </tr>
            <tr>
                <td>2023-07-05</td>
                <td>Deposit</td>
                <td></td>
                <td>5000</td>
                <td>15000</td>
            </tr>
            <tr>
                <td>2023-07-10</td>
                <td>Withdrawal</td>
                <td>2000</td>
                <td></td>
                <td>13000</td>
            </tr> --}}
            <!-- Add more rows for additional transactions -->
        </table>
    </div>
</body>

</html>
