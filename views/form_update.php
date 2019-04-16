<h2>Update the Form</h2>

<form action="/forms/update" method="POST">
    Title:
    <input type="text" name= "form[title]" value="<?=$form['title']?>"/>
    <br>
    Content:
    <textarea name="form[content]"><?=$form['content']?></textarea>
    <br>
    <input type="submit" value="Update" />
    <input type="hidden" name="form[id]" value="<?=$form['id']?>" />

</form>