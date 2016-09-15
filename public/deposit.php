<?php
    // configuration
    require("../includes/config.php"); 
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["value"]) || !is_numeric($_POST["value"]) || !preg_match("/^\d+$/", $_POST["value"]))
        {
            apologize("Please enter a valid ammount!");
        }

        // Check if we returned nothing
        if ($_POST["value"] != $_POST["confirm_value"] || $_POST["value"] == 0 )
        {
            apologize("value confirmation is invalid.");
        }

            // Update users cash
            $query = CS50::query("UPDATE users SET cash = cash + ? where id = ?", $_POST["value"], $_SESSION["id"]);
            if ($query === false)
            {
               apologize("Error while selling shares.");
            }
               
            $_SESSION["cash"] += $value;
            
            // Log the history
            $query = CS50::query("INSERT INTO history(user_id, type, symbol, shares, price, date) VALUES (?, ?, ?, ?, ?, Now())"
                ,$_SESSION["id"], 2, "DEPOSIT", 1, $_POST["value"]);
            
            // Redirect to home
            redirect("/");
    }
    else
    {

        render("deposit_form.php", ["title" => "deposit"]);
    }
?>