<h1><?php echo $post['name'] ?></h1>
<p><small>Created:<?php echo date('Y/m/d H:i', strtotime($post['created'])) ?></small></p>
<p><small>Updated:<?php echo date('Y/m/d H:i', strtotime($post['modified'])) ?></small></p>
<p><?php echo nl2br($post['body']) ?></p>