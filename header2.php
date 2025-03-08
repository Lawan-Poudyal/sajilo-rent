<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            padding: 0 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            display: flex;
            align-items: center;
            height: 80px;
            position: sticky;
            top: 0;
            z-index: 50;
            justify-content: space-between;
        }

        .nav-left {
            display: flex;
            align-items: center;
        }

        .sajilo-rent-logo {
            background: url("/sajilo-rent/resources/logo.png") no-repeat center;
            background-size: contain;
            height: 50px;
            width: 50px;
            cursor: pointer;
        }

        .back-button {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            background-color: #f5f5f5;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            color: #333;
            margin-left: 15px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #e0e0e0;
        }

        .back-button i {
            margin-right: 5px;
        }

        .nav-search {
            display: flex;
            flex-grow: 1;
            max-width: 600px;
            margin: 0 20px;
        }

        .nav-search input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 24px 0 0 24px;
            outline: none;
        }

        .nav-search button {
            padding: 10px 20px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 0 24px 24px 0;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .nav-search button:hover {
            background-color: #333;
        }

        .menu-button {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 24px;
            padding: 0;
        }

        .menu-button span {
            width: 100%;
            height: 3px;
            background-color: #333;
            border-radius: 3px;
            transition: all 0.3s;
        }

        .menu-button:hover span {
            background-color: #000;
        }

        @media (max-width: 768px) {
            .nav-search {
                display: none;
            }
        }
    </style>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <nav class="nav">
        <div class="nav-left">
            <div class="sajilo-rent-logo" id="logo-btn" onclick="showaside2()"></div>
            <button class="back-button" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</button>
        </div>

        <form class="nav-search">
            <input type="text" placeholder="Search">
            <button type="submit">Search</button>
        </form>

        <button class="menu-button" id="menu-btn" onclick="showaside()">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>