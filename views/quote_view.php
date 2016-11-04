<?php
 if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        //redirect
        redirect("/public/quote.php");
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    print("Price: ".number_format($stock["price"], 2));
    }
?>