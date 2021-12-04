<p>Fill form for new article</p>
<form action="/create" method="POST">
    <label for="name" >Article name</label><br />
    <?php if(!empty($errors) && isset($errors['name']) ): ?>
        <span style="color:red"><?php echo $errors['name'] ?></span>
    <?php endif; ?>

    <input type="text" name="article[name]"  /> <br />
    <label for="body" >Article body</label><br />
    <?php if(!empty($errors) && isset($errors['body']) ): ?>
        <span style="color:red"><?php echo $errors['body'] ?></span>
    <?php endif; ?>
    <textarea name="article[body]" ></textarea><br />
    <input type="submit" value="Add article" />
</form>

<a href="/" >Back to list</a>
