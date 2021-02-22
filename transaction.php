<?php
include 'template.php';

if (isset($_POST['transaction'])) {
    try {
        $testTr=$bitcoind->getRawTransaction($_POST['transaction']);
    } catch (\Throwable $th) {
        //throw $th;
    }
    if (isset($testTr)) {
        $transaction=$bitcoind->getRawTransaction($_POST['transaction']);
    }
    else {
        echo '<h4>Wrong input!<h4>';
        exit();
    }
}
else {
    $transaction=$bitcoind->getRawTransaction($_GET['hash']);
}

$jsonString=$transaction->getBody();
$trArray= json_decode($jsonString, true);
$tr=json_decode($bitcoind->decoderawtransaction($trArray['result']));

echo '<br><br><br><br>';
echo '<h4>Transaction Details</h4>';
echo '<table class="table table-striped" style="width:60%;margin-left:auto;margin-right:auto;">';
    echo '<tr><td>Hash</td><td>'.$tr->txid.'</td></tr>';
    echo '<tr><td>Size</td><td>'.$tr->size.'</td></tr>';
    echo '<tr><td>Weight</td><td>'.$tr->weight.' bytes</td></tr>';    
    echo '<tr><td>Virtual size</td><td>'.$tr->vsize.'</td></tr>';
    echo '<tr><td>Version</td><td>'.$tr->version.'</td></tr>';
echo '</table>';

echo '<br><br><br><br>';
echo '<h4>Inputs</h4>';
for ($i=0; $i <sizeof($tr->vin) ; $i++) { 
    echo '<table class="table table-striped" style="width:60%;margin-left:auto;margin-right:auto;">';
        echo '<tr><td>Hash</td><td>'.$tr->vin[$i]->txid.'</td></tr>';
        echo '<tr><td>Output</td><td>'.$tr->vin[$i]->vout.'</td></tr>';
        echo '<tr><td>ScriptSig (asm)</td><td>'.$tr->vin[$i]->scriptSig->asm.'</td></tr>';
        echo '<tr><td>ScriptSig (hex)</td><td>'.$tr->vin[$i]->scriptSig->hex.'</td></tr>';
        echo '<tr><td>Witness</td><td>'.$tr->vin[$i]->txinwitness[0].'</td></tr>';
        echo '<tr><td></td><td>'.$tr->vin[$i]->txinwitness[1].'</td></tr>';
        echo '<tr><td>Sequence</td><td>'.$tr->vin[$i]->sequence.'</td></tr>';
    echo '</table>';
    if($i != sizeof($tr->vin)-1){
        echo '<br><hr class="solid"><br>';
    }
}

echo '<br><br><br><br>';
echo '<h4>Outputs</h4>';
for ($j=0; $j <sizeof($tr->vout) ; $j++) { 
    echo '<table class="table table-striped" style="width:60%;margin-left:auto;margin-right:auto;">';
        echo '<tr><td>Index</td><td>'.$tr->vout[$j]->n.'</td></tr>';
        for ($k=0; $k < sizeof($tr->vout[$j]->scriptPubKey->addresses); $k++) { 
           echo '<tr><td>Addresses</td><td>'.$tr->vout[$j]->scriptPubKey->addresses[$k].'</td></tr>';
        }
        echo '<tr><td>PkScript (asm)</td><td>'.$tr->vout[$j]->scriptPubKey->asm.'</td></tr>';
        echo '<tr><td>PkScript (hex)</td><td>'.$tr->vout[$j]->scriptPubKey->hex.'</td></tr>';
        echo '<tr><td>ReqSigs</td><td>'.$tr->vout[$j]->scriptPubKey->reqSigs.'</td></tr>';
        echo '<tr><td>Value</td><td>'.$tr->vout[$j]->value.' BTC</td></tr>';
    echo '</table>';
    if($j != sizeof($tr->vout)-1){
        echo '<br><hr class="solid"><br>';
    }
}

?>