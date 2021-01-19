
$(document).ready(function() {
        
    //masking for overlays
    $(".trigger").overlay({
        mask: '#000',
        left:"center",
        top:"center"
    });
    
    //search site button
    $("input[name=showsearchform]").click(function(){
        $('.addsearchsiteform').slideToggle('400');
    })
   
    $('.picker').click(function(){
        $(this).siblings().trigger('click');
    })
        
    //hide infobox when 'x' link is clicked
    $('.closeInfobox').click(function(){ 
        $(this).parent().parent().slideUp('400');
    });

   $(".dynamicOverlay > a[rel]").overlay({
        mask: '#000',
        //  left:"center",
        //  top:"center",
      
        onBeforeLoad: function() {
            var wrap = this.getOverlay().find(".contentWrap");
            var requestPage=this.getTrigger().attr('rel').slice(1,this.getTrigger().attr("rel").length);
            wrap.load('/inloggen/'+requestPage+'/'+this.getTrigger().attr("href").slice(1,this.getTrigger().attr("href").length)+'/');
        },
        onClose: function(){
            var link=this.getTrigger().attr("href").slice(1,this.getTrigger().attr("href").length);
            var newName=this.getOverlay().find("#name").val();
            var changed=this.getOverlay().find("input[name=changed]").val();
            var page=this.getOverlay().find("input[name=page]").val();

            if(changed==1){
                if(page=="addlink"){
                    window.location.reload();
                }               
                else if(page=="editlink") {
                    trigger=this.getTrigger().parent().parent().parent().find('.name').text(newName); // edit link page                                                                                          
                    //                        console.log(trigger);
                    $('#'+link).animate({
                        backgroundColor: '#fffaba'
                    },2000,function(){
                        $('#'+link).animate({
                            backgroundColor: '#f9f9f9'
                        },2000);
                    });
                }
            }
            
        }
    }); 
   
});