<div>
    <form action="/forms/save" method="POST">
        <input type="hidden" required name="form[id]" value="<?= $form['id'] ?>">
        Title: <br>
        <input type="text" required name="form[title]" value="<?= $form['title'] ?>"/>
        <br>
        Content: <br>
        <textarea name="form[content]" required><?= $form['content'] ?></textarea>
        <br>
        <input type="submit" value="save"/>
    </form>
    <p><a href="/forms">Return to forms list</a></p>
</div>
