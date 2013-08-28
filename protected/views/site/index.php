<div class="left-col">
    <ul class="list">
        <li class="list-title">
            <?php echo $repo['full_name']; ?>
        </li>
        <li class="list-desc">
            <?php echo $repo['description']; ?>
        </li>
        <li class="list-info">
            <b>watchers:</b> <?php echo $repo['watchers']; ?>
        </li>
        <li class="list-info">
            <b>forks:</b> <?php echo $repo['forks']; ?>
        </li>
        <li class="list-info">
            <b>open_issues:</b> <?php echo $repo['open_issues']; ?>
        </li>
        <li class="list-info">
            <b>homepage:</b> <?php echo $repo['homepage']; ?>
        </li>
        <li class="list-info">
            <b>GitHub repo:</b> <?php echo $repo['svn_url']; ?>
        </li>
        <li class="list-info">
            <b>created_at:</b> <?php echo $repo['created_at']; ?>
        </li>
        <li>
            <a class="like-button repo-like <?php echo $repo['like'] ? 'red' : 'green'; ?>" href="<?php echo Yii::app()->createUrl('site/like', array('type' => 'repo', 'id' => $repo['id'])); ?>">
                <?php echo $repo['like'] ? 'UnLike' : 'Like'; ?>
            </a> 
        </li>
    </ul>

</div>
<div class="right-col">
    <table class="cont-list">
        <tr class="contr-title">
            <td colspan="2">       
                Contributors
            </td>
        </tr>
        <?php foreach ($contributors as $contributor) : ?>
            <tr>
                <td>
                    <a href="<?php echo Yii::app()->createUrl('site/users', array('user' => $contributor['login'])); ?>"><?php echo $contributor['login']; ?></a>
                </td>
                <td>
                    <a class="like-button <?php echo $contributor['like'] ? 'red' : 'green'; ?>" href="<?php echo Yii::app()->createUrl('site/like', array('type' => 'user', 'id' => $contributor['id'])); ?>">
                        <?php echo $contributor['like'] ? 'UnLike' : 'Like'; ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<div class="clear"></div>
