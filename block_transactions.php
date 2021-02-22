<?php
include 'template.php';

function trInfo($hash){
    $transaction=$GLOBALS["bitcoind"]->getRawTransaction($hash);
    $jsonString=$transaction->getBody();
    $trArray= json_decode($jsonString, true);
    $tr=json_decode($GLOBALS["bitcoind"]->decoderawtransaction($trArray['result']));
    return $tr;
}

$block=json_decode($bitcoind->getBlock($_GET['hash']));
echo '<br><br><br><br>';
echo '<h4 style="text-align:center">Block transactions   ('.$block->height.')</h4>';
for ($i=0; $i < sizeof($block->tx); $i++) { 
    $singleTr=trInfo($block->tx[$i]);
    echo '<table class="table table-striped" style="width:100%;margin-left:auto;margin-right:auto;">';
        echo '<tr><td>Hash<br>Size</td><td>'.$singleTr->txid.'<br>'.$singleTr->size.'</td>';
        echo '<td>&rArr;</td>';
        echo '<td><td>';
        for ($j=0; $j < sizeof($singleTr->vout); $j++) { 
            if ($singleTr->vout[$j]->value==0) {
                echo 'OP_RETURN<br>';
            }
            else {
                echo ''.$singleTr->vout[$j]->scriptPubKey->addresses[0].'<br>';
            }
            echo ''.$singleTr->vout[$j]->value.' BTC<br>';
        }
        echo '</td></td>';
        echo '</tr>';
    echo '</table>';
}
?>