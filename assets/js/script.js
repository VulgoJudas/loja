$(function(){

    $("#slader-range").slider({
        range:true,
        min:0,
        max:MAXSLIDE,
        values:[0,MAXSLIDE],
        slide:function(event,ui){
            $("#amount").val("R$"+ui.values[0]+" -R$"+ui.values[1])
        }

    });
    $("#amount").val("R$"+$("#slader-range").slider("values", 0)+" -R$"+$("#slader-range").slider("values",1));
});