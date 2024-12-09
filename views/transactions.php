<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <link rel="stylesheet" href="views/style.css">
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?= arrayToTable($lines)?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td>$<?=getIncomes($allMoney)?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td>$<?=getExpenses($allMoney)?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td>$<?=netTotal($allMoney)?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
