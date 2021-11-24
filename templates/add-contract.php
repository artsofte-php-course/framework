<html>
<head>

</head>
<body>
<h1>Add new contract to the DB</h1>

<ul>
    <?php foreach ($errors as $error): ?>
        <li style="color: red;"><?php echo $error; ?></li>
    <?php endforeach; ?>
</ul>

<form action="/addcontract" method="post">
    <p>Contract number</p>
    <input type="number" min="0" name="number" required>
    <br>
    <p>Agent name</p>
    <input type="text" name="agent_name" required>
    <br>
    <p>Living complex</p>
    <input type="text" name="living_complex" required>
    <br>
    <p>Award type</p>
    <select size="1" name="award_type">
        <option value="fix">Fixed award</option>
        <option value="percent">Percented award</option>
    </select>
    <br>
    <p>Award size</p>
    <input type="number" min="0" name="award_size" required>
    <br>
    <p>Sign date</p>
    <input type="date" name="sign_date" required>
    <br>
    <p>Expiration date</p>
    <input type="date" name="expiration_date" required>
    <br>
    <input type="submit" value="Register">
</form>
</body>
</html>
