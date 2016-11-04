<?php
    // configuration
    require("../includes/config.php");  
    
    // if form hasn't been submitted
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // query user's portfolio
        $rows =	CS50::query("SELECT * FROM portfolios WHERE user_id = ?", $_SESSION["id"]);

        //create new array to store stock symbols
        $stocks = [];
        // for each of user's stocks
        foreach ($rows as $row)	
        {   
            // save stock symbol
            $stock = lookup($row["symbol"]);
            if ($stock !== false)
            {
            // add stock symbol to the new array
                $stocks[] = $stock["symbol"];
                
            }
        }
        // render sell form
        render("sell_form.php", ["title" => "Sell", "stocks" => $stocks]);
    }
    
    // if form is submitted
    else if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // set transaction type
        $transaction = 'SELL';
        // lookup stock
        $stock = lookup($_POST["symbol"]);
        // lookup user's shares of stock being sold
        $shares = CS50::query("SELECT shares FROM portfolios WHERE symbol=? AND user_id=?", $_POST["symbol"], $_SESSION["id"]);

        // calculate total sale value (stock's price * shares)
        $value = $stock["price"] * $shares[0]["shares"];

        // add the sale value to cash
        $cash = CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $value, $_SESSION["id"]);
        // delete the stock from the portfolio 
        $sell = CS50::query("DELETE FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        if ($sell==false)
        {
            apologize("Error selling stock");
        }
        // update history
        $history = CS50::query("INSERT INTO history (id, transaction, symbol, shares, price) VALUES(?, ?, ?, ?, ?)", $_SESSION["id"], $transaction, strtoupper($_POST["symbol"]), ($shares[0]["shares"]), $stock["price"]);
        if ($history==false)
        {
            apologize("Error updating history");
        }
        
        // redirect to portfolio 
        redirect("index.php");
    }
?>