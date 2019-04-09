<form action="/forms/update" method="POST">
    Title:
    <input type="text" name="form[title]" value="<?php echo $form['title']?>" />
    <br>
    Content:
    <textarea name="form[content]" placeholder="<?php echo $form['content']?>" ></textarea>
    <br>
    <input type="submit" value="Update" />
    <input type = "text" name="id" value="<?= $form['id'] ?> " hidden />
</form>