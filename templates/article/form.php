<p>Fill form for new article</p>
<form action="/create" method="POST">
    <label for="name" >Article name</label><br />
    <input type="text" name="article[name]" /> <br />
    <label for="body" >Article body</label><br />
    <textarea name="article[body]" ></textarea><br />
    <input type="submit" value="Add article" />
</form>

<a href="/" >Back to list</a>
