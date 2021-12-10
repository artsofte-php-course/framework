<html>
<head>
    <style>
        body {
            background-color: rgb(230, 230, 230);
            margin: 0;
            font-family: sans-serif;
            height: 100%;
        }

        .comission-table {
            background-color: white;
        }

        table, tr, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .agent-name {
            margin-bottom: 0;
            background-color: white;
            width: fit-content;
            padding: 2px;

            border-width: 1px;
            border-style: solid;
            border-color: black;
            border-bottom: none;
        }

        .node {
            margin-left: 15px;
        }

        .grand-total {
            margin-left: 15px;
            font-weight: bold;
            font-size: 1.5em;
            background-color: white;
            width: fit-content;
            padding: 4px;

            border-width: 1px;
            border-style: solid;
            border-color: black;
        }

        td {
            padding: 4px;
        }

        .header {
            color: white;
            background-color: black;
            padding: 15px;
            margin-bottom: 2%;
        }

        .total {
            background-color: white;
            width: fit-content;
            margin-top: 0;
            padding: 4px;

            border-width: 1px;
            border-style: solid;
            border-color: black;
            border-top: none;
        }

    </style>
</head>
<body>
<?php $grandTotal = 0; ?>
<h1 class="header">See total commission payments</h1>
<?php foreach ($agentsRepository->getAllAgentsIds() as $id): ?>
    <div class="node">
        <h1 class="agent-name"><?php echo $agentsRepository->getAgentNameById($id[0]) ?></h1>
        <?php $total = 0; ?>
        <table class="comission-table">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Sum</td>
                <td>Contract number</td>
                <td>Appartment number</td>
                <td>Living complex name</td>
            </tr>
            <?php foreach ($sellsRepository->getAllByAgentId($id[0]) as $sell): ?>
                <tr>
                    <td><?php echo $sell['agent_id'] ?></td>
                    <td><?php echo $agentsRepository->getAgentNameById($sell['agent_id']) ?></td>
                    <td><?php echo $sell['sum'] . ' rub.' ?></td>
                    <td><?php echo $sell['contract_number'] ?></td>
                    <td><?php echo '# ' . $sell['apartment_number'] ?></td>
                    <td><?php echo $sell['living_complex'] ?></td>
                    <?php $total += (int)$sell['sum']; ?>
                </tr>
            <?php endforeach; ?>
            <?php $grandTotal += $total ?>
        </table>
        <p class="total">Total: <?php echo $total ?></p>
    </div>
<?php endforeach; ?>
<hr>
<p class="grand-total">Grand total: <?php echo $grandTotal ?></p>


<!--<table>-->
<!--    <tr>-->
<!--        <td>ID</td>-->
<!--        <td>Name</td>-->
<!--        <td>Sum</td>-->
<!--        <td>Contract number</td>-->
<!--        <td>Appartment number</td>-->
<!--        <td>Living complex name</td>-->
<!--    </tr>-->
<!---->
<!--    --><?php //foreach ($sells as $sell): ?>
<!--        <tr>-->
<!--            <td>--><?php //echo $sell['agent_id']?><!--</td>-->
<!--            <td>--><?php //echo $agentsRepository->getAgentNameById($sell['agent_id'])?><!--</td>-->
<!--            <td>--><?php //echo $sell['sum'] . ' rub.'?><!--</td>-->
<!--            <td>--><?php //echo $sell['contract_number']?><!--</td>-->
<!--            <td>--><?php //echo '# ' . $sell['apartment_number']?><!--</td>-->
<!--            <td>--><?php //echo $sell['living_complex']?><!--</td>-->
<!---->
<!--        </tr>-->
<!--    --><?php //endforeach; ?>
<!--</table>-->

</body>
</html>