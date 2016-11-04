<?php

// configuration
require("../includes/config.php"); 

$id = $_SESSION["id"];

$rows = CS50::query("SELECT symbol,user_id,shares FROM portfolios WHERE user_id = ?",$_SESSION["id"]);
$cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
$usercash = number_format($cash[0]["cash"],2);
    
    $positions = [];
foreach ($rows as $row)
{
    $stock = lookup($row["symbol"]);
    if ($stock !== false)
    {
        $positions[] = [
            "name" => $stock["name"],
            "price" => number_format($stock["price"],2),
            "shares" => $row["shares"],
            "symbol" => $row["symbol"],
            "total" => number_format($row["shares"] * $stock["price"],2)
        ];
    }
}
    //render portfolio
    render("portfolio.php", ["positions" => $positions, "title" => "Portfolio", "cash" => $usercash]);

?>
