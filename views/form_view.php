
<div style="padding: 10px;border: 2px solid gainsboro;border-radius: 10px">
    <h1><?= $form['title'] ?></h1>
    <p><?= $form['content'] ?></p>
    <p><i>Created at: <?= $form['created_at'] ?></i></p>

    <p><a href="/forms/delete?id=<?= $form['id'] ?>">Delete this form</a></p>
    <a href="/forms/update?id=<?= $form['id'] ?>">Update this form</a>
    <p><a href="/forms">Return to forms list</a></p>

</div>
