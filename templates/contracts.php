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

        table, tr, td {
            border: 1px solid black;
            border-collapse: collapse;
            background-color: white;
        }

        td {
            padding: 4px;
        }

    </style>
</head>
<body>
<?php //echo 'Hello?';?>
<h1 class="header">All contracts</h1>
<div class="node">
    <table>
        <th>Contract number</th>
        <th>Agent name</th>
        <th>Living complex</th>
        <th>Award type</th>
        <th>Award size</th>
        <th>Sign date</th>
        <th>Expiration date</th>
        <?php $grandTotal = 0; ?>
        <?php foreach ($contractsRepository->getAll() as $contract): ?>
            <tr>
                <td><?php echo $contract['number']; ?></td>
                <td><?php echo $contract['agent_name']; ?></td>
                <td><?php echo $contract['living_complex']; ?></td>
                <td><?php echo $contract['award_type']; ?></td>
                <td><?php echo $contract['award_size']; ?></td>
                <td><?php echo $contract['sign_date']; ?></td>
                <td><?php echo $contract['expiration_date']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>