--TEST--
swoole_zookeeper: a
--SKIPIF--
<?php
require __DIR__ . '/../inc/skipif.inc';
--FILE--
<?php
require __DIR__ . '/../inc/bootstrap.php';

use swoole\zookeeper;

go(function () {
    zookeeper::setDebugLevel(1);
    $zk = new zookeeper(TEST_ZOOKEEPER_FULL_URL, TEST_ZOOKEEPER_TIMEOUT);
    var_dump($zk->get('/test_get_set'));
    var_dump($zk->create('/test_get_set', 1, ZOO_EPHEMERAL));
    var_dump($zk->get('/test_get_set'));
    var_dump($zk->set('/test_get_set', 3));
    var_dump($zk->get('/test_get_set'));
});

--EXPECT--
bool(false)
string(13) "/test_get_set"
string(0) ""
bool(true)