/*---------------------------------------------
 * jQuery Fix Height Simple 1.3 - 2015-05-22
---------------------------------------------*/

jQuery.fn.fixHeightSimple = function(options){

    //繧ｪ繝励す繝ｧ繝ｳ
    options = jQuery.extend({
        column : 0,
        responsive : false,
        responsiveWidth : 960,
        boxSizingBorderBox : false
    }, options);

    var elm = this;

    if(jQuery(elm).size() > 0){
        jQuery(window).on("load resize", function(){
            if(!(options.responsive) || (options.responsive && options.responsiveWidth <= jQuery(window).width())){
                var tgHeight = new Array(120); //Array([繧｢繝ｼ繧ｫ繧､繝悶�譛螟ｧ陦ｨ遉ｺ莉ｶ謨ｰ])
                var cnt = 0;
                var maxHeight = 0;
                elm.css("height","auto");
                elm.each(function(){
                    if(options.boxSizingBorderBox){
                        tgHeight[cnt] = jQuery(this).outerHeight();
                    }else{
                        tgHeight[cnt] = jQuery(this).height();
                    }
                    if(tgHeight[cnt] > maxHeight){
                        maxHeight = tgHeight[cnt];
                    }
                    if(options.column){
                        if(cnt !=0 && ((cnt+1) % options.column) == 0){
                            for(var i = cnt - options.column; i < cnt; i++){
                                elm.eq(i + 1).css("height",maxHeight + "px");
                            }
                            maxHeight = 0;
                        }
                    }
                    cnt++;
                });
                if(!(options.column)) elm.css("height", maxHeight + "px");
            }else{
                elm.css("height","auto");
            }
        });
    }

}