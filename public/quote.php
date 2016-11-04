<?php

       // configuration
    require("../includes/config.php");
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Quote"]);
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $stock = lookup($_POST["symbol"]);
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("Please input a stock symbol");
        }
        else if ($stock == false)
        {
                apologize("Please enter a valid stock symbol");
        }
        else
        {
            render("/quote_view.php", ["stock" => $stock]);
        }
    }
    
    
?>