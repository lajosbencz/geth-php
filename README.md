# GETH-PHP

PHP wrapper for [Geth](https://github.com/ethereum/go-ethereum) [JSON-RPC](https://github.com/ethereum/wiki/wiki/JSON-RPC)

## INSTALL

```
composer require lajosbencz/geth-php
```

## USAGE

```php
$geth = new \GethApi\GethApi([
        // Geth JSON-RPC version
        'version' => '2.0',
        // Host part of address
        'host' => '127.0.0.1',
        // Port part of address
        'port' => 8545,
        // Return results as associative arrays instead of objects
        'assoc' => true,
]);

$version = $geth->web3_getVersion();

$accounts = $geth->eth_accounts();
foreach($accounts as $account) {
    echo $account, ': ', $geth->eth_getBalance($account, 'latest'), PHP_EOL;
}
```

## TODO

 - Parallel requests
 - Implement experimental [PUB/SUB](https://github.com/ethereum/go-ethereum/wiki/RPC-PUB-SUB)