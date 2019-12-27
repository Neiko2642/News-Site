<?php
$url = "https://www.bitstamp.net/api/v2/ticker/ethusd";
$fgc = file_get_contents($url);
$json = json_decode($fgc, TRUE);
$lastPrice = $json["last"];
$highPrice = $json["high"];
$lowPrice = $json["low"];

//calc 24 hr change
$openPrice = $json["open"];
if($openPrice < $lastPrice)
{
    $operator = "+";
    $change = $lastPrice - $openPrice;
    $percent = $change / $openPrice;
    $percent = $percent * 100;
    $percentChange = $operator.number_format($percent, 1);
    $color = "green";
}
if($openPrice > $lastPrice)
{
    $operator = "-";
    $change = $openPrice - $lastPrice;
    $percent = $change / $openPrice;
    $percent = $percent * 100;
    $percentChange = $operator.number_format($percent, 1);
    $color = "red";
}

$date = date("m/d/Y - h:i:sa");

?>
                            <li> ETH: <a style="color: <?php echo $color; ?>;">$<?php echo number_format($lastPrice, 2); ?> <?php echo number_format($percentChange, 2); ?>%</a> </li>
