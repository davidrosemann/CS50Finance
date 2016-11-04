<div id="middle">
    <table class="table table-striped">
<thead>
    <tr>
        <th>Transaction</th>
        <th>Symbol</th>
        <th>Shares</th>
        <th>Price</th>
    </tr>
</thead>   
<?php foreach ($history as $history): ?>

    <tr>
        <td><?= $position["symbol"] ?></td>
        <td><?= $position["name"] ?></td>
        <td><?= $position["shares"] ?></td>
        <td><?= $position["price"] ?></td>
    </tr>
    </br>
    <tr>
    <td align="left", colspan="4">CASH</td>
    <td align="left"><?php echo "$cash"; ?></td>
    </tr>

<?php endforeach ?>
</div>