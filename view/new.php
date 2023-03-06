
<form method="POST" action="?action=newReceipt">
<input type="text" name="clientId" value=""/>

    <input type="submit" value="create" name="create"/>
</form>
<form method="POST" action="?action=addToReceipt">
<input type="text" name="dishId" value="" placeholder = "dishId"/>
<input type="text" name="receiptId" value="" placeholder = "receiptId"/>

    <input type="submit" value="add to receipt" name="add"/>
</form>
<?php

foreach ($list as $receipt) {
    echo '<p>'.$receipt->getReceiptId().'</p>';
}
var_dump($list);
    if ($result):?>
        <p>Saved</p>
    <?php endif;?>
