<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="list-group">
                <? foreach ($data['list'] as $k => $v): ?>
                    <a href="<?= $v['link']; ?>" class="list-group-item"><?= $v['name']; ?></a>
                <? endforeach; ?>
            </div>

        </div>
    </div>
</div>
