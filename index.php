<?php
include 'template.php';
$transactions =json_decode($bitcoind->getrawmempool());
$size=sizeof($transactions);
echo '<br><br><br><br>';
echo '<table class="table table-striped" style="width:40%;float: left;">';
echo '<caption>Latest transactions</caption>';
for ($i=0; $i < 10; $i++) { 
    if ($i == $size) {
        break;
    }
    echo '<tr><td>Hash</td><td><a href="transaction.php?hash='.$transactions[$i].'">'.$transactions[$i].'</a></td></tr>';
}
echo '</table>';

$data = json_decode($bitcoind->getblockchaininfo());
$last_block = $data->bestblockhash;
echo '<table class="table table-striped" style="width:50%;float: right;">';
echo '<caption>Latest blocks</caption>';
echo '<tr><th>Hash</th><th>Height</th><th>Size</th>';
for ($i=0; $i < 10; $i++) {
    echo '<tr><td><a href="block.php?hash='.$last_block.'">'.$last_block.'</a></td>';
    $block=json_decode($bitcoind->getBlock($last_block));
    echo '<td>'.$block->height.'</td>';
    echo '<td>'.$block->size.' KB</td></tr>';

    $last_block = $block->previousblockhash;
}
echo '</table>';

?>