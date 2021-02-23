<?php

declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
//ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);

const __ROOT = __DIR__.'/../public';
const __PARSER_DIR = __DIR__;

$loader = require_once __ROOT.'/vendor/autoload.php';

//$loader->addPsr4('Core\\', __ROOT.'/classes/Core');
$loader->addPsr4('Parsers\\', __DIR__.'/classes/Parsers');
$loader->addPsr4('Exceptions\\', __DIR__.'/classes/Exceptions');
$loader->addPsr4('ProgressBar\\', __DIR__.'/classes/ProgressBar');
$loader->addPsr4('Orm\\', __DIR__.'/classes/Orm');

use \Parsers\Board;
use \Parsers\OnlineBoard;

use Websm\Framework\Db\Config;

Config::init(include __ROOT.'/admin/config.php');

$start = microtime(true);

(new Board(__DIR__ . '/../Sync/departure.csv', 'departure'))->parse();
(new Board(__DIR__ . '/../Sync/arrival.csv', 'arrival'))->parse();

(new OnlineBoard(__DIR__ . '/../Sync/online_departures.csv', 'departure'))->parse();
(new OnlineBoard(__DIR__ . '/../Sync/online_arrivals.csv', 'arrival'))->parse();

echo 'Время выполнения скрипта: '.round(microtime(true) - $start, 4)." сек. \n";
