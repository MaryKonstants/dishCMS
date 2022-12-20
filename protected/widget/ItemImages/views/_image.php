<li>
    <div class="foto_wrap">
        <a href="<?= $data->url ?>" data-fancybox="gallery" data-options='{"loop": true}' title="<?php echo $data->description; ?>">
            <img src="<?= ResizeHelper::resize($data->url, 400, 300) ?>" alt="<?php echo $data->description; ?>"/>
        </a>
    </div>
</li>
