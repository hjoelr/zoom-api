<?php
namespace Zoom;

use Zoom\Endpoint\Users;

class ZoomAPI{

	/**
	 * @var null
	 */
	private $apiKey = null;

	/**
	 * @var null
	 */
	private $apiSecret = null;

	/**
	 * @var null
	 */
	private $users = null;


	/**
	 * Zoom constructor.
	 * @param $apiKey
	 * @param $apiSecret
	 */
	public function __construct( $apiKey, $apiSecret ) {

		$this->apiKey = $apiKey;

		$this->apiSecret = $apiSecret;

	}



}

?> 
