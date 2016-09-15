<!DOCTYPE html>

<html>
 <form action="quote.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="symbol" placeholder="Symbol" type="text"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">Get Quote</button>
        </div>
    </fieldset>
</form>

</html>

THE STOCK PRICE FOR  <p><?=$name?>(<?=$symbol?>)</p> IS  <p>$<?=number_format($price, 2)?>
</p>