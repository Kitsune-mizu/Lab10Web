<?php
class Database {
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    protected $conn;

    public function __construct() {
        $this->getConfig();
        // Menggunakan operator assignment untuk $this->conn
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name); 
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    private function getConfig() {
        include_once("config.php");
        $this->host = $config['host'];
        $this->user = $config['username'];
        $this->password = $config['password'];
        $this->db_name = $config['db_name'];
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function get($table, $where = null) {
        $whereClause = ""; // Inisialisasi variabel untuk klausa WHERE
        if ($where) {
            $whereClause = " WHERE " . $where;
        }
        $sql = "SELECT * FROM " . $table . $whereClause;
        $result = $this->conn->query($sql);
        // Perbaikan: Pastikan $result adalah objek mysqli_result sebelum memanggil fetch_assoc()
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null; // Mengembalikan null jika tidak ada hasil
        }
    }
    
    public function insert($table, $data) {
        if (is_array($data)) {
            $column = []; // Inisialisasi sebagai array kosong
            $value = []; // Inisialisasi sebagai array kosong
            foreach ($data as $key => $val) {
                $column[] = $key;
                $value[] = "'{$val}'";
            }
            $columns = implode(",", $column);
            $values = implode(",", $value);
        } else {
            return false; // Mengembalikan false jika $data bukan array
        }

        $sql = "INSERT INTO " . $table . " (" . $columns . ") VALUES (" . $values . ")";
        $sqlResult = $this->conn->query($sql); // Variabel baru untuk hasil query
        
        if ($sqlResult === true) {
            return $sqlResult;
        } else {
            return false;
        }
    }

    public function update($table, $data, $where) {
        $update_value = []; // Inisialisasi sebagai array kosong
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                // Perbaikan: Penggunaan operator assignment dan penambahan kutip pada nilai string
                $update_value[] = "$key='{$val}'"; 
            }
            $update_value_string = implode(",", $update_value); // Variabel baru untuk string
        } else {
             return false; // Mengembalikan false jika $data bukan array
        }
        
        $sql = "UPDATE " . $table . " SET " . $update_value_string . " WHERE " . $where;
        $sqlResult = $this->conn->query($sql); // Variabel baru untuk hasil query

        if ($sqlResult === true) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($table, $filter) {
        $sql = "DELETE FROM " . $table . " " . $filter;
        $sqlResult = $this->conn->query($sql); // Variabel baru untuk hasil query

        if ($sqlResult === true) {
            return true;
        } else {
            return false;
        }
    }
}
?>