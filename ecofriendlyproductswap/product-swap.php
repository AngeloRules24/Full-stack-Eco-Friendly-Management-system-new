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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <style>
        :root {
            --primary: #4CAF50;
            --primary-light: #E8F5E9;
            --primary-dark: #388E3C;
            --secondary: #FF9800;
            --secondary-light: #FFE0B2;
            --text-dark: #333;
            --text-light: #666;
            --bg-light: #f9f9f9;
            --white: #fff;
            --shadow: 0 4px 12px rgba(0,0,0,0.1);
            --radius: 12px;
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-light) 0%, #f5f5f5 100%);
            color: var(--text-dark);
            margin: 0;
            min-height: 100vh;
        }
      

      
      .content{
        background-color: white;
        margin: 20px auto;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        max-width: 1200px;
      }
      
      .swap-form{
        padding: 20px 0;
      }

      input, select, textarea{
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 300px;
        font-size: 14px;
      }
      
      textarea{
        height: 80px;
        resize: vertical;
      }
      
      label{
        width: 240px;
        display: inline-block;
        font-weight: 500;
        margin-bottom: 5px;
      }
      
      .button, .btn{
        background: #2d5a27;
        border-radius: 20px;
        border: 0px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        color: #fff;
        cursor: pointer;
        padding: 12px 30px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        transition: background 0.3s ease;
        margin: 10px 5px;
      }
      
      .button:hover, .btn:hover{
        background: #1e3f1a;
        transform: translateY(-1px);
      }
      
      form{
        padding: 20px 0;
      }
      
      h2 {
        color: #2d5a27;
        font-size: 24px;
        font-weight: 600;
      }
      
      h3 {
        color: #2d5a27;
        font-size: 20px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #67ab72;
      }
      
      h4 {
        color: #333;
        font-size: 18px;
        margin: 20px 0 10px 0;
      }
      
      .form-group {
        margin-bottom: 20px;
      }
      
      .swap-navigation {
        text-align: center;
        margin: 30px 0;
      }
      
      .swap-nav-button {
        background: #2d5a27;
        color: white;
        text-decoration: none;
        padding: 12px 25px;
        border-radius: 20px;
        margin: 0 10px;
        display: inline-block;
        transition: all 0.3s ease;
        font-weight: 500;
      }
      
      .swap-nav-button:hover {
        background: #1e3f1a;
        transform: translateY(-2px);
      }
    </style>

    <title>Eco-Friendly Product Swap</title>
</head>
<body>


    <div class="content">
        <h3>Add Product to Swap</h3>
        <form action="swapping.php" class="swap-form" method="POST">
            
            <h4>Product to Swap:</h4>
            
            <div class="form-group">
                <label for="category">Select Item Category: </label>
                <select name="category" id="category" required>
                    <option value="" disabled selected>--Select Category--</option>
                    <option value="gardening">Gardening Supplies</option>
                    <option value="home">Home & Kitchen</option>
                    <option value="clothing">Clothing & Textiles</option>
                    <option value="crafts">Handmade Crafts</option>
                    <option value="books">Books & Education</option>
                    <option value="tools">Tools & Equipment</option>
                    <option value="other">Other Eco Products</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="product1">Product Name:</label>
                <input type="text" id="product1" name="product1" placeholder="Enter product name" required />
            </div>
            
            <div class="form-group">
                <label for="description">Product Description: </label>
                <textarea name="description" placeholder="Enter Product Description" required></textarea>
            </div>
            
            <h4>Optional:</h4>
            
            <div class="form-group">
                <label for="product2">Desired Product Name: </label>
                <input type="text" id="product2" name="product2" placeholder="Enter desired product name"/>
            </div>
            
            <div class="form-group">
                <button class="btn" type="submit" name="submit">Submit</button>
                <button class="btn" type="reset" name="clear">Clear</button>
            </div>
        </form>
    </div>
    
    <div class="swap-navigation">
        <a href="view.php" class="swap-nav-button">View Available Swaps</a>
        <a href="myview.php" class="swap-nav-button">View My Swaps</a>
    </div>
    

</body>
</html>