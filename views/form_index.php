<h1>Forms List</h1>

<?php foreach ($forms as $form) : ?>
<div>
    <h3>
        <a href="/forms/view?id=<?= $form['id'] ?>">
            <?= $form['title'] ?>
        </a>
    </h3>
    <p><?= $form['content'] ?></p>
    <p><i>Created at: <?= $form['created_at'] ?></i></p>
    <hr />
</div>
<?php endforeach; ?>

<?php include 'form.php'; ?>

