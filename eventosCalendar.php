<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Include the Dark theme -->
    <link rel="stylesheet" href="node_modules/@sweetalert2/theme-dark/dark.css">



</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div id="calendar">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir evento</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
                </div>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    // Cambiar que el dia comience por lunes 
    firstDay:1,

        // Creamos un boton para añadir eventos
        customButtons: {
        botonCustom: {
        text: 'Añadir evento',
        click: function() {
          window.location.href = "eventoAdd.php";
        }
      }
    },

    initialView: 'dayGridMonth',
    // Botones de semana o mes
    headerToolbar: { left: 'dayGridMonth,timeGridWeek,botonCustom', center:'title'},
    locale:'es',
    buttonText:{
        today:'Hoy',
        week:'Semana',
        month:'Mes',
    },


    // Por medio de una funcion insertamos los datos de nuestra base de datos en el calendario
    // Estos datos estan en datos.php en la que hemos realizado una consulta a la BD

    events:function(info,successCallback,failureCallback){

        fetch('datos.php')
        .then(api=>api.json())
        .then((datoEvento)=>{
            var events = [];
            datoEvento.forEach((dato)=>{
                console.log(dato)
                events.push({
                    id:dato.idEvento,
                    title:dato.Titulo_Evento,
                    start:dato.Inicio_Evento,
                    end:dato.Fin_Evento,
                    color:dato.Color_Evento,
                    description:dato.Descripcion_Evento,
                    })
                
            })
            successCallback(events);
            console.log(events);
        })
        .catch((error)=>{
            failureCallback(error)
        })
        
    },
    // Creamos otra funcion con la accion de eventClik, al hacer click en el evento nos devolvera una pestaña con los detalles
    eventClick:function(info){

                Swal.fire({
          title: info.event.title,
          id:info.event.id,
          showDenyButton: true,
          showCancelButton: true,
          showCancelButtonText: 'Cancelar',
          confirmButtonText: 'Ok',
          denyButtonText: `Editar`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {


          } else if (result.isDenied) {          
            window.location.href = "eventoUpdate.php?id="+info.event.id;
          }
})

    },

  });
  calendar.render();
});

</script>
</body>
</html>