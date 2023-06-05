
function eliminar (idCurso,nombreCurso){
    let ok = confirm("¿Estás seguro que quieres eliminar?"+nombreCurso,);
    if (ok){
        window.location = "delete.php?idCurso="+idCurso;
    }
}