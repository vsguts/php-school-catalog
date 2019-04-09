<div>
    <form action="/forms/getChange" method="POST">
        Title:
        <input type="text" name="form[title]" value="<?= $form['title'] ?>"/>
        <br>
        Content:
        <textarea name="form[content]"><?= $form['content'] ?></textarea>
        <br>
        <input type="submit" value="Keep Change"/>
        <input type = "text" name="id" value="<?= $form['id'] ?> " hidden />
    </form>


    <!--    <h1>--><? //= $form['title'] ?><!--</h1>-->
    <!--    <p>--><? //= $form['content'] ?><!--</p>-->
    <!--    <p><i>Created at: --><? //= $form['created_at'] ?><!--</i></p>-->

    <!--    <p><a href="/forms/update?id=--><? //= $form['id'], $form['created_at']?><!--">Accept changes</a></p>-->
    <p><a href="/forms/view?id=<?= $form['id'] ?>">Cancel</a></p>

</div>
