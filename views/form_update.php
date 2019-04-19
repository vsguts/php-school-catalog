<h2>Update the form</h2>

<form action="/forms/update?id=<?= $form['id']; ?>" method="POST">
    Title:
    <input type="text" name="form[title]" value="<?= $form['title']; ?>"/>
    <br>
    Content:
    <textarea name="form[content]"><?= $form['content']; ?></textarea>
    <br>
    <input type="submit" value="Save" />
</form>