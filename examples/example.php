<?php

use UniversalAccess\Wrapper as W;

require_once __DIR__.'/../vendor/autoload.php';

$json = json_encode([
	'some_key' => [
		'some_key'       => [1,2,3],
    'some_other_key' => [
      'some_key' => [
        'v1' => true,
        'v2' => null,
        'v3' => 'Value',
      ]
    ]
	]
]);
	
$obj = json_decode($json);
$arr = json_decode($json, true);

$o = W::wrap($obj);
$a = W::wrap($arr);

echo 'isset($o->some_key[\'some_key\'][0]) → ';
var_export(isset($o->some_key['some_key'][0]));
echo "\n\n";

echo 'isset($a->some_key[\'some_key\']->non->existent->data) → ';
var_export(isset($a->some_key['some_key']->non->existent->data));
echo "\n\n";

echo '$o->some_key[\'some_key\'][0] → ';
var_export($o->some_key['some_key'][0]);
echo "\n\n";

echo 'isset($a->some_key[\'some_key\']->non->existent->data) → ';
var_export($a->some_key['some_key']->non->existent->data);
echo "\n\n";

echo 'isset($o->some_key[\'some_key\']->non->existent->data->raw()) → ';
var_export($o->some_key['some_key']->non->existent->data->raw());
echo "\n\n";

echo 'isset($o->some_key->some_key->raw()) → ';
var_export($o->some_key->some_key->raw());
echo "\n\n";

echo 'isset($o[\'some_key\']->some_other_key->raw()) → ';
var_export($o['some_key']->some_other_key->raw());
echo "\n\n";

echo 'isset($a[\'some_key\']->some_other_key->raw()) → ';
var_export($a['some_key']->some_other_key->raw());
echo "\n\n";

echo 'foreach ($o->some_key->some_other_key->some_key as $v) { echo var_export($v, true)."\n"; }';
echo "\n";
foreach ($o->some_key->some_other_key->some_key as $v) { echo var_export($v, true)."\n"; }
echo "\n\n";

echo 'foreach ($o->some_key as $v) { echo var_export($v, true)."\n"; }';
echo "\n";
foreach ($o->some_key as $v) { echo var_export($v, true)."\n"; }
echo "\n\n";
