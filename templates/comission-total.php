<html>
<head>

</head>
<body>
<?php $grandTotal = 0;?>
<?php foreach ($agentsRepository->getAllAgentsIds() as $id): ?>
    <h1><?php echo $agentsRepository->getAgentNameById($id[0]) ?></h1>
    <?php $total = 0;?>
    <table>
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
                <?php $total += (int)$sell['sum'];?>
            </tr>
        <?php endforeach; ?>
        <?php $grandTotal += $total?>
    </table>
    <p>Total: <?php echo $total?></p>
<?php endforeach; ?>
<p>Grand total: <?php echo $grandTotal?></p>


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