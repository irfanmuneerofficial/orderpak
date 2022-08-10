window.setTimeout(function() {
    jQuery(".alert").fadeTo(1000, 0).slideUp(500, function(){
        jQuery(this).remove();
    });
}, 2000);