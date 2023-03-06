<form method="POST" action="?action=newReceipt">
<input type="text" name="clientId" value="" placeholder = "clientId"/>

    <input type="submit" value="create" name="create"/>
</form>
<form method="POST" action="?action=addToReceipt">
<input type="text" name="dishId" value="" placeholder = "dishId"/>
<input type="text" name="receiptId" value="" placeholder = "receiptId"/>

    <input type="submit" value="add_to_receipt" name="add"/>
</form>
<h2>Stats</h2>
<?php
    foreach ($stats as $stat) {
        echo '<p>Dish Id: '.$stat['dish_id'] . ' Count: '.$stat['count'];
    }
?>
<?php

if($errors){
    ?>
    <h2 class="alert alert-danger">Errors</h2>
<?
    foreach ($errors as $error) {
        echo '<p>Error: '.$error;
    }
}
?>
<h2>Full list of receipts</h2>
<?
foreach ($list as $receipt) {
    echo '<p>Receipt Id: '.$receipt->getReceiptId() . ' Client Id: '.$receipt->getClientId().' Dish Ids: ';
    foreach ($receipt->getDishesIds() as $dish) {
        echo '<span>'.$dish.' </span>';
    }
    echo '</p>';
}

?>
