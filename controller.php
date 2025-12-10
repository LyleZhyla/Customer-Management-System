<?php
// controller.php

include 'model.php'; // I-include ang Model para magamit ang database functions

// *** 1. Handle POST Requests (Adding and Updating Data) ***
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Kunin ang input data mula sa POST
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $id = $_POST['id'] ?? 0; 

    if (isset($_POST['add'])) { 
        
        add_customer($name, $email, $phone); 
        header('Location: index.php'); 
        exit;
    } elseif (isset($_POST['update'])) { 
        
        if ($id) {
            update_customer($id, $name, $email, $phone); 
        }
        header('Location: index.php'); 
        exit;
    }
}

// *** 2. Determine Which View or Action to Execute (Routing) ***
$action = $_GET['action'] ?? 'list'; 

if ($action === 'new') { 
    // Show form for new customer
    include 'views/form.php';
} elseif ($action === 'edit' && isset($_GET['id'])) { 
    // Load existing record and show form for editing
    $customer = fetch_customer($_GET['id']); 
    // Kung hindi mahanap ang customer, i-redirect
    if (!$customer) {
        header('Location: index.php'); 
        exit;
    }
    include 'views/form.php';
} elseif ($action === 'delete' && isset($_GET['id'])) { 
    // Handle DELETE action
    delete_customer($_GET['id']);
    header('Location: index.php'); // Redirect pabalik sa list
    exit;
} elseif ($action === 'reset') { 
    // Handle RESET action 
    reset_customers();
    header('Location: index.php'); // Redirect pabalik sa list
    exit;
} else { 
    // Default action: Fetch all customers and show list view
    $customers = fetch_all_customers(); 
    include 'views/list.php';
}
?>