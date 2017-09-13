<?php

namespace GethApi;

/**
 * Wrapper class for communicating with Geth client
 * @package GethApi
 * @method string web3_clientVersion() Returns the current client version.
 * @method string web3_sha3(string $data) Returns Keccak-256 (not the standardized SHA3-256) of the given data.
 * @method string net_version() Returns the current network id.
 * @method bool net_listening() Returns true if client is actively listening for network connections.
 * @method string net_peerCount() Returns number of peers currently connected to the client.
 * @method string eth_protocolVersion() Returns the current ethereum protocol version.
 * @method object|array|bool eth_syncing() Returns an object with data about the sync status or false.
 * @hetmod string eth_coinbase() Returns the client coinbase address.
 * @method bool eth_mining() Returns true if client is actively mining new blocks.
 * @method string eth_hashrate() Returns the number of hashes per second that the node is mining with.
 * @method string eth_gasPrice() Returns the current price per gas in wei.
 * @method object|array eth_accounts() Returns a list of addresses owned by client.
 * @method string eth_blockNumber() Returns the number of most recent block.
 * @method string eth_getBalance(string $address, string $tag) Returns the balance of the account of given address.
 * @method string eth_getStorageAt(string $address, int $quantity, string $tag) Returns the value from a storage position at a given address.
 * @method string eth_getTransactionCount(string $address) Returns the number of transactions sent from an address.
 * @method string eth_getBlockTransactionCountByHash(string $hash) Returns the number of transactions in a block from a block matching the given block hash.
 * @method string eth_getBlockTransactionCountByNumber(string $tag) Returns the number of transactions in a block from a block matching the given block number.
 * @method string eth_getUncleCountByBlockHash(string $hash) Returns the number of uncles in a block from a block matching the given block hash.
 * @method string eth_getUncleCountByBlockNumber(string $tag) Returns the number of uncles in a block from a block matching the given block number.
 * @method string eth_getCode(string $address, string $tag) Returns code at a given address.
 * @method string eth_sign(string $account, string $message) The sign method calculates an Ethereum specific signature with: sign(keccak256("\x19Ethereum Signed Message:\n" + len(message) + message))).
 * @method string eth_sendTransaction(object|array $transaction) Creates new message call transaction or a contract creation, if the data field contains code.
 * @method string eth_sendRawTransaction(string $data) Creates new message call transaction or a contract creation for signed transactions.
 * @method string eth_call(object|array $transaction, string $tag) Executes a new message call immediately without creating a transaction on the block chain.
 * @method string eth_estimateGas(object|array $transaction, string $tag) Makes a call or transaction, which won't be added to the blockchain and returns the used gas, which can be used for estimating the used gas.
 * @method string eth_getBlockByHash(string $hash, bool $full) Returns information about a block by hash.
 * @method string eth_getBlockByNumber(string $tag, bool $full) Returns information about a block by block number.
 * @method object|array|null eth_getTransactionByHash() Returns the information about a transaction requested by transaction hash.
 * @method string eth_getTransactionByBlockHashAndIndex(string $hash, string $quantity) Returns information about a transaction by block hash and transaction index position.
 * @method string eth_getTransactionByBlockNumberAndIndex(string $tag, string $quantity) Returns information about a transaction by block number and transaction index position.
 * @method object|array eth_getTransactionReceipt(string $hash) Returns the receipt of a transaction by transaction hash.
 * @method string eth_getUncleByBlockHashAndIndex(string $hash, string $quantity) Returns information about a uncle of a block by hash and uncle index position.
 * @method string eth_getUncleByBlockNumberAndIndex(string $tag, string $position) Returns information about a uncle of a block by number and uncle index position.
 * @method array eth_getCompilers() Returns a list of available compilers in the client.
 * @method object|array eth_compileSolidity(string $code) Returns compiled solidity code.
 * @method string eth_compileLLL(string $code) Returns compiled LLL code.
 * @method string eth_compileSerpent(string $code) Returns compiled serpent code.
 * @method string eth_newFilter(object|array $options) Creates a filter object, based on filter options, to notify when the state changes (logs). To check if the state has changed, call eth_getFilterChanges.
 * @method string eth_newBlockFilter() Creates a filter in the node, to notify when a new block arrives. To check if the state has changed, call eth_getFilterChanges.
 * @method string eth_newPendingTransactionFilter() Creates a filter in the node, to notify when new pending transactions arrive. To check if the state has changed, call eth_getFilterChanges.
 * @method bool eth_uninstallFilter(string $id) Uninstalls a filter with given id. Should always be called when watch is no longer needed. Additonally Filters timeout when they aren't requested with eth_getFilterChanges for a period of time.
 * @method array eth_getFilterChanges(string $id) Polling method for a filter, which returns an array of logs which occurred since last poll.
 * @method array eth_getFilterLogs(string $id) Returns an array of all logs matching filter with given id.
 * @method array eth_getLogs(object|array $options) Returns an array of all logs matching a given filter object.
 * @method array eth_getWork() Returns the hash of the current block, the seedHash, and the boundary condition to be met ("target").
 * @method bool eth_submitWork(array $work) Used for submitting a proof-of-work solution.
 * @method bool eth_submitHashrate(string $hashrate, string $id) Used for submitting mining hashrate.
 * @method string shh_version() Returns the current whisper protocol version.
 * @method bool shh_post(array|object $message) Sends a whisper message.
 * @method string shh_newIdentity() Creates new whisper identity in the client.
 * @method bool shh_hasIdentity(string $identity) Checks if the client hold the private keys for a given identity.
 * @method string shh_newGroup() (?)
 * @method bool shh_addToGroup(string $identity) (?)
 * @method string shh_newFilter(array|object $options) Creates filter to notify, when client receives whisper message matching the filter options.
 * @method bool shh_uninstallFilter(string $id) Uninstalls a filter with given id. Should always be called when watch is no longer needed. Additonally Filters timeout when they aren't requested with shh_getFilterChanges for a period of time.
 * @method array shh_getFilterChanges(string $id) Polling method for whisper filters. Returns new messages since the last call of this method.
 * @method array shh_getMessages(string $id) Get all messages matching a filter. Unlike shh_getFilterChanges this returns all messages.
 */
class GethApi
{
    protected static $_defaultOptions = [
        // Geth JSON-RPC version
        'version' => '2.0',
        // Host part of address
        'host' => '127.0.0.1',
        // Port part of address
        'port' => 8545,
        // Return results as associative arrays instead of objects
        'assoc' => true,
    ];

    protected $_options = [];
    protected $_curl = null;
    protected $_id = 0;

    /**
     * Service constructor.
     * @param string|array $options (optional)
     */
    public function __construct($options = null)
    {
        if($options) {
            if(!is_array($options)) {
                if(is_int($options)) {
                    $options = ['port' => $options];
                }
                else {
                    if(preg_match('/^([^\:]+)\:([\d]+)$/', $options, $match)) {
                        $options = ['host' => $match[1], 'port' => $match[2]];
                    }
                    else {
                        $options = ['host' => $options];
                    }
                }
            }
        }
        else {
            $options = [];
        }
        $this->_options = array_merge(self::$_defaultOptions, $options);
        $this->_curl = curl_init('http://' . $this->_options['host'] . ':' . $this->_options['port']);
        curl_setopt($this->_curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * Close CURL session
     */
    function __destruct()
    {
        if (is_resource($this->_curl)) {
            curl_close($this->_curl);
        }
    }

    /**
     * Returns the latest transaction ID
     * @return int
     */
    public function getLatestId()
    {
        return $this->_id;
    }

    /**
     * Magic handler for RPC methods
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws \RuntimeException
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        $id = ++$this->_id;
        $data = [
            'jsonrpc' => $this->_options['version'],
            'method' => $name,
            'params' => $arguments,
            'id' => $id,
        ];
        $json = json_encode($data);
        curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $json);
        curl_setopt($this->_curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json)
        ]);
        $result = curl_exec($this->_curl);
        if (!$result) {
            throw new \RuntimeException(curl_error($this->_curl), curl_errno($this->_curl));
        }
        $data = json_decode($result, $this->_options['assoc']);
        if($this->_options['assoc']) {
            if (isset($data['error'])) {
                throw new Exception($data['error']['message'], $data['error']['code']);
            }
            if (!array_key_exists('result', $data)) {
                return null;
            }
            return $data['result'];
        }
        else {
            if (isset($data->error)) {
                throw new Exception($data->error->message, $data->error->code);
            }
            if (!array_key_exists('result', $data)) {
                return null;
            }
            return $data->result;
        }
    }

}