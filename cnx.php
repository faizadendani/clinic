<?php
class Database
{
    // Static property to hold the single instance
    private static $instance = null;

    // MySQLi connection object
    private $connection;

    // Database credentials
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "gestion_cabinet_dentaire";

    // Private constructor to prevent direct instantiation
    private function __construct()
    {
        // Create the connection
        $this->connection = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        // Check for connection errors
        if ($this->connection->connect_error) {
            die("Database connection failed: " . $this->connection->connect_error);
        }
    }

    // Method to get the single instance of the class
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Method to get the MySQLi connection object
    public function getConnection()
    {
        return $this->connection;
    }

    // Prevent cloning of the instance
    private function __clone()
    {
    }

    // Prevent unserialization of the instance
    private function __wakeup()
    {
    }
}

// Usage Example
$db = Database::getInstance(); // Get the singleton instance
$connection = $db->getConnection(); // Get the MySQLi connection object

// Execute a query
$query = "SELECT * FROM users";
$result = $connection->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
} else {
    echo "No records found.";
}
?>
