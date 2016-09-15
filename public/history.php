<?php
    // configuration
    require("../includes/config.php");
    
    // Query current users shares
    $rows = CS50::query("SELECT CASE WHEN type = 0 THEN 'SELL' WHEN type = 1 THEN 'BUY' ELSE 'NEW DEPOSIT' END action, symbol, shares, price, date FROM history
        WHERE user_id = ? order by date desc", $_SESSION["id"]);
    
    if (count($rows) == 0)
    {
        apologize("No recorded transactions for this user exist.");
    }
    // render history
    render("history_result.php", ["title" => "History", "history" => $rows,"username" => $_SESSION["username"], "cash" => $_SESSION["cash"]]);
?>