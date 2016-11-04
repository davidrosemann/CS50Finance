<div id="middle">
<table class="table table-striped">

<thead>
    <tr>
        <th>Symbol</th>
        <th>Name</th>
        <th>Shares</th>
        <th>Price</th>
        <th>TOTAL</th>
    </tr>
</thead>    
    </div>
    <tbody>
<?php foreach ($positions as $position): ?>

    <tr>
        <td align="left"><?= $position["symbol"] ?></td>
        <td align="left"><?= $position["name"] ?></td>
        <td align="left"><?= $position["shares"] ?></td>
        <td align="left">$<?= $position["price"] ?></td>
        <td align="left">$<?= $position["total"] ?></td>
    </tr>
    </br>
    <?php endforeach ?>
    <tr>
    <td align="left", colspan="4">CASH</td>
    <td align="left">$<?php echo "$cash"; ?></td>
    </tr>
    </tbody>
</table>
</div>
