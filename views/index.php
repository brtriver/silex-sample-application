<h1>Blog posts</h1>
<table>
<tr>
<td>Id</td>
<td>Title</td>
<td>CreatedAt</td>
</tr>
<!-- ここから、posts配列をループして、投稿記事の情報を表示 -->
<?php foreach ($posts as $post): ?>
<tr>
<td><?php echo $app->escape($post['id']) ?></td>
<td><a href="<?php echo $app['request']->getBaseUrl() ?>/blog/<?php echo $app->escape($post['id']) ?>"><?php echo $app->escape($post['name']) ?></a></td>
<td><?php echo date('Y/m/d H:i', strtotime($post['created'])) ?></td>
</tr>
<?php endforeach ?>
</table>