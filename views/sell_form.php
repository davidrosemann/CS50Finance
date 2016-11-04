<form action="sell.php" method="post">
<fieldset>
        <label for="sell">Symbol</label></br>
        <div class = "form-group">
        <select name="symbol">
        <option hidden>Symbol</option>
        <?php foreach ($stocks as $stock)
        {
        echo ("<option value='{$stock}'>{$stock}</option>");
        }
        ?>
        </select>
        </br>
        </br>
        <div class="form-group">
        <button class="btn btn-default" type="submit">Sell</button>
        </div>
</fieldset>
</form>

<a href="index.php">Home</a>

