<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successfully Registered</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .registrationsuccesscontainer {
            background-color: #c9e7d8ff;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            padding: 50px 40px;
            text-align: center;
        }

        .registrationsuccesscontainer img {
            width: 80px;
            height: 80px;
        }

        .registrationsuccesscontainer h1 {
            margin-bottom: 15px;
            font-size: 32px;
            font-weight: 600;
        }

        .registrationsuccesscontainer h5 {
            color: #5a6c7d;
            margin-bottom: 30px;
            font-size: 18px;
            font-weight: 400;
        }

        .registrationsuccesscontainer button {
            background-color: #000000;
            color: white;
            border: none;
            padding: 14px 30px;
            border-radius: 40px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .registrationsuccesscontainer button:hover {
            background-color: #3B3B3B;
        }

    </style>
</head>
<body>
    <div class = "registrationsuccesscontainer">
        <img src="leaf.png" alt="leaf">
        <h1>Registration successful</h1>
        <h5>Thank you for registrating with EcoNest</h5>
        <a href="login.php">
            <button>Login</button>
        </a>
    </div>
</body>
</html>