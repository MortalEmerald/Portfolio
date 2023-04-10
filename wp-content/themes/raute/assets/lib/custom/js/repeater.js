jQuery(document).ready(function($) {

    const cats = [];
    var ccat;
    var ccat1;
    var scat;


    function Raute_CheckValue(value,arr){
      var status = 'hasnot';
     
      for(var i=0; i<arr.length; i++){
        var name = arr[i];
        if(name == value){
          status = 'has';
          break;
        }
      }

      return status;
    }

    function Raute_Current_select(cval){

        cats1 = [];
        $('.raute-custom-cat-color').each(function(){

            ccat1 = $(this).find('select option:selected').val();
            if( ccat1 ){

                cats1.push(ccat1);

            }

        });

        $('.raute-custom-cat-color').each(function(){

            cscat = $(this).find('select option:selected').val();

            $(this).find('select').empty().append( raute_repeater.categories);

            $(this).find('select option').each( function(){
                
                if(   $(this).val() != cscat ){
                    
                    if ( $(this).val() == cval || ( Raute_CheckValue($(this).val(),cats1) == 'has' && $(this).val() != cscat ) ) {
                        
                        $(this).remove();
                    }
                    
                }

                if(  $(this).val() == cscat ){
                    $(this).attr("selected","selected");
                }

            });

        });

    }

    
    // Show Title Sections While Loadiong.
    $('.raute-repeater-field-control').each(function(){

        ccat = $(this).find('.raute-custom-cat-color select option:selected').val();
        if( ccat ){

            cats.push(ccat);

        }
        
    });

    $('.raute-custom-cat-color select').change(function(){

        optionSelected = $("option:selected", this);
        var ckey = optionSelected.val();
        $("option", this).removeAttr("selected");
        $(this).val(ckey).find("option[value=" + ckey +"]").attr('selected', true);
        
        Raute_Current_select(ckey);
    });

    $('.raute-custom-cat-color').each(function(){

        var catTitle = $(this).closest('.raute-repeater-field-control').find('.raute-custom-cat-color option:selected').text();
        $(this).closest('.raute-repeater-field-control').find('.raute-repeater-field-title').text( catTitle );

    });

    $('.raute-custom-cat-color select').change(function(){

        var optionSelected = $("option:selected", this);
        var textSelected   = optionSelected.text();
        var title_key = optionSelected.val();

        $(this).closest('.raute-repeater-field-control').find('.raute-repeater-field-title').text( textSelected );

    });




    // Save Value.
    function raute_refresh_repeater_values(){

        $(".raute-repeater-field-control-wrap").each(function(){
            
            var values = []; 
            var $this = $(this);
            
            $this.find(".raute-repeater-field-control").each(function(){
            var valueToPush = {};   

            $(this).find('[data-name]').each(function(){
                var dataName = $(this).attr('data-name');
                var dataValue = $(this).val();
                valueToPush[dataName] = dataValue;
            });

            values.push(valueToPush);
            });

            $this.next('.raute-repeater-collector').val( JSON.stringify( values ) ).trigger('change');
        });

    }

    $("body").on("click",'.raute-add-control-field', function(){

        var $this = $(this).parent();
        if(typeof $this != 'undefined') {

            var field = $this.find(".raute-repeater-field-control:first").clone();


            if(typeof field != 'undefined'){
                
                field.find("input[type='text'][data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });

                field.find("textarea[data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });

                field.find("select[data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });


                field.find(".selector-labels label").each(function(){
                    var defaultValue = $(this).closest('.selector-labels').next('input[data-name]').attr('data-default');
                    var dataVal = $(this).attr('data-val');
                    $(this).closest('.selector-labels').next('input[data-name]').val(defaultValue);

                    if(defaultValue == dataVal){
                        $(this).addClass('selector-selected');
                    }else{
                        $(this).removeClass('selector-selected');
                    }
                });
                
                field.find('.raute-fields').show();

                $this.find('.raute-repeater-field-control-wrap').append(field);
                $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
                raute_refresh_repeater_values();
            }

            $('.raute-custom-cat-color select').change(function(){
                var optionSelected = $("option:selected", this);
                var textSelected   = optionSelected.text();
                var title_key = optionSelected.val();

                $(this).closest('.raute-repeater-field-control').find('.raute-repeater-field-title').text(textSelected);

            });


            
            $('.raute-repeater-field-control-wrap li:last-child').find('.home-repeater-fields-hs').hide();
            $('.raute-repeater-field-control-wrap li:last-child').find('.grid-posts-fields').show();

            $('.raute-repeater-field-control-wrap li').removeClass('twp-sortable-active');
            $('.raute-repeater-field-control-wrap li:last-child').addClass('twp-sortable-active');
            $('.raute-repeater-field-control-wrap li:last-child .raute-repeater-fields').addClass('twp-sortable-active extended');
            $('.raute-repeater-field-control-wrap li:last-child .raute-repeater-fields').show();

            $('.raute-repeater-field-control.twp-sortable-active .title-rep-wrap').click(function(){
                $(this).next('.raute-repeater-fields').slideToggle();
            });

            field.find('.customizer-color-picker').each(function(){

                if( $(this).closest('.raute-repeater-field-control').hasClass('twp-sortable-active') ){
                    
                    $(this).closest('.raute-repeater-field-control').find('.wp-picker-container').addClass('old-one');
                    $(this).closest('.raute-repeater-field-control').find('.raute-type-colorpicker .description.customize-control-description').after('<input data-default="" class="customizer-color-picker" data-alpha="true" data-name="category_color" type="text" value="#d0021b">');
                    
                    $(this).closest('.raute-repeater-field-control').find('.customizer-color-picker').wpColorPicker({
                        defaultColor: '#d0021b',
                        change: function(event, ui){
                            setTimeout(function(){
                            raute_refresh_repeater_values();
                            }, 100);
                        }
                    }).parents('.customizer-type-colorpicker').find('.wp-color-result').first().remove();

                    $(this).closest('.raute-repeater-field-control').find('.old-one').remove();

                }
            });
            

            var cats2 = '';
            $('.raute-custom-cat-color').each(function(){

                cats2 = $(this).find('select option:selected').val();
                if(cats2) {
                    return false; // breaks
                }

            });

            if( cats2 ){
                // Category Color Code Start
                field.val(cats2).find("select option[value=" + cats2 +"]").remove();

            }

            field.find('.raute-custom-cat-color select').change(function(){

                optionSelected1 = $("option:selected", this);
                var ckey1 = optionSelected1.val();
                $(this).val(ckey1).find("option[value=" + ckey1 +"]").attr('selected', true);
                
                Raute_Current_select(ckey1);
            });

            // Category Color Code end
            
        }
        return false;
    });
    
    $('.raute-repeater-field-control .title-rep-wrap').click(function(){
        $(this).next('.raute-repeater-fields').slideToggle().toggleClass('extended');
    });

    //MultiCheck box Control JS
    $( 'body' ).on( 'change', '.raute-type-multicategory input[type="checkbox"]' , function() {
        var checkbox_values = $( this ).parents( '.raute-type-multicategory' ).find( 'input[type="checkbox"]:checked' ).map(function(){
            return $( this ).val();
        }).get().join( ',' );
        $( this ).parents( '.raute-type-multicategory' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
        raute_refresh_repeater_values();
    });

    $('body').on('change','.raute-type-radio input[type="radio"]', function(){
        var $this = $(this);
        $this.parent('label').siblings('label').find('input[type="radio"]').prop('checked',false);
        var value = $this.closest('.radio-labels').find('input[type="radio"]:checked').val();
        $this.closest('.radio-labels').next('input').val(value).trigger('change');
    });

    //Checkbox Multiple Control
    $( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on( 'change', function() {
        checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
            function() {
                return this.value;
            }
        ).get().join( ',' );

        $( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
    });

    $('.customizer-color-picker').each(function(){
        $(this).wpColorPicker({
            defaultColor: '#d0021b',
            change: function(event, ui){
                setTimeout(function(){
                raute_refresh_repeater_values();
                }, 100);
            }
        }).parents('.customizer-type-colorpicker').find('.wp-color-result').first().remove();
    });

    // ADD IMAGE LINK
    $('.customize-control-repeater').on( 'click', '.theme-custom-upload-button', function( event ){
        event.preventDefault();

        var imgContainer = $(this).closest('.theme-attachment-panel').find( '.thumbnail-image'),
        placeholder = $(this).closest('.theme-attachment-panel').find( '.placeholder'),
        imgIdInput = $(this).siblings('.upload-id');

        // Create a new media frame
        frame = wp.media({
            title: raute_repeater.upload_image,
            button: {
            text: raute_repeater.use_image
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on( 'select', function() {

        // Get media attachment details from the frame state
        var attachment = frame.state().get('selection').first().toJSON();

        // Send the attachment URL to our custom image input field.
        imgContainer.html( '<img src="'+attachment.url+'" style="max-width:100%;"/>' );
        placeholder.addClass('hidden');

        // Send the attachment id to our hidden input
        imgIdInput.val( attachment.url ).trigger('change');

        });

        // Finally, open the modal on click
        frame.open();
    });
    // DELETE IMAGE LINK
    $('.customize-control-repeater').on( 'click', '.theme-image-delete', function( event ){

        event.preventDefault();
        var imgContainer = $(this).closest('.theme-attachment-panel').find( '.thumbnail-image'),
        placeholder = $(this).closest('.theme-attachment-panel').find( '.placeholder'),
        imgIdInput = $(this).siblings('.upload-id');

        // Clear out the preview image
        imgContainer.find('img').remove();
        placeholder.removeClass('hidden');

        // Delete the image id from the hidden input
        imgIdInput.val( '' ).trigger('change');

    });

    $("#customize-theme-controls").on("click", ".raute-repeater-field-remove",function(){
        if( typeof  $(this).parent() != 'undefined'){
            $(this).closest('.raute-repeater-field-control').slideUp('normal', function(){
                $(this).remove();
                raute_refresh_repeater_values();
            });
            
        }
        return false;
    });

    $('.wp-picker-clear').click(function(){
         raute_refresh_repeater_values();
    });

    $('#customize-theme-controls').on('click', '.raute-repeater-field-close', function(){
        $(this).closest('.raute-repeater-fields').slideUp();
        $(this).closest('.raute-repeater-field-control').toggleClass('expanded');
    });

    /*Drag and drop to change order*/
    $(".raute-repeater-field-control-wrap").sortable({
        axis: 'y',
        orientation: "vertical",
        update: function( event, ui ) {
            raute_refresh_repeater_values();
        }
    });

    $("#customize-theme-controls").on('keyup change', '[data-name]',function(){
         raute_refresh_repeater_values();
         return false;
    });

    $("#customize-theme-controls").on('change', 'input[type="checkbox"][data-name]',function(){
        if($(this).is(":checked")){
            $(this).val('yes');
        }else{
            $(this).val('no');
        }
        raute_refresh_repeater_values();
        return false;
    });

});