<?php
$SERVER_NAME = "localhost";
$DATABASE_USERNAME = "201501_471_02";
$DATABASE_PASSWORD = "cade&stefano";
$DATABASE = "db201501_471_g02";

/**
 * Get a connection to the database.
 * 
 * @return PDO connection to the Best-Book-Buy database
 */
function getDatabaseConnection() {
	try {
		global $SERVER_NAME, $DATABASE_USERNAME, $DATABASE_PASSWORD, $DATABASE;
		$conn = new PDO ( "mysql:host=$SERVER_NAME;dbname=$DATABASE", $DATABASE_USERNAME, $DATABASE_PASSWORD );
		// set the PDO error mode to exception
		$conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	} catch ( PDOException $e ) {
		echo "Connection failed: " . $e->getMessage ();
		return null;
	}
	return $conn;
}
class SessionCartItems {
	private $cartItems;
	public function __construct() {
		$this->cartItems = array ();
	}
	public function addToCart($isbn) {
		if (! isset ( $cartItems [$isbn] )) {
			$this->cartItems [$isbn] = 1;
		}
	}
	
	public function removeFromCart($isbn) {
		unset ( $this->cartItems [$isbn] );
	}
	
	public function updateQuantity($isbn, $quantity) {
		if (isset ( $this->cartItems [$isbn] )) {
			$this->cartItems [$isbn] = $quantity;
		}
	}
	public function getCartItemsAssociativeArray() {
		return $this->cartItems;
	}
	public function getArrayOfAssociativeArraysOfCartItems() {
		$arrayOfAssociativeArrays = array ();
		$i = 0;
		foreach ( $this->cartItems as $isbn => $quantity ) {
			$arrayOfAssociativeArrays [$i] = array (
					'isbn' => $isbn,
					'quantity' => $quantity 
			);
			$i ++;
		}
		return $arrayOfAssociativeArrays;
	}
}
?>