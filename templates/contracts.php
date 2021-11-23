<html>
<head>

</head>
<body>
<?php //echo 'Hello?';?>
<h1>All contracts</h1>
<table>
    <th>Contract number</th>
    <th>Agent name</th>
    <th>Living complex</th>
    <th>Award type</th>
    <th>Award size</th>
    <th>Sign date</th>
    <th>Expiration date</th>
<?php $grandTotal = 0;?>
<?php foreach ($contractsRepository->getAll() as $contract): ?>
<tr>
    <td><?php echo $contract['number'];?></td>
    <td><?php echo $contract['agent_name'];?></td>
    <td><?php echo $contract['living_complex'];?></td>
    <td><?php echo $contract['award_type'];?></td>
    <td><?php echo $contract['award_size'];?></td>
    <td><?php echo $contract['sign_date'];?></td>
    <td><?php echo $contract['expiration_date'];?></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>