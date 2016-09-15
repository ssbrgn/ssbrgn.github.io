<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
         if (empty($_POST["confirmation"]))
        {
            apologize("Please confirm your password.");
        }
        else if ($_POST["confirmation"] != $_POST["password"])
        {
            apologize("Password does not match.");
        }

        // query database for user
        $rows = CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));

        // Check if user exists otherwise register

        if ($rows == 1)
        {
            // remember that user's now logged in by storing user's ID in session
            $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
            $row = $rows[0];
            $_SESSION["id"] = $row["id"];
            
            
            
            // remember username and current deposit
                $_SESSION["username"] = $row["username"];
                $_SESSION["cash"] = $row["cash"];
            
            // redirect to portfolio
            
            redirect("/");  }
        else
        {
        // else apologize
        apologize("Invalid or existing username / please try a different username.");
        }
    }

?>
