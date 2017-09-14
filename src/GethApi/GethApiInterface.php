<?php

namespace GethApi;

/**
 * Class GethApiInterface
 * @package GethApi
 */
interface GethApiInterface
{
	/**
	 * Returns the current client version.
	 * @return string
	 */
	function web3_clientVersion();

	/**
	 * Returns Keccak-256 (not the standardized SHA3-256) of the given data.
	 * @param string $data
	 * @return string
	 */
	function web3_sha3($data);

	/**
	 * Returns the current network id.
	 * @return string
	 */
	function net_version();

	/**
	 * Returns true if client is actively listening for network connections.
	 * @return bool
	 */
	function net_listening();

	/**
	 * Returns number of peers currently connected to the client.
	 * @return string
	 */
	function net_peerCount();

	/**
	 * Returns the current ethereum protocol version.
	 * @return string
	 */
	function eth_protocolVersion();

	/**
	 * Returns an object with data about the sync status or false.
	 * @return object|array|bool
	 */
	function eth_syncing();

	/**
     * Returns the client coinbase address.
     * @return string
     */
    function eth_coinbase();

	/**
	 * Returns true if client is actively mining new blocks.
	 * @return bool
	 */
	function eth_mining();

	/**
	 * Returns the number of hashes per second that the node is mining with.
	 * @return string
	 */
	function eth_hashrate();

	/**
	 * Returns the current price per gas in wei.
	 * @return string
	 */
	function eth_gasPrice();

	/**
	 * Returns a list of addresses owned by client.
	 * @return object|array
	 */
	function eth_accounts();

	/**
	 * Returns the number of most recent block.
	 * @return string
	 */
	function eth_blockNumber();

	/**
	 * Returns the balance of the account of given address.
	 * @param string $address
     * @param string $tag
	 * @return string
	 */
	function eth_getBalance($address, $tag);

	/**
	 * Returns the value from a storage position at a given address.
	 * @param string $address
     * @param int $quantity
     * @param string $tag
	 * @return string
	 */
	function eth_getStorageAt($address, $quantity, $tag);

	/**
	 * Returns the number of transactions sent from an address.
	 * @param string $address
	 * @return string
	 */
	function eth_getTransactionCount($address);

	/**
	 * Returns the number of transactions in a block from a block matching the given block hash.
	 * @param string $hash
	 * @return string
	 */
	function eth_getBlockTransactionCountByHash($hash);

	/**
	 * Returns the number of transactions in a block from a block matching the given block number.
	 * @param string $tag
	 * @return string
	 */
	function eth_getBlockTransactionCountByNumber($tag);

	/**
	 * Returns the number of uncles in a block from a block matching the given block hash.
	 * @param string $hash
	 * @return string
	 */
	function eth_getUncleCountByBlockHash($hash);

	/**
	 * Returns the number of uncles in a block from a block matching the given block number.
	 * @param string $tag
	 * @return string
	 */
	function eth_getUncleCountByBlockNumber($tag);

	/**
	 * Returns code at a given address.
	 * @param string $address
     * @param string $tag
	 * @return string
	 */
	function eth_getCode($address, $tag);

	/**
	 * The sign method calculates an Ethereum specific signature with: sign(keccak256("\x19Ethereum Signed Message:\n" + len(message) + message))).
	 * @param string $account
     * @param string $message
	 * @return string
	 */
	function eth_sign($account, $message);

	/**
	 * Creates new message call transaction or a contract creation, if the data field contains code.
	 * @param object|array $transaction
	 * @return string
	 */
	function eth_sendTransaction($transaction);

	/**
	 * Creates new message call transaction or a contract creation for signed transactions.
	 * @param string $data
	 * @return string
	 */
	function eth_sendRawTransaction($data);

	/**
	 * Executes a new message call immediately without creating a transaction on the block chain.
	 * @param object|array $transaction
     * @param string $tag
	 * @return string
	 */
	function eth_call($transaction, $tag);

	/**
	 * Makes a call or transaction, which won't be added to the blockchain and returns the used gas, which can be used for estimating the used gas.
	 * @param object|array $transaction
     * @param string $tag
	 * @return string
	 */
	function eth_estimateGas($transaction, $tag);

	/**
	 * Returns information about a block by hash.
	 * @param string $hash
     * @param bool $full
	 * @return string
	 */
	function eth_getBlockByHash($hash, $full);

	/**
	 * Returns information about a block by block number.
	 * @param string $tag
     * @param bool $full
	 * @return string
	 */
	function eth_getBlockByNumber($tag, $full);

	/**
	 * Returns the information about a transaction requested by transaction hash.
	 * @return object|array|null
	 */
	function eth_getTransactionByHash();

	/**
	 * Returns information about a transaction by block hash and transaction index position.
	 * @param string $hash
     * @param string $quantity
	 * @return string
	 */
	function eth_getTransactionByBlockHashAndIndex($hash, $quantity);

	/**
	 * Returns information about a transaction by block number and transaction index position.
	 * @param string $tag
     * @param string $quantity
	 * @return string
	 */
	function eth_getTransactionByBlockNumberAndIndex($tag, $quantity);

	/**
	 * Returns the receipt of a transaction by transaction hash.
	 * @param string $hash
	 * @return object|array
	 */
	function eth_getTransactionReceipt($hash);

	/**
	 * Returns information about a uncle of a block by hash and uncle index position.
	 * @param string $hash
     * @param string $quantity
	 * @return string
	 */
	function eth_getUncleByBlockHashAndIndex($hash, $quantity);

	/**
	 * Returns information about a uncle of a block by number and uncle index position.
	 * @param string $tag
     * @param string $position
	 * @return string
	 */
	function eth_getUncleByBlockNumberAndIndex($tag, $position);

	/**
	 * Returns a list of available compilers in the client.
	 * @return array
	 */
	function eth_getCompilers();

	/**
	 * Returns compiled solidity code.
     * @param string $code
	 * @return object|array
	 */
	function eth_compileSolidity($code);

	/**
	 * Returns compiled LLL code.
	 * @param string $code
	 * @return string
	 */
	function eth_compileLLL($code);

	/**
	 * Returns compiled serpent code.
	 * @param string $code
	 * @return string
	 */
	function eth_compileSerpent($code);

	/**
	 * Creates a filter object, based on filter options, to notify when the state changes (logs). To check if the state has changed, call eth_getFilterChanges.
	 * @param object|array $options
	 * @return string
	 */
	function eth_newFilter($options);

	/**
	 * Creates a filter in the node, to notify when a new block arrives. To check if the state has changed, call eth_getFilterChanges.
	 * @return string
	 */
	function eth_newBlockFilter();

	/**
	 * Creates a filter in the node, to notify when new pending transactions arrive. To check if the state has changed, call eth_getFilterChanges.
	 * @return string
	 */
	function eth_newPendingTransactionFilter();

	/**
	 * Uninstalls a filter with given id. Should always be called when watch is no longer needed. Additonally Filters timeout when they aren't requested with eth_getFilterChanges for a period of time.
	 * @param string $id
	 * @return bool
	 */
	function eth_uninstallFilter($id);

	/**
	 * Polling method for a filter, which returns an array of logs which occurred since last poll.
	 * @param string $id
	 * @return array
	 */
	function eth_getFilterChanges($id);

	/**
	 * Returns an array of all logs matching filter with given id.
	 * @param string $id
	 * @return array
	 */
	function eth_getFilterLogs($id);

	/**
	 * Returns an array of all logs matching a given filter object.
	 * @param object|array $options
	 * @return array
	 */
	function eth_getLogs($options);

	/**
	 * Returns the hash of the current block, the seedHash, and the boundary condition to be met ("target").
	 * @return array
	 */
	function eth_getWork();

	/**
	 * Used for submitting a proof-of-work solution.
	 * @param array $work
	 * @return bool
	 */
	function eth_submitWork($work);

	/**
	 * Used for submitting mining hashrate.
	 * @param string $hashrate
     * @param string $id
	 * @return bool
	 */
	function eth_submitHashrate($hashrate, $id);

	/**
	 * Returns the current whisper protocol version.
	 * @return string
	 */
	function shh_version();

	/**
	 * Sends a whisper message.
	 * @param array|object $message
	 * @return bool
	 */
	function shh_post($message);

	/**
	 * Creates new whisper identity in the client.
	 * @return string
	 */
	function shh_newIdentity();

	/**
	 * Checks if the client hold the private keys for a given identity.
	 * @param string $identity
	 * @return bool
	 */
	function shh_hasIdentity($identity);

	/**
	 * (?)
	 * @return string
	 */
	function shh_newGroup();

	/**
	 * (?)
	 * @param string $identity
	 * @return bool
	 */
	function shh_addToGroup($identity);

	/**
	 * Creates filter to notify, when client receives whisper message matching the filter options.
	 * @param array|object $options
	 * @return string
	 */
	function shh_newFilter($options);

	/**
	 * Uninstalls a filter with given id. Should always be called when watch is no longer needed. Additonally Filters timeout when they aren't requested with shh_getFilterChanges for a period of time.
	 * @param string $id
	 * @return bool
	 */
	function shh_uninstallFilter($id);

	/**
	 * Polling method for whisper filters. Returns new messages since the last call of this method.
	 * @param string $id
	 * @return array
	 */
	function shh_getFilterChanges($id);

	/**
	 * Get all messages matching a filter. Unlike shh_getFilterChanges this returns all messages.
	 * @param string $id
	 * @return array
	 */
	function shh_getMessages($id);
}