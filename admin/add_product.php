<?php
session_start();
require '../includes/db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    $image = $_POST['image'];
   
    try {
        $stmt = $pdo->prepare("INSERT INTO products (name, description, price, category, stock, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $category, $stock, $image]);
        
        $_SESSION['message'] = "Product added successfully";
    } catch (Exception $e) {
        $_SESSION['message'] = "Error adding product: " . $e->getMessage();
    }

    header('Location: add_product.php');
    exit(); 
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <style>
        *{
            margin:0;
            padding:0;
            outline:0;
            border:0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction:column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        body .message{
            width: 600px;
            margin-inline:auto;
            padding:1.2rem;
            background-color:#54FD89;
            text-align:left;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #4cae4c;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Add Product</h1>

    <?php
    // Display success or error message
    if (isset($_SESSION['message'])) {
       
        echo "<p class='message'>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']); // Clear the message after displaying it
        
    }
    ?>
</div>
    <form method="POST" action="add_product.php">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br>
        <label for="price">Price:</label>
        <input type="number" step="100" name="price" id="price" required><br>
        <label for="category">Category:</label>
        <input type="text" name="category" id="category" required><br>
        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" required><br>
        <label for="image">ImageURL:</label>
        <input type="text" name="image" id="image" required><br>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
