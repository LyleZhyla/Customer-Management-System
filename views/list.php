<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer List </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5"> <div class="row mb-3">
        <div class="col-md-6">
            <h2>Customer List</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="index.php?action=new" class="btn btn-primary me-2">Add New Customer</a>
            <a href="index.php?action=reset" class="btn btn-danger" 
               onclick="return confirm('Are you sure you want to delete ALL customers? This cannot be undone.');">Reset All</a>
        </div>
    </div>
    
    <div class="table-responsive"> 
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($customers)): ?>
                    <tr><td colspan="5" class="text-center">No customers found.</td></tr>
                <?php endif; ?>
                
                <?php foreach ($customers as $c): ?>
                <tr>
                    <td><?= $c['id'] ?></td>
                    <td><?= htmlspecialchars($c['name']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= htmlspecialchars($c['phone']) ?></td>
                    <td>
                        <a href="index.php?action=edit&id=<?= $c['id'] ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="index.php?action=delete&id=<?= $c['id'] ?>" class="btn btn-sm btn-warning" 
                           onclick="return confirm('Are you sure you want to delete this customer?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>