<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($customer) ? 'Edit' : 'Add' ?> Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5"> <div class="row justify-content-center"> <div class="col-md-6"> <h2><?= isset($customer) ? 'Edit Existing' : 'Add New' ?> Customer</h2>
            
            <form method="post" action="index.php"> 
                
                <?php if (isset($customer)): ?>
                    <input type="hidden" name="id" value="<?= $customer['id'] ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?= $customer['name'] ?? '' ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?= $customer['email'] ?? '' ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="<?= $customer['phone'] ?? '' ?>">
                </div>
                
                <button type="submit" name="<?= isset($customer) ? 'update' : 'add' ?>" class="btn btn-success">
                    Save Changes
                </button>
            </form>
            
            <p class="mt-3"><a href="index.php">Back to Customer List</a></p>
        </div>
    </div>
</div>
</body>
</html>