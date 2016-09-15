<?php
     // configuration
require("../includes/config.php");
     // if user reached page via GET (as by clicking a link or via redirect)
     
if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
         // else render form
         render("change_password_form.php", ["title" => "Change Password"]);
}
     // else if user reached page via POST (as by submitting a form via POST)
else if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
        // validate submission
        if (empty($_POST["old_password"]))
        {
            apologize("You must provide your old password.");
        }
        else if (empty($_POST["new_pass"]))
        {
            apologize("You must provide a new password.");
        }
        else if (empty($_POST["conf_newpass"]))
        {
            apologize("You must provide a confirmation password");
        }
        else if ($_POST["new_pass"] != $_POST["conf_newpass"])
        {
            apologize("Your password and confirmation password must match!");
        }
        $rows = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);

        if (crypt($_POST["old_password"], $rows[0]["hash"]) == $rows[0]["hash"])
        // else change password
        {
            $rows = CS50::query("UPDATE users SET hash = ? WHERE id = ?", crypt($_POST["new_pass"]), $_SESSION["id"]);

            if (count($rows) > 0)
            {
                apologize("your password were changed succesfully !");
            }
            else
            {
                apologize("Sorry something went wrong please try again !");
            }
        }        
        else
        {
            apologize("wrong passoword !");
        }

            // redirect to index
            redirect("/index.php");
}
?>