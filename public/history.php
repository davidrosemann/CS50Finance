<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("history_view.php", ["title" => "History"]);
    }
    $rows = CS50::query("SELECT * FROM portfolios WHERE user_id = ?", $_SESSION["id"]);
    dump($rows);
    $history = [];
foreach ($rows as $row)
{
    $stock = lookup($row["symbol"]);
    if ($stock !== false)
    {
        $history[] = [
           "transaction" => $transaction["name"],
           "date/time" => $stock["price"],
           "shares" => $row["shares"],
           "symbol" => $row["symbol"],
           "total" => $row["shares"] * $stock["price"]
        ];
    }
}
    //render portfolio
    render("history_view.php", ["history" => $history, "title" => "Transaction History", "cash" => $usercash]);
?>