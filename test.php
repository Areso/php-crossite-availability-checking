<?
$postdata = http_build_query(
    array(
        'string1' => '11-210-5'//,
        //'var2' => 'doh'
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);

$result = file_get_contents('https://www.aiform.ru/?mid=catalog&act=show', false, $context);

echo $result;
