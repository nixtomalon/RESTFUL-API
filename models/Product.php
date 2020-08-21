<?php

class Product {

    public $conn;
    public $table = 'Products';

    public $pro_id;
    public $pro_name;
    public $pr_price;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY pro_id';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_single() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE pro_id = ?';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->pro_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->pro_id = $row['pro_id'];
        $this->pro_name = $row['pro_name'];
        $this->pro_price = $row['pro_price'];
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . '(pro_name,pro_price) VALUES (:pro_name, :pro_price)';

        $stmt = $this->conn->prepare($query);
        $this->pro_name = htmlspecialchars(strip_tags($this->pro_name));
        $this->pro_price = htmlspecialchars(strip_tags($this->pro_price));

        $stmt->bindParam(':pro_name', $this->pro_name);
        $stmt->bindParam(':pro_price', $this->pro_price);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET pro_name = ? , pro_price = ? WHERE pro_id = ?';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->pro_name);
        $stmt->bindParam(2, $this->pro_price);
        $stmt->bindParam(3, $this->pro_id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE pro_id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->pro_id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}

?>