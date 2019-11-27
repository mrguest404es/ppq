<?php
$rollingCurl  = new \RollingCurl\RollingCurl();
$data         = str_replace("\r", "", file_get_contents(__DIR__ . '/../source/' . $argv[1]));

echo '  Remove Duplicate? (Y/n): ';
$remove = fopen('php://stdin', 'r');
$remove = trim(fgets($remove));
if ($remove == 'Y') {
  $list         = array_unique(explode("\n", $data));
} else {
  $list         = explode("\n", $data);
}
echo PHP_EOL . '  Please wait while we filtering your email list.' . PHP_EOL;
$arrays         = array();
foreach ($list as $key => $filter) {
  if (empty($filter) || filter_var($filter, FILTER_VALIDATE_EMAIL) == false) { continue; }
  array_push($arrays, $filter);
}
echo '  Final length of your list is: ' . count($arrays) . PHP_EOL;
$list         = $arrays;
$lengthList   = count($list);

$smtp         = explode("\n", str_replace("\r", "", file_get_contents(__DIR__ . '/../source/smtp.txt')));

$meki         = array();
foreach ($smtp as $key => $filter) {
  if (empty($filter)) { continue; }
  array_push($meki, $filter);
}
$list         = array_chunk($list, count($meki));
$start        = microtime(true);

if ($lengthList < count($meki)) {
  echo PHP_EOL . '  Setting ratio to: ' . $lengthList . PHP_EOL;
  $ratio  = $lengthList;
} else {
  echo PHP_EOL . '  Setting ratio to: ' . count($meki) . PHP_EOL;
  $ratio  = count($meki);
}
echo PHP_EOL . "  Sending: " . $lengthList . ' with ratio ('.$ratio.')/Sec' . PHP_EOL . PHP_EOL;
