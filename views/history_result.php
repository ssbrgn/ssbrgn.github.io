<!DOCTYPE html>
<p>
    Welcome back, <strong><?=$username?>!</strong> Your current balance is: <strong>$<?=number_format($cash, 2)?></strong>
</p>
<div id="middle">
     <table class="table table-striped">
    <thead>
        <tr>
            <th>Transaction</th>
            <th>Date/Time</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($history as $record): ?>
            <tr>
                <td><?= $record["action"] ?></td>
                <td><?= $record["date"] ?></td>
                <td><?= $record["symbol"] ?></td>
                <td><?= $record["shares"] ?></td>
                <td><?= number_format($record["price"], 2) ?></td>
                <!--<td><?= date('Y-m-d H:i:s', strtotime($record["date"])) ?></td>-->
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
</div>