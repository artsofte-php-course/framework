<html>
<head>
    <link rel="stylesheet" href="css/index.css"/>
    <style>
        body {
            background-color: rgb(230, 230, 230);
            margin: 0;
            font-family: sans-serif;
            height: 100%;
        }

        .header {
            color: white;
            background-color: black;
            padding: 15px;
            margin-bottom: 5%;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: black;
            color: white;
            padding-left: 10px;
            padding-top: 10px;
            height: 40px;
            margin-bottom: 0;
        }

        .menu {
            margin: 0 auto;
            background-color: white;
            font-size: 2em;
            display: block;
            width: fit-content;
            /*padding: 10px;*/
            list-style: none;
            border-radius: 10px;
            border-color: black;
            border-style: solid;
            border-width: 5px;
            padding: 0;
        }

        .menu li:hover {
            background-color: gray;
        }

        .menu li {
            padding: 5px 10px;
        }

        .menu li a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
<h1 class="header">Welcome!</h1>
<ul class="menu">
    <li><a href="/table">Watch the table</a></li>
    <li><a href="/addsell">Add new sell</a></li>
    <li><a href="/contracts">See contracts</a></li>
    <li><a href="/addcontract">Add new contract</a></li>
</ul>
<p class="footer">©2021, Made by Maxim D.</p>
</body>
</html>