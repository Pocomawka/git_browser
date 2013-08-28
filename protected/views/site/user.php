<div class="user-block">
    <div class="user-photo fl-l">
        <img src="<?php echo $user['avatar_url']; ?>">
        <a class="like-button <?php echo $user['like'] ? 'red' : 'green'; ?>" href="<?php echo Yii::app()->createUrl('site/like', array('type' => 'user', 'id' => $user['id'])); ?>">
            <?php echo $user['like'] ? 'UnLike' : 'Like'; ?>
        </a>
    </div>
    <div class="user-info fl-l">
        <ul class="list">
            <li class="list-title">
                <?php echo $user['name']; ?>
            </li>
            <li class="list-desc">
                <?php echo $user['login']; ?>
            </li>
            <li class="list-info">
                <b>company:</b> <?php echo $user['company']; ?>
            </li>
            <li class="list-info">
                <b>blog:</b> <a href="<?php echo $user['blog']; ?>"><?php echo $user['blog']; ?></a>
            </li>
            <li class="list-info">
                <b>followers:</b> <?php echo $user['followers']; ?>
            </li>
        </ul>
    </div>
    <div class="clear"></div>
</div>
