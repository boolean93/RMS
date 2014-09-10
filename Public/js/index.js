/**
 * Created by Rujia Song on 2014/8/30.
 */
$("#accordion li.sub_button").click(function(){
    var bg_2 = "url(img/bg_2.png)";
    if(false == $(this).next().is(':visible')) {
        $('#accordion ul.dropdown').slideUp(300);
        $(this).css("background",bg_2);
    }else{
        $(this).css("background","inherit");
    }
    $(this).next().slideToggle(300);
});

$('#accordion ul').eq(0).show();

function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    } else {
        window.onload = function() {
            oldonload();
            func();
        }
    }
}
function addClass(element,value) {
    if (!element.className) {
        element.className = value;
    } else {
        newClassName = element.className;
        newClassName+= " ";
        newClassName+= value;
        element.className = newClassName;
    }
}
function stripeTables_T() {
    if (!document.getElementsByTagName) return false;
    var topic_table = document.getElementById("topic");
        var rows = topic_table.getElementsByTagName("tr");
            var th = rows[0].getElementsByTagName("th");
            addClass(th[0],"topic_time");
            addClass(th[1],"topic_head");
            addClass(th[2],"topic_content");
            addClass(th[3],"topic_write");
            addClass(th[4],"topic_delete");
        for (var j=1; j<rows.length; j++) {
            var td = rows[j].getElementsByTagName("td");
            addClass(td[0],"topic_time");
            addClass(td[1],"topic_head");
            addClass(td[2],"topic_content");
            addClass(td[3],"topic_write");
            addClass(td[4],"topic_delete");
        }
}

function stripeTables_M() {
    if (!document.getElementsByTagName) return false;
    var tables = document.getElementsByTagName("table");
    for (var i=0; i<tables.length; i++) {
        var odd = false;
        var rows = tables[i].getElementsByTagName("tr");
        for (var j=0; j<rows.length; j++) {
            var th = rows[j].getElementsByTagName("th");
            for(var k = 0; k<th.length;k++){
                if (odd == true) {
                    addClass(th[k],"even");
                    odd = false;
                } else {
                    addClass(th[k],"odd");
                    odd = true;
                }
            }
        }
        for(var x = 1; x<rows.length;x++){
            var td = rows[x].getElementsByTagName("td");
            for(var n = 0; n<th.length;n++){
                if (odd == true) {
                    addClass(td[k],"even");
                    odd = false;
                } else {
                    addClass(td[k],"odd");
                    odd = true;
                }
            }
        }
    }
}
addLoadEvent(stripeTables_T);
addLoadEvent(stripeTables_M);