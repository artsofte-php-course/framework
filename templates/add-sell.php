<html>
<head>
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
            margin-bottom: 2%;
        }

        .node {
            margin-left: 15px;
        }

        input[type="submit"] {
            margin-top: 25px;
            width: 125px;
            height: 30px;
        }
    </style>
</head>
<body>
<h1 class="header">Add new sell to the DB</h1>
<div class="node">
    <ul>
        <?php foreach ($errors as $error): ?>
            <li style="color: red;"><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>

    <form action="/addsell" method="post">
        <p>Price of the appartment</p>
        <input type="number" min="500000" name="sum" required>
        <br>
        <!--Spisok vseh contractov-->
        <p>Contract number, Contractor, Living complex name</p>
        <select size="1" name="contract_info">
            <?php foreach ($contractsRepository->getAll() as $contract): ?>
                <option><?php echo $contract['number'] . ', ' . $contract['agent_name'] . ', ' . $contract['living_complex']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <p>Apartment number</p>
        <input type="number" min="1" name="apartment_number" required>
        <br>
        <?php if (count($contractsRepository->getAll()) == 0) {
            echo '<input type="submit" value="Register" disabled>';
            echo '<p style="color: red;">Form is unavailable - contracts list is empty. Please, add contract to use this form</p>';
        } ?>
        <?php if (count($contractsRepository->getAll()) != 0)
            echo '<input type="submit" value="Register">'; ?>
    </form>
</div>
</body>
</html>
