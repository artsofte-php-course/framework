<html>
<head>

</head>
<body>
<h1>Add new sell to the DB</h1>
<form action="/addsell" method="post">
    <p>Price of the appartment</p>
    <input type="number" min="500000" name="sum">
    <br>
    <!--Spisok vseh contractov-->
    <p>Contract number, Contractor, Living complex name</p>
    <select size="1" name="contract_info">
        <?php foreach ($contractsRepository->getAll() as $contract): ?>
            <option><?php echo $contract['number'] . ', ' . $contract['agent_name'] . ', ' . $contract['living_complex'];?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <p>Apartment number</p>
    <input type="number" min="1" name="apartment_number">
    <br>
    <input type="submit" value="Register">
</form>
</body>
</html>
