<h2>Create new Form</h2>

<form action="/forms/create" method="POST">
    Title:
    <input type="text" name="form[title]" value="<?= isset($data) ? $data['title'] : '' ?>"/>
    <br>
    Content:
    <textarea name="form[content]"><?= isset($data) ? $data['content'] : '' ?></textarea>
    <br>
    <?php if (isset($data)) {?>
        <input name="form[id]" type="hidden" value="<?= $data['id']?>"/>
    <?php }?>

    <input type="submit" value="<?= isset($data) ? $data['button_title'] : 'Create' ?>" />
</form>
