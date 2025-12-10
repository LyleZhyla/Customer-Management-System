<?php
// model.php
function db_connect() {
    $conn = mysqli_connect( 
        'localhost',
        'root', 
        '',     
        'customer_db'
    ) or die('DB connect error '.mysqli_connect_error()); 
    return $conn;
}

function fetch_all_customers() {
    $c = db_connect();
    $sql = 'SELECT * FROM customers ORDER BY created_at DESC';
    $res = mysqli_query($c, $sql);
    $rows = [];
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
    mysqli_close($c); 
    return $rows;
}

function fetch_customer($id) {
    $c = db_connect();
    $id_safe = (int)$id; 
    $sql = "SELECT * FROM customers WHERE id=$id_safe";
    $res = mysqli_query($c, $sql);
    $row = mysqli_fetch_assoc($res); 
    mysqli_close($c);
    return $row;
}

// Function para magdagdag ng bagong customer 
function add_customer($name, $email, $phone) {
    $c = db_connect();
    $n = mysqli_real_escape_string($c, $name);
    $e = mysqli_real_escape_string($c, $email);
    $p = mysqli_real_escape_string($c, $phone); 
    
    // Simple validation
    if ($n === '' || $e === '') {
        mysqli_close($c); 
        return false;
    }

    $sql = "INSERT INTO customers (name,email,phone) VALUES ('$n','$e','$p')";
    $ok = mysqli_query($c, $sql); 
    mysqli_close($c);
    return $ok;
}

// *** Update Function ***
function update_customer($id, $name, $email, $phone) {
    $c = db_connect();
    // Sanitizing inputs
    $id_safe = (int)$id;
    $n = mysqli_real_escape_string($c, $name);
    $e = mysqli_real_escape_string($c, $email);
    $p = mysqli_real_escape_string($c, $phone); 
    
    if ($n === '' || $e === '' || $id_safe === 0) {
        mysqli_close($c); 
        return false;
    }
    // SQL query to update the record
    $sql = "UPDATE customers SET name='$n', email='$e', phone='$p' WHERE id=$id_safe";
    $ok = mysqli_query($c, $sql); 
    mysqli_close($c);
    return $ok;
}

// *** Delete Function ***
function delete_customer($id) {
    $c = db_connect();
    $id_safe = (int)$id;
    if ($id_safe === 0) {
        mysqli_close($c); 
        return false;
    }
    // SQL query to delete the record
    $sql = "DELETE FROM customers WHERE id=$id_safe LIMIT 1";
    $ok = mysqli_query($c, $sql); 
    mysqli_close($c);
    return $ok;
}

// *** Reset Function (Delete All) ***
function reset_customers() {
    $c = db_connect();
    // SQL query to delete all records
    $sql = "TRUNCATE TABLE customers"; 
    $ok = mysqli_query($c, $sql); 
    mysqli_close($c);
    return $ok;
}

?>