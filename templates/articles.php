<html>
<head>

</head>
<body>


<table>
    <tr>
        <td>ID</td>
        <td>Name</td>
    </tr>

<?php foreach ($articles as $article): ?>
    <tr>
        <td><?php echo $article['id']?></td>
        <td><a href="/show?id=<?php echo $article['id'] ?>"><?php echo $article['name']?></a></td>
    </tr>
<?php endforeach; ?>

</body>
</html>