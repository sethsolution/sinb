/**
 *  FUNCION PARA REGISTRAR LOS LOGS DE LOS SISTEMAS
 */
 var Logs = {
    create : async function( datos ) {
        data = {
            'sistema_id': datos.sistema_id ? datos.sistema_id : null,
            'recurso_id': datos.recurso_id ? datos.recurso_id : null,
            'nombre': datos.nombre ? datos.nombre : "Sin definir",
            'descripcion': datos.descripcion ? datos.descripcion : '',
            'path': datos.path ? datos.path : window.location.href,
            'base_datos': datos.base_datos ? datos.base_datos : 'Sin definir',
            'userCreate': datos.userCreate ? datos.userCreate : null
        };
        let status = 200
        let msg = ''

        await $.ajax({
            url: "https://konga.mmaya.gob.bo:8443/api/reportes/datos",
            type: 'post',
            data: data,
            headers: {
                Accept: "application/json",
                Authorization: "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImlzcyI6Iml1ZjlYZURibjloamRWUHlYVmtIQXBhYUJLbGpnSHIwIn0.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.0tP83tai3YKEocYHowjY5tGl_K60waaNt9YAmZNowxI"
            },
            success: function(data) {
                status = 201
                msg = 'Log Registrado'
            },
            error: function(error) {
                status = 500,
                msg = 'Error al registrar el log'
            }
        })

        return {
            status,
            msg
        }
        
    }

    // create : async function( datos ) {
    //     data = {
    //         'sistema_id': datos.sistema_id ? datos.sistema_id : null,
    //         'recurso_id': datos.recurso_id ? datos.recurso_id : null,
    //         'nombre': datos.nombre ? datos.nombre : "Sin definir",
    //         'descripcion': datos.descripcion ? datos.descripcion : '',
    //         'path': datos.path ? datos.path : window.location.href,
    //         'base_datos': datos.base_datos ? datos.base_datos : 'Sin definir',
    //         'userCreate': datos.userCreate ? datos.userCreate : null
    //     };

    //     // var response = await $.post("http://localhost:3000/reportes/datos",data, Logs.getHeader());
    //     var response = await $.post("https://konga.mmaya.gob.bo:8443/api/reportes/datos",data, Logs.getHeader());
    //     console.log(response)
    //     if (response.itemId) {
    //         return {
    //             status: 201
    //         }
    //     }
    //     return {
    //         status: 500
    //     };
    // },
    // getHeader: function() {
    //     return {
    //         headers: {
    //             Accept: "application/json",
    //             //Authorization: 
    //         }
    //     };
    // }
};
