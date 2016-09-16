<?php
    // configuration
    require("../includes/config.php");
    
    // Query current users shares
    $rows = CS50::query("SELECT symbol, shares, avgprice FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
    
    // Construnct the view
    $shares = [];
    
    foreach($rows as $row)
    {
        // Query the Yahoo
        $stock = lookup($row["symbol"]);
        
        if ($stock !== false)
        {
            $shares[] = [
                "symbol"    => $row["symbol"]
                ,"name"     => $stock["name"]
                ,"shares"   => $row["shares"]
                ,"price_bought" => $row["avgprice"]
                ,"price_cur"    => $stock["price"]
                ,"total_bought" => $row["shares"] * $row["avgprice"]
                ,"total_cur"    => $row["shares"] * $stock["price"]
                ,"profit"   => $row["shares"] * $stock["price"] - $row["shares"] * $row["avgprice"]               
            ];
        }
    }
    
    $query = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    $upcash = $query[0];
    $_SESSION["cash"] = $upcash["cash"]; 
    // render portfolio
    render("portfolio.php", ["title" => "Portfolio", "username" => $_SESSION["username"], "cash" => $_SESSION["cash"], "shares" => $shares]);
?>
