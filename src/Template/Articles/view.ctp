
<h1><?= h($articles->title) ?></h1>
<p><?= h($articles->body) ?></p>
<p><small>Created: <?= $articles->created->format(DATE_RFC850) ?></small></p>
