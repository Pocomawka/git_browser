<?php if (isset($repos)) : ?>
    <?php foreach ($repos['items'] as $repo) : ?>
        <div class="repo">
            <div class="repo-links">
                <a class="repo-name" href="<?php echo strtolower(Yii::app()->createUrl('site/index', array('owner' => $repo['owner']['login'], 'repo' => $repo['name']))); ?>">
                    <?php echo $repo['name']; ?>
                </a>
                <a href="<?php echo $repo['homepage']; ?>">
                    <?php echo $repo['homepage']; ?>
                </a>
                <a href="<?php echo Yii::app()->createUrl('site/users', array('user' => $repo['owner']['login'])); ?>">
                    <?php echo $repo['owner']['login']; ?>
                </a>
            </div>
            <div class="clear"></div>
            <div class="repo-desc">
                <?php echo $repo['description']; ?>
            </div>
            <div class="repo-info">
                <span>
                    <b>watchers:</b> <?php echo $repo['watchers_count']; ?>
                </span>
                <span>        
                    <b>forks:</b> <?php echo $repo['forks_count']; ?>
                </span>
                <a class="like-button search-like <?php echo $repo['like'] ? 'red' : 'green'; ?>" href="<?php echo Yii::app()->createUrl('site/like', array('type' => 'repo', 'id' => $repo['id'])); ?>">
                    <?php echo $repo['like'] ? 'UnLike' : 'Like'; ?>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <h3>Nothing was found</h3>
<?php endif; ?>

