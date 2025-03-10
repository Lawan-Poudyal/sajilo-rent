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
            justify-content: center;
            height: 80px; 
            position:sticky;
            top:0;
            z-index:50;
          }
        .sajilo-rent-logo {
            background: url("/sajilo-rent/resources/logo.png") no-repeat center;
            background-size: contain;
            height: 50px;
            width: 50px;
        }
        .title{
            font-size: clamp(1.5rem,3rem,5rem);
            margin-left: 10px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

        }
    </style>
</head>
<body>
    <nav class="nav">
        <div class="sajilo-rent-logo"></div>
        <span class="title">Sajilo Rent</span>
    </nav>
</body>
</html>