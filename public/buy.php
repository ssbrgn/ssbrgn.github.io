<?php
    // configuration
    require("../includes/config.php"); 
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Validate the name
        if (empty($_POST["code"]))
        {
            apologize("Please enter the stock symbol.");
        }
        // Validate the stock amount
        if (empty($_POST["shares"]) || !is_numeric($_POST["shares"]) || !preg_match("/^\d+$/", $_POST["shares"]))
        {
            apologize("Please enter the correct amount of shares!");
        }
        
        // Query the Yahoo
        $stock = lookup($_POST["code"]);
        
        // Check if we returned nothing
        if ($stock === false)
        {
            apologize("Entered stock symbol was invalid.");
        }
        else
        {
            $value = $stock["price"] * $_POST["shares"];
            
            // Check the amount of cash
            if ($_SESSION["cash"] < $value)
            {
                apologize("You don't have sufficient amount of money.");
            }
            else
            {
               //check if user_id already has the symbol // if yes calculate avg price
               $query = CS50::query("SELECT avgprice, shares FROM portfolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], strtoupper($_POST["code"]));
                
               if (count($query) == 1)
                {
                    $row = $query[0];
                    $avg = ($value + ($row["avgprice"] * $row["shares"])) / ($_POST["shares"] + $row["shares"]);
                    // Insert the bought stock into database
                    $query = CS50::query("INSERT INTO portfolio (user_id, symbol, shares, avgprice) VALUES(?, ?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares), avgprice = $avg" ,$_SESSION["id"], strtoupper($stock["symbol"]), $_POST["shares"], $stock["price"]);
                }
                else{
                    // Insert the bought stock into database
                    $rows = CS50::query("INSERT INTO portfolio (user_id, symbol, shares, avgprice) VALUES(?, ?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares), avgprice = VALUES(avgprice)" ,$_SESSION["id"], strtoupper($stock["symbol"]), $_POST["shares"], $stock["price"]);
                }
                if ($rows === false)
                {
                    apologize("Error while buying shares.");
                }
                
                // Update the user's cash
                $rows =CS50::query("UPDATE users SET cash = cash - ? where id = ?", $value, $_SESSION["id"]);
                if ($rows === false)
                {
                    apologize("Error while buying shares.");
                }
              
                $_SESSION["cash"] -= $value;
                
                // Log the history
                $rows = CS50::query("INSERT INTO history(user_id, type, symbol, shares, price, date) VALUES (?, ?, ?, ?, ?, Now())"
                    ,$_SESSION["id"], 1, strtoupper($stock["symbol"]), $_POST["shares"], $stock["price"]);
                
                // Redirect to home
                redirect("/");
            }
        }
    }
    else
    {
        // else render form
        render("buy_form.php", ["title" => "Buy"]);
    }
?>