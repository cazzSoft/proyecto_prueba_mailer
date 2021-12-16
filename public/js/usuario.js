//metodo para buscar pais 
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
 $(function() {
        $.ajax({
            url: 'https://www.universal-tutorial.com/api/getaccesstoken',
            method: 'GET',
            headers: {
                "Accept": "application/json",
                "api-token": "uq6yOng6ty8sH3d0vlE3s2-iTnQFJFI80paqa84GYSFm06iMqsI1mY4SkFhTzFUsWps",
                "user-email": "cazzdj17@hotmail.com"
            },
            success: function (data) {
                
                if(data.auth_token){
                    var auth_token = data.auth_token;
                    $.ajax({
                        url: 'https://www.universal-tutorial.com/api/countries',
                        method: 'GET',
                        headers: {
                            "Authorization": "Bearer " + auth_token,
                            "Accept": "application/json"
                        },
                        success: function (data) {
                            const pais=[];
                            let item={};
                             var countries = data;
                            countries.forEach(element => {
                                item={id:element['country_name'],text:element['country_name']};
                                 pais.push(item);
                                // comboCountries += '<option value="' + element['country_name'] + '">' + element['country_name']+'</option>';
                            });
                            $("#pais").select2({
                              data: pais
                            }); 
                            // State list
                            $("#pais").on("change", function(){
                                var country =$('#pais').val();
                                
                                $.ajax({
                                    url: 'https://www.universal-tutorial.com/api/states/' + country,
                                    method: 'GET',
                                    headers: {
                                        "Authorization": "Bearer " + auth_token,
                                        "Accept": "application/json"
                                    },
                                    success: function (data1) {
                                        const estados=[];
                                        let item_s={};
                                        var states_1 = data1;
                                       
                                        states_1.forEach(element => {
                                            item_s={id:element['state_name'],text:element['state_name']};
                                            estados.push(item_s);
                                        });
                                        $("#estados").select2({
                                          data: estados
                                        }); 
                                        // City list
                                        $("#estados").on("change", function () {
                                           
                                            var state =$('#estados').val();

                                            $.ajax({
                                                url: 'https://www.universal-tutorial.com/api/cities/' + state,
                                                method: 'GET',
                                                headers: {
                                                    "Authorization": "Bearer " + auth_token,
                                                    "Accept": "application/json"
                                                },
                                                success: function (data) {
                                                    var cities = data;
                                                    const ciudad=[];
                                                    let item_c={};
                                                    cities.forEach(element => {
                                                        item_c={id:element['city_name'],text:element['city_name']};
                                                        ciudad.push(item_c);
                                                     });
                                                    $("#ciudad").select2({
                                                        data: ciudad
                                                    });
                                                    
                                                },
                                                error: function (e) {
                                                    console.log("Error al obtener countries: " + e);
                                                }
                                            });
                                        });
                                      
                                    },
                                    error: function (e) {
                                        console.log("Error al obtener countries: " + e);
                                    }
                                });
                            });
                          
                        },
                        error: function (e) {
                            console.log("Error al obtener countries: " + e);
                        }
                    });
                }
            },
            error: function (e) {
                console.log("Error al obtener countries: " + e);
            }
        });            

 });

//obtener informacion para editar  
 function btn_eliminar_user(btn){
    //ejecucion de mensaje de advertencia
      Swal.fire({
        title: '¿Quiere eliminar el registro?',
        text: "¡Recuerda que no podrás revertir los cambios!",
        icon: 'question', //question ,info, warning, success, error
        showCancelButton: true,
        confirmButtonColor: '#007bff',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Canelar'
      }).then((result) => {
        if (result.isConfirmed) {
            $(btn).parents('.frm_eliminar').submit();
        }
      })
  }

//  METODOS PARA LA GESTIÓN DEL USUARIO
  function editar_user(id){
      $.get("/gestion/usuario/"+id+"/edit", function (resultado) {
         
            $('#name').val(resultado.request.name);
            $('#email').val(resultado.request.email);
            if(resultado.request.ciudad!=null){
               
                var  ciudad=[{id:resultado.request.ciudad.descripcion,text:resultado.request.ciudad.descripcion}];
                $("#ciudad").select2({
                    data: ciudad
                });
                 $("#ciudad").val(resultado.request.ciudad.descripcion).trigger("change");
                console.log(ciudad);
            }
          $('#num_celular').val(resultado.request.num_celular);
          $('#fecha_na').val(resultado.request.fecha_na);
          $('#dni').val(resultado.request.dni);
          $('#codigo_ci').val(resultado.request.codigo_ci);

      }).fail(function(data){
        var data=data.responseJSON;
        mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)
      });

      $('#method_u').val('PUT'); // decimo que sea un metodo put Actualizar
      $('#frm_user').attr('action','/gestion/usuario/'+id);
      $('#btn_u').html(`<i class="fa fa-save"></i> Actualizar`); // cambiamos nombre del boton

        document.getElementById('email').disabled=true; 
        document.getElementById('dni').disabled=true; 



  }

    //evento del btn cancelar del form catalogo

    $('#btn_can').click(function(){
        $('#num_celular').val("");
        $('#fecha_na').val(" ");
        $('#dni').val(" ");
        $('#codigo_ci').val(" ");
        $('#name').val('');
        $('#ciudad').val(" ");
        $('#email').val('');
         $('#method_u').val('POST'); // decimo que sea un metodo put Actualizar
        $('#frm_user').attr('action','/gestion/usuario'); // agregamos la ruta post (ruta por defecto)
        $('#btn_u').html(`<i class="fa fa-save"></i> Guardar`);
    });

// ============================ /METODOS PARA LA GESTIÓN DEL USUARIO ==================================
