<div class="main">
    <h1><?= htmlspecialchars($this->title);?></h1>

    <form action="/questions/postAnswer" method="post">
        <input type="hidden" value="<?= $this->questionId ?> " name="theQuestionId"/>

        <label for="answerContent">Content:</label>
        <textarea id="answerContent" name="answerContent"></textarea>

        <?php if(!$this->isLoggedIn) : ?>
            <label for="annonimusName">Your name: </label>
            <input type="text" id="annonimusName" name="annonimusName"/>

            <label for="annonimusEmail">Your email</label>
            <input type="text" id="annonimusEmail" name="annonimusEmail"/>


        <?php endif ?>

        <input type="submit" name="submit" value="Answer" />
    </form>
</div>