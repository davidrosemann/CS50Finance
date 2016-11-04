<?php

    // configuration
    require("../includes/config.php");
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("buy_form.php", ["title" => "Buy"]);
    }
     // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // get stock
        $stock = lookup($_POST["symbol"]);
        //track transaction for history
        $transaction = 'BUY';
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a stock symbol.");
        }
        if ($stock == false)
        {
                apologize("Please enter a valid stock symbol");
        }
        if (empty($_POST["shares"]))
        {
            apologize("Please provide the number of shares to purchase.");
        }
        if (preg_match("/^\d+$/", $_POST["shares"]==false))
        {
            apologize("Please enter a positive whole number");
        }
        //check that there is enough money to make purchase
        $cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        //$usercash = number_format($cash[0]["cash"],2);
        // calculate total purchase value (stock's price * shares)
        $value = $stock["price"] * ($_POST["shares"]);

        if ($cash < $value)
        {
            apologize("You don't have enough money for that");
        }
        //insert stock w/purchase amt into portfolio
        $query = CS50::query("INSERT INTO portfolios (user_id, symbol, shares) VALUES(?,?,?) ON DUPLICATE KEY UPDATE shares = shares + ?", $_SESSION["id"], strtoupper($_POST["symbol"]), $_POST["shares"], $_POST["shares"]);
        
        if ($query==false)
        {
            apologize("Error buying stock");
        }
        //if value is less than balance, update cash
        CS50::query("UPDATE users SET cash = cash - ? WHERE id= ?", $value, $_SESSION["id"]);
        // update history
        $history = CS50::query("INSERT INTO history (id, transaction, symbol, shares, price) VALUES(?, ?, ?, ?, ?)", $_SESSION["id"], $transaction, strtoupper($_POST["symbol"]), $_POST["shares"], $stock["price"]);
        if ($history==false)
        {
            apologize("Error updating history");
        }
    }
        
    redirect("/index.php");
?>    