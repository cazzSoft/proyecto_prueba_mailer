
//funcion para obtener el mail
function obtenerFirst(idm) {
	$.get("/gestion/mail/" + idm + "/edit", function (data) {
		console.log(data); 
		//limpiamos y asignamos
		$('#txtModal').html(" ");
		$('#txtModal').html(`
				<div class="row">
				  <div class="col-12">
				    <div class="card card-primary " >
				      <div class="card-body ">
				        <h5 class="card-subtitle mb-1 text-muted">El usuario <strong>${data.request.usuario[0].name}</strong> envio un Mail</h5>
				        <h5 class="card-subtitle mt-1 mb-1 text-muted"><strong>Para:</strong> ${data.request.destino} </h5>
				        <h5 class="card-subtitle mt-1 mb-4 text-muted"><strong>Asunto:</strong> ${data.request.asunto} </h5>
				        <p class="card-text text-justify">${data.request.cuerpo}</p>
				      </div>
				    </div>
				  </div>
				</div>
			`);

		//abrir modal
		$('#modalMails').modal('show');
	}).fail(function (data) {
        var data = data.responseJSON;
        mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
    });
	
}

$(document).on('click', '#deshabiltar', function() {
	alert()
        $("#btn_email").attr("disabled", "disabled");
});