/*------------------------------------------------------
    Author : www.webthemez.com
    License: Commons Attribution 3.0
    http://creativecommons.org/licenses/by/3.0/
---------------------------------------------------------  */

(function ($) {
    "use strict";
    var mainApp = {

        initFunction: function () {
            /*MENU 
            ------------------------------------*/
            $('#main-menu').metisMenu();
			
            $(window).bind("load resize", function () {
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });

            /* MORRIS BAR CHART
			-----------------------------------------*/
            // Morris.Bar({
            //     element: 'morris-bar-chart',
            //     data: [{
            //         y: '2006',
            //         a: 100,
            //         b: 90
            //     }, {
            //         y: '2007',
            //         a: 75,
            //         b: 65
            //     }, {
            //         y: '2008',
            //         a: 50,
            //         b: 40
            //     }, {
            //         y: '2009',
            //         a: 75,
            //         b: 65
            //     }, {
            //         y: '2010',
            //         a: 50,
            //         b: 40
            //     }, {
            //         y: '2011',
            //         a: 75,
            //         b: 65
            //     }, {
            //         y: '2012',
            //         a: 100,
            //         b: 90
            //     }],
            //     xkey: 'y',
            //     ykeys: ['a', 'b'],
            //     labels: ['Series A', 'Series B'],
            //     hideHover: 'auto',
            //     resize: true
            // });

            /* MORRIS DONUT CHART
			----------------------------------------*/
            // Morris.Donut({
            //     element: 'morris-donut-chart',
            //     data: [{
            //         label: "Download Sales",
            //         value: 12
            //     }, {
            //         label: "In-Store Sales",
            //         value: 30
            //     }, {
            //         label: "Mail-Order Sales",
            //         value: 20
            //     }],
            //     resize: true
            // });

            /* MORRIS AREA CHART
			----------------------------------------*/

            // Morris.Area({
            //     element: 'morris-area-chart',
            //     data: [{
            //         period: '2010 Q1',
            //         iphone: 2666,
            //         ipad: null,
            //         itouch: 2647
            //     }, {
            //         period: '2010 Q2',
            //         iphone: 2778,
            //         ipad: 2294,
            //         itouch: 2441
            //     }, {
            //         period: '2010 Q3',
            //         iphone: 4912,
            //         ipad: 1969,
            //         itouch: 2501
            //     }, {
            //         period: '2010 Q4',
            //         iphone: 3767,
            //         ipad: 3597,
            //         itouch: 5689
            //     }, {
            //         period: '2011 Q1',
            //         iphone: 6810,
            //         ipad: 1914,
            //         itouch: 2293
            //     }, {
            //         period: '2011 Q2',
            //         iphone: 5670,
            //         ipad: 4293,
            //         itouch: 1881
            //     }, {
            //         period: '2011 Q3',
            //         iphone: 4820,
            //         ipad: 3795,
            //         itouch: 1588
            //     }, {
            //         period: '2011 Q4',
            //         iphone: 15073,
            //         ipad: 5967,
            //         itouch: 5175
            //     }, {
            //         period: '2012 Q1',
            //         iphone: 10687,
            //         ipad: 4460,
            //         itouch: 2028
            //     }, {
            //         period: '2012 Q2',
            //         iphone: 8432,
            //         ipad: 5713,
            //         itouch: 1791
            //     }],
            //     xkey: 'period',
            //     ykeys: ['iphone', 'ipad', 'itouch'],
            //     labels: ['iPhone', 'iPad', 'iPod Touch'],
            //     pointSize: 2,
            //     hideHover: 'auto',
            //     resize: true
            // });

            /* MORRIS LINE CHART
			----------------------------------------*/
            // Morris.Line({
            //     element: 'morris-line-chart',
            //     data: [{
            //         y: '2006',
            //         a: 100,
            //         b: 90
            //     }, {
            //         y: '2007',
            //         a: 75,
            //         b: 65
            //     }, {
            //         y: '2008',
            //         a: 50,
            //         b: 40
            //     }, {
            //         y: '2009',
            //         a: 75,
            //         b: 65
            //     }, {
            //         y: '2010',
            //         a: 50,
            //         b: 40
            //     }, {
            //         y: '2011',
            //         a: 75,
            //         b: 65
            //     }, {
            //         y: '2012',
            //         a: 100,
            //         b: 90
            //     }],
            //     xkey: 'y',
            //     ykeys: ['a', 'b'],
            //     labels: ['Series A', 'Series B'],
            //     hideHover: 'auto',
            //     resize: true
            // });
           
     
        },

        initialization: function () {
            mainApp.initFunction();

        }

    }
    // Initializing ///

    $(document).ready(function () {
        $('[data-rel="tooltip"]').tooltip(); 
        mainApp.initFunction();
    });

}(jQuery));



function loadpag(data,id,codsup){
    // $( "#menuu" ).load('component/menu2.php', function() {
        localStorage.setItem('pagina',data);
        localStorage.setItem('idpagina',id);
        localStorage.setItem('codsuppag',codsup);

        
        $("#contenido").load(data);
        reloadmenu();
    // });
}

function reloadmenu(){
    $( "#menuu" ).load('component/Menu', function() {
        // $('#li').has('ul').children('ul').removeClass('in');
        $('#main-menu').metisMenu();
        $("#main-menu li a").removeClass("active-menu");
        $("#m"+localStorage.idpagina).addClass("active-menu");
        $('#li_'+localStorage.codsuppag).has('ul').children('ul').addClass('collapse in');
        $('#main-menu li').not('.active').has('ul').children('ul').addClass('collapse');
    });
}

/*//////////////////////////////////////////////////////////////////////////////*/
function combobox(id,url,inival,params){
 var localurl=url;
  $.ajax({
        url:localurl,
        type:"POST",
        data:{params:params},
        jsonpCallback:id,
        dataType:"JSON",
        success:function (json){
           var option="<option value=''>"+inival+"</option>";
           $.each(json,function(k,v){
            option+="<option value='"+v.cod+"'>"+v.nombre+"</option>";
           });
            // console.log(option);
           $("#"+id).html(option);
           
        }
  });
}

/*//////////////////////////////////////////////////////////////////////////////*/
 function doSearch(val,table) {
    /*var tableReg = document.getElementById('table');*/
    var tableReg=document.getElementById(""+table);
    var searchText =$("#"+val).val().toLowerCase();
    /*var searchText = document.getElementById('buscar').value.toLowerCase();*/
    for (var i = 1; i < tableReg.rows.length; i++) {
        var cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        var found = false;
        for (var j = 0; j < cellsOfRow.length && !found; j++) {
            var compareWith = cellsOfRow[j].innerHTML.toLowerCase();
            if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                found = true;
            }
        }
        if (found) {
            tableReg.rows[i].style.display = '';
        } else {
            tableReg.rows[i].style.display = 'none';
        }
    }
}
