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
        if(empty($_POST["username"]))
        {
            apologize("Please provide Username");
            redirect("register.php");
        }
        else if (empty($_POST["password"]))
        {
            apologize("Please provide password");
            redirect("register.php");  
        }
        else if (empty($_POST["confirmation"]))
        {
            apologize("Please confirm password");
            redirect("register.php");
        }
        else if($_POST["password"] !== $_POST["confirmation"])
        {
            apologize("Passwords do not match");
            redirect("register.php");
        }
        else
        {
            //CS50::query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
            if (CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT))==false)
            {
                apologize("Username already exists");
                redirect("register.php");
            }
            else
            {
            $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            $_SESSION["id"]=$id;
            redirect("index.php");
            }
        }
    }

?>

