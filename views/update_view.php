<div>

    <h2>Update Your Form</h2>
    <br>

    <form action="/forms/save?id=<?= $form['id'] ?>" method="POST">

        Current Title:<br>
        <input type="text" name="form[title]" value="<?= $form['title'] ?>">
        <br>
        Current Content:<br>
        <textarea name="form[content]"><?= $form['content'] ?></textarea>
        <br>
        <input type="submit" value="Update">

    </form>
</div>
