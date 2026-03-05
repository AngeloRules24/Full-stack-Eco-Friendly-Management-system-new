<?php
ob_start();
$base_path = '/rwdd/RWDD group assignment/'; 
include "../header.php";
include "../conn.php";

if (!isset($_SESSION['user_id'])) {
    header("Location:" . $base_path . "signinsignup/login.php");
    ob_end_flush();
    exit();
}

// Get product details
if(isset($_GET['id'])){
    $product_id = intval($_GET['id']);
    $sql = "SELECT * FROM productswap WHERE product_ID = $product_id";
    $result = mysqli_query($dbConn, $sql);
    
    if(mysqli_num_rows($result) > 0){
        $product = mysqli_fetch_assoc($result);
    } else {
        header("Location: view.php?error=product_not_found");
        exit();
    }
} else {
    header("Location: view.php?error=no_id");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Make Swap Offer</title>
    <style>
        :root {
            --primary: #4CAF50;
            --primary-light: #E8F5E9;
            --primary-dark: #388E3C;
            --text-dark: #333;
            --text-light: #666;
            --white: #fff;
            --shadow: 0 4px 12px rgba(0,0,0,0.1);
            --radius: 12px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-light) 0%, #f5f5f5 100%);
            color: var(--text-dark);
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 30px;
            margin-top: 40px;
        }

        h2 {
            color: #2d5a27;
            margin-bottom: 20px;
            text-align: center;
        }

        .product-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #2d5a27;
        }

        .product-info h3 {
            color: #2d5a27;
            margin-bottom: 15px;
        }

        .product-detail {
            margin-bottom: 8px;
        }

        .product-detail strong {
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2d5a27;
        }

        .form-group textarea {
            height: 120px;
            resize: vertical;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .submit-btn {
            background: #2d5a27;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 20px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            flex: 1;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: #1e3f1a;
            transform: translateY(-2px);
        }

        .cancel-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 20px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            flex: 1;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
        }

        .cancel-btn:hover {
            background: #545b62;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 10px;
            }
            
            .btn-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Make a Swap Offer</h2>
        
        <div class="product-info">
            <h3>Product You Want to Swap For:</h3>
            <div class="product-detail"><strong>Name:</strong> <?php echo htmlspecialchars($product['product1_name']); ?></div>
            <div class="product-detail"><strong>Category:</strong> <?php echo htmlspecialchars($product['product_category']); ?></div>
            <div class="product-detail"><strong>Description:</strong> <?php echo htmlspecialchars($product['product_description']); ?></div>
        </div>

        <form action="offer_process.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            
            <div class="form-group">
                <label for="offer_product">What are you offering in exchange?</label>
                <input type="text" id="offer_product" name="offer_product" placeholder="Enter the product name you want to swap" required>
            </div>
            
            <div class="form-group">
                <label for="offer_description">Describe your offer:</label>
                <textarea id="offer_description" name="offer_description" placeholder="Describe the product you're offering, its condition, and why it's a good swap..." required></textarea>
            </div>
            
            <div class="btn-group">
                <button type="submit" class="submit-btn">Send Swap Offer</button>
                <a href="view.php" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>