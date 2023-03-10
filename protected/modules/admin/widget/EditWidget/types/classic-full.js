tinymce.init({
    selector : "#<?=$editorSelectorId?>",
  //  plugins : "paste, table, -gismap, autolink", //-cmsbuttons
//    plugins : "hr, colorpicker, emoticons, code, visualchars, wordcount, link, -ymap, image, autolink,lists, pagebreak,layer,table, save,insertdatetime, preview,media, searchreplace,print, contextmenu,paste,directionality,fullscreen,noneditable, visualchars,nonbreaking,template",
 plugins: [
    "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak -ymap",
    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern spellchecker"
  ],
  toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
  toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
  toolbar3: "table  tablecontrols| hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | visualchars visualblocks nonbreaking template pagebreak restoredraft | other cms_gallery_1 cms_gallery_2 ymap | spellchecker | <?php if(D::cms('tinymce_adaptivy')) echo "makeResponsive"; ?>",
  toolbar_items_size: 'small',
    
	convert_urls: false,
    extended_valid_elements: "span[style]<?
        if(D::cms('tinymce_allow_scripts', 0, true)) echo ',script[language|type|src]';
        if(D::cms('tinymce_allow_iframe', 1, true)) echo ',iframe[name|src|framespacing|border|frameborder|scrolling|title|height|width]';
        if(D::cms('tinymce_allow_object', 1, true)) echo ',object[declare|classid|codebase|data|type|codetype|archive|standby|height|width|usemap|name|tabindex|align|border|hspace|vspace]';
    ?>",
    extended_valid_elements: '*[*]',
    valid_elements: '*[*]',
    invalid_elements: "<? 
        $invalids=[];
        if(!D::cms('tinymce_allow_scripts', 0, true)) $invalids[]='script';
        if(!D::cms('tinymce_allow_iframe', 1, true)) $invalids[]='iframe';
        if(!D::cms('tinymce_allow_object', 1, true)) $invalids[]='object';
        if(!empty($invalids)) echo implode(',', $invalids);
    ?>",
    valid_children : "+body[style]",
    table_class_list: [
        {title: '?????? ????????????', value: ''},
        
        {title: '?????????? ?????????? + ??????????', value: 'table-bordered table-striped'},
        {title: '?????????? ?????????? + ??????????????????????????', value: 'table-bordered table-hover'},
        {title: '?????????? ?????????? + ?????????? + ??????????????????????????', value: 'table-bordered table-hover table-striped'},
        
        {title: '?????????? "??????????"', value: 'table table-striped'},
        {title: '?????????? "??????????"', value: 'table table-bordered'},
        {title: '?????????? "??????????????????????????"', value: 'table table-hover'},
        {title: '?????????? "???????????????????? ??????????????"', value: 'table table-condensed'},
    ],
    insert_width: 200,
    mode : "textareas",
    theme : "modern",
    language : "ru",
    height : <?=$height?>,
//    menubar: "insert edit view table", /*format */
    image_advtab: true,
	image_title: true,
    menu : { // this is the complete default configuration
        insert : {title : 'Insert', items : 'link media image | template hr autolink insertdatetime'},
        edit   : {title : 'Edit'  , items : 'undo redo | cut copy selectall'},
        tools  : {title : 'Tools' , items : 'spellchecker code'},
        table  : {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
        view   : {title : 'View'  , items : 'visualaid | code'},
    },
    contextmenu: "link image inserttable | cell row column deletetable",
    content_css: '<?=$assets?>/css/editor.css',
//    toolbar1: "styleselect template | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent hr | table | code preview | link unlink | image | clearfix | removeformat | other cms_gallery_1 cms_gallery_2 ymap | <?php if(D::cms('tinymce_adaptivy')) echo "makeResponsive"; ?> | tablecontrols | undo redo",
    templates: "/js/tiny_templates/template.php",
    style_formats: [
        {title: '??????????', block: 'p'},
        {title: '?????????????????? H2', block: 'h2'},
        {title: '?????????????????? H3', block: 'h3'},
        {title: '?????????????????? H4', block: 'h4'},
        
        <?if(D::cms('tinymce_adaptivy')): ?>
            {title: "???????????? ????????????????????", block: "blockquote", "classes": "user_info_block_adaptive", wrapper: true},
        <?else:?>
            {title: "???????????? ????????????????????", block: "blockquote", "classes": "user_info_block", wrapper: true},
        <?endif?>
        
        {title: "?????????????????? ??????????", block: "div", "classes": "is_read_more", wrapper: true},

        <?if(D::cms('tinymce_adaptivy')): ?>
        {title: '???????????????? ???? ??????????????????', block: 'div', 'classes' : 'hidden_planshet', wrapper: true},
        {title: '???????????????? ???? ??????????????????', block: 'div', 'classes' : 'hidden_telephone', wrapper: true},
        <?endif; ?>
        {title: 'div', block: 'div'},

/*        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'},*/
    ],
	spellchecker_languages: "Russian=ru,English=en",
    spellchecker_language: "ru",  // default language
    spellchecker_rpc_url: "//speller.yandex.net/services/tinyspell",
    setup: function(ed) {

        ed.addCommand('insertCFix', function() {

            ed.focus();
            tinymce.activeEditor.execCommand('mceInsertContent', false, "<div class='clearfix'></div>");

        });

        ed.addCommand('mceResp', function() {

            var div_class = 'table-responsive'
            var elem = ed.dom.getParent(ed.selection.getNode(), "table");

            if(elem==null){
                div_class = 'fluid_width_video';
                var elem = ed.selection.getNode();
            }

            content = $(elem)[0].outerHTML;
            if(!$(elem).parent().hasClass(div_class)){
                if($(elem).hasClass('mce-object-iframe') || $(elem).hasClass('mce-item-table')){
                    var newdiv = $('<div class="'+div_class+'">');
                    $(elem).after('<div class="'+div_class+'">' + content + '</div><p>&nbsp;</p>');
                    $(elem).remove();
                }
            }
            else{
               if($(elem).hasClass('mce-object-iframe') || $(elem).hasClass('mce-item-table')){
                    $(elem).parent().remove();
                    $(elem).remove();
                    ed.focus();
                    ed.selection.setContent(content);
               } 
            }

        });

        ed.addButton('makeResponsive', {
            title : '???????????????? ???????????????????????? ?????? ?????????????? ?????? ??????????',
            cmd : 'mceResp',
            label: '???????????????? ????????????????????????',
            image: '<?php echo $assets; ?>/images/ico-responsible.png',
        });

        ed.addButton('clearfix', {
            title : '???????????????? ?????????? (clearfix)',
            cmd : 'insertCFix',
            label: '?????????????? clearfix',
            image: '<?php echo $assets; ?>/images/cf.jpg',
        });

        ed.addButton('tablesettings', {
            title : '??????????????',
            onclick : function(){
                tiny_togglePanel('toolbar2', 'tablesettings');
            }
        });

        ed.addButton('other', {
            title: '?????????? ???????????????? ??????????',
            image: '<?php echo $assets; ?>/images/form.png',
            onclick: function() {
                var call_block = "{form_feedback}";
                var content = ed.getContent();
                if (content.indexOf(call_block) < 0) {
                    ed.focus();
                    ed.selection.setContent(call_block);
                } else {
                    ed.windowManager.alert("???? ?????? ???????????????? ??????????");
                }
            }
        });

        ed.addButton("cms_gallery_1", {
            title   : "?????????????? (?????? 1)",
            image: '<?php echo $assets; ?>/images/gallery1.png',
            onclick : function() {
                var call_block = "{simple_gallery}";
                var content = ed.getContent();
                if (content.indexOf(call_block) < 0 && content.indexOf("{gallery}") < 0) {
                    ed.focus();
                    ed.selection.setContent(call_block);
                } else
                    ed.windowManager.alert('???? ?????? ???????????????? ??????????????');
            }
        });

        ed.addButton("cms_gallery_2", {
            title : '?????????????? (?????? 2)',
            image: '<?php echo $assets; ?>/images/gallery2.png',
            onclick : function() {
                var call_block = "{gallery}";
                var content = ed.getContent();
                var count = content.indexOf(call_block);
                if (count < 0 && content.indexOf("{simple_gallery}") < 0) {
                    ed.focus();
                    ed.selection.setContent(call_block);
                } else {
                    ed.windowManager.alert("???? ?????? ???????????????? ??????????????");
                }
            }
        });

        ed.addButton("cms_comments", {
            title : '??????????????????????',

            onclick : function() {
                var call_block = "{comments}";
                var content = ed.getContent();
                if (content.indexOf(call_block) > 0) {
                    ed.windowManager.alert("???? ?????? ???????????????? ??????????????????????");
                } else {
                    ed.focus();
                    ed.selection.setContent(call_block);
                }
            }
        });

   },

});

tinymce.create('tinymce.plugins.YMap', {
    init : function(ed, url) {
        var dialog_url = '<?=$ymapDialog; ?>';
        ed.addCommand('mceYMap', function() {
            ed.windowManager.open({
            	title: "???????????????? ????????????.?????????? ???? ????????",
                file : dialog_url,
                width : 700,
                height : 500,
                inline : 1,
                buttons:[{
                    text:"Insert", 
                    onclick:function(){

                        var g2block = "{ymap}";
                        var content = ed.getContent();
                        if (content.indexOf(g2block) > 0) {
                            //ed.windowManager.alert("???? ?????? ???????????????? ???????? ?? ????????????.????????????");
                            parent.tinyMCE.activeEditor.windowManager.close(window);
                        } else {
                            ed.focus();
                            ed.selection.setContent(g2block);
                            parent.tinyMCE.activeEditor.windowManager.close(window);
                        }
                    }},{
                        text:"Close",onclick:"close"}]}, 
                    {
            });
        });
        ed.addButton('ymap', {
            image: '<?=$assets?>/images/ymaps.png',
            title : '????????????.??????????',
            cmd : 'mceYMap'
        });
    }
});
tinymce.PluginManager.add('ymap', tinymce.plugins.YMap);
