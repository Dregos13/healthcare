function cargaMunicipios(){
    $.ajax({
        type: "POST",
        url: 'cargaMunicipios.php',
        data: { 'provincia': $("#provincia").val() },
        dataType:'json',
        beforeSend: function () {
            $("#resultado").html("Procesando, espere por favor...");
        },
        success: function(data) {
            $("#resultado").html("Listo!!");

            var select = $("#municipio"), options = '';
            select.empty();

            for(var i=0;i<data.length; i++)
            {
                options += "<option value='"+data[i].id+"'>"+ data[i].nombre +"</option>";
            }

            select.append(options);
        }
    });
}


function cargaProvincia(){
    $.ajax({
        type: "POST",
        url: 'cargaProvincia.php',
        data: { 'pais': $("#pais").val() },
        dataType:'json',
        beforeSend: function () {
            $("#resultado").html("Procesando, espere por favor...");
        },
        success: function(data) {
            $("#resultado").html("Listo!!");

            var select = $("#provincia"), options = '';
            select.empty();
            var select2 = $("#municipio"), options = '';
            select2.empty();

            options += "<option value='' hidden>Elija provincia...</option>";

            for(var i=0;i<data.length; i++)
            {
                options += "<option value='"+data[i].id+"'>"+ data[i].nombre +"</option>";
            }




            select.append(options);

        }
    });
}

function myconfirm(texto,url){
    if(confirm(texto)){
        console.log(url);
        window.location=url;
    }

}