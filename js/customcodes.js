(function() {  
    tinymce.create('tinymce.plugins.person', {  
        init : function(ed, url) {  
            ed.addButton('person', {  
                title : 'Add a person',  
                image : url+'/image.png',  
                onclick : function() {  
                     ed.selection.setContent('[person name=" NAME " role=" ROLE "]' + ed.selection.getContent() + '[/person]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('person', tinymce.plugins.person);  
})();  