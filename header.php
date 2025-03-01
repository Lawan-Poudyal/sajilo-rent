<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Navbar</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
        }
        nav {
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            display: flex;
            align-items: center;
            height: 80px; 
          }
        .sajilo-rent-logo {
            background: url("/sajilo-rent/resources/logo.png") no-repeat center;
            background-size: contain;
            height: 50px;
            width: 50px;
        }
    </style>
</head>
<body>
    <nav>
        <div class="sajilo-rent-logo"></div>
    </nav>
</body>
</html>