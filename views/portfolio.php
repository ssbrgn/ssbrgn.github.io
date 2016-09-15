<!DOCTYPE html>
<p>
    Welcome , <strong><?=$username?>!</strong> Your current balance is <strong>$<?=number_format($cash, 2)?></strong>
</p>
<div id="middle">
     <table class="table table-striped">
          <thead>
        <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price Bought</th>
            <th>Price Current</th>
            <th>Total Bought</th>
            <th>Total Current</th>
            <th>Total gains / losses</th>
        </tr>
    </thead>
        <?php foreach($shares as $share): ?>
            <tr>
                <td><?= $share["symbol"] ?></td>
                <td><?= $share["name"] ?></td>
                <td><?= number_format($share["shares"],0) ?></td>
                <td><?= number_format($share["price_bought"], 2) ?></td>
                <td><?= number_format($share["price_cur"], 2) ?></td>
                <td><?= number_format($share["total_bought"], 2) ?></td>
                <td><?= number_format($share["total_cur"], 2) ?></td>
                <td><?= number_format($share["profit"], 2) ?></td>
            </tr>
        <?php endforeach ?>

    </table>
</div>
