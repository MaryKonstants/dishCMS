<?php


$dictionary = $model->dictionary;
?>

<div id="dictionary">
    <table class="table">
        <thead>
        <tr>
            <th>Значение</th>
            <th>Дополнительное свойство</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dictionary as $element) : ?>
        <?php $id =  $element->id ?>
        <tr>
            <td>
                <input id="EavDictionaryVal<?= $element->id ?>" type=text name="EavDictionary[<?php echo $element->id; ?>][val]" value="<?php echo $element->value; ?>">
            </td>
            <td>
                <input id="EavDictionaryProp<?= $element->id ?>" type=text name="EavDictionary[<?php echo $element->id; ?>][prop]" value="<?php echo $element->property; ?>">
            </td>
            <td>
                <span id="Remove<?= $element->id ?>" data-id="<?= $element->id ?>" class="glyphicon glyphicon-remove btn-remove" title="Удалить"></span>
            </td>
        </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="row buttons">
    <div id="element_add" class="btn btn-primary">Добавить</div>
</div>
<template id="dictionaryRow">
    <tr>
        <td>
            <input id="EavDictionaryValIdRow" type=text name="EavDictionary[IdRow][val]" value="">
        </td>
        <td>
            <input id="EavDictionaryPropIdRow" type=text name="EavDictionary[IdRow][prop]" value="">
        </td>
        <td>
            <span id="RemoveIdRow" data-id="IdRow" class="glyphicon glyphicon-remove btn-remove" title="Удалить"></span>
        </td>
    </tr>
</template>
<script>
    $(document).ready(function() {
        var id = <?= $id ? $id + 1 : 0 ?>;
        $('#element_add').click(function() {
            var row = dictionaryRow.content.cloneNode(true);
            var tbody = $('#dictionary tbody');
            tbody.append(row)
            row = tbody.find('tr:last-child');
            var html = row.html().replaceAll('IdRow', id);
            row.html(html);
            id++;
        });
        $('body').on('click', '.glyphicon-remove', function() {
            var $tr = $(this).closest('tr')
            $tr.remove();
        });
    });
</script>