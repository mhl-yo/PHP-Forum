<div class="main">
    <h1><?= htmlspecialchars($this->title); ?></h1>

    <table class="profileTable">
        <?php foreach ($this->users as $user) : ?>
            <tr>
                <td class="userProfileTd"><strong>Username: </strong></td>
                <td class="userProfileTd"><?= htmlspecialchars($user['username']) ?></td>
            </tr>
            <?php if ($user['fname'] != NULL) : ?>
                <tr>
                    <td class="userProfileTd"><strong>First name: </strong></td>
                    <td class="userProfileTd"><?= htmlspecialchars($user['fname']) ?></td>
                </tr>
            <?php endif ?>
            <?php if ($user['lname'] != NULL) : ?>
                <tr>
                    <td class="userProfileTd"><strong>Last name: </strong></td>
                    <td class="userProfileTd"><?= htmlspecialchars($user['lname']) ?></td>
                </tr>
            <?php endif ?>
            <tr>
                <td class="userProfileTd"><strong>Email: </strong></td>
                <td class="userProfileTd"><?= htmlspecialchars($user['email']) ?></td>
            </tr>
            <tr>
                <td class="userProfileTd"><strong>User status: </strong></td>
                <?php if ($user['isAdmin'] < 1) : ?>
                    <td class="userProfileTd successText">Normal user</td>
                <?php else : ?>
                    <td class="userProfileTd infoText">Administrator</td>
                <?php endif ?>
            </tr>
            <?php if ($_SESSION['isAdmin'] > 0 && $user['id'] != $_SESSION['userId']) : ?>
                <tr>
                    <td class="warningText"><a href="/account/deleteUser/<?= $user['id'] ?> ">[DELETE]</a></td>
                    <?php if ($user['isAdmin'] == 0) : ?>
                        <td class="infoText"><a href="/account/promoteAdmin/<?= $user['id'] ?> ">[Promote to Admin]</a>
                        </td>
                    <?php endif ?>
                    <?php if ($user['isAdmin'] == 1) : ?>
                        <td class="warningText"><a href="/account/downgradeAdmin/<?= $user['id'] ?> ">[Downgrade to Normal]</a></td>
                    <?php endif ?>
                </tr>
            <?php endif ?>
        <?php endforeach ?>
        <!--        <tr>-->
        <!--            <td class="userProfileTd">-->
        <!--                <a href="/account/editProfile">Edit profile</a>-->
        <!--            </td>-->
        <!--        </tr>-->
    </table>

</div>