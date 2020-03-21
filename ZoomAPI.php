<?php
namespace Zoom;

use Zoom\Endpoint\Users;
use Zoom\Endpoint\Meetings;
use Zoom\Endpoint\Recordings;
use Zoom\Endpoint\Reports;

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
	 * Zoom constructor.
	 * @param $apiKey
	 * @param $apiSecret
	 */
	public function __construct( $apiKey, $apiSecret ) {

		$this->apiKey = $apiKey;
		$this->apiSecret = $apiSecret;

		$this->users = new Users($this->apiKey, $this->apiSecret);
		$this->meetings = new Meetings($this->apiKey, $this->apiSecret);
		$this->recordings = new Recordings($this->apiKey, $this->apiSecret);
		$this->reports = new Reports($this->apiKey, $this->apiSecret);
	}
}

?> 
