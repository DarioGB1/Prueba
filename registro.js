const url = 'api_registro.php';
var data = [];

function readAllQuejas(){
    axios({
        method:'GET',
        url:url,
        responseType:'json'
        }).then(res =>{
            console.log(res.data);
            this.data = res.data.data;
            console.log(res.data.status);
            if(res.data.status === "error")
                window.location.href = "401.html";
            else
                llenarTabla(data);            
        }).catch(error=>{
                console.error(error);
        });
}

function llenarTabla(data)
{
    document.querySelector('#table-quejas tbody').innerHTML = '';
    for(let i=0;i<data.length;i++){
        document.querySelector('#table-quejas tbody').innerHTML += 
        `<tr>
            <td>${data[i].queja_id}</td>
            <td>${data[i].queja_nombre}</td>
            <td>${data[i].queja_descripcion}</td>
            <td>${data[i].queja_fecha}</td>
            <td>${data[i].queja_materia}</td>
            <td>${data[i].queja_carrera}</td>
            <td>
                <button type="button" onclick="deleteQueja(${data[i].queja_id})">Delete</button>
                <button type="button" onclick="updateQueja(${data[i].queja_id})">Update</button> 
                <button type="button" onclick="readQuejaById(${data[i].queja_id})">Read</button>
            </td>
        </tr>`;
    }
}

function deleteQueja(id_del){
    let queja = { 
        id: id_del 
    };

    axios({
        method:'DELETE',
        url:url,
        responseType:'json',
        data: queja
    }).then(res =>{
        console.log(res.data);
        readAllQuejas();        
    }).catch(error=>{
        console.error(error);
    });        
}

function createQueja(){
    let queja = { 
        nombre: document.getElementById('nombre').value,
        descripcion: document.getElementById('descripcion').value,
        fecha: document.getElementById('fecha').value,
        materia: document.getElementById('materia').value,
        carrera: document.getElementById('carrera').value
    };

    axios({
        method:'POST',
        url:url,
        responseType:'json',
        data: queja
    }).then(res =>{
        console.log(res.data);
        if(res.data.message === 'Duplicate data')
            alert('Dato duplicado.');
        else
            readAllQuejas();        
    }).catch(error=>{
        console.error(error);
    });
}

function updateQueja(id_update){
    let nombre_update = document.getElementById('nombre').value;

    if (nombre_update !== "") {
        let queja = { 
            id: id_update,
            nombre: nombre_update,
            descripcion: document.getElementById('descripcion').value,
            fecha: document.getElementById('fecha').value,
            materia: document.getElementById('materia').value,
            carrera: document.getElementById('carrera').value
        };

        axios({
            method:'PUT',
            url:url,
            responseType:'json',
            data: queja
        }).then(res =>{
            console.log(res.data);
            if(res.data.status === 'error')
                alert('Dato duplicado.');
            else
                readAllQuejas();         
        }).catch(error=>{
            console.error(error);
        });
    } else {
        alert("Debe colocar un nombre");
    }
}

function readQuejaById(id){
    axios({
        method:'GET',
        url:url + '?id=' + id,
        responseType:'json'
    }).then(res =>{
        console.log(res.data);
        document.getElementById('nombre').value = res.data.data[0].queja_nombre;
        document.getElementById('descripcion').value = res.data.data[0].queja_descripcion;
        document.getElementById('fecha').value = res.data.data[0].queja_fecha;
        document.getElementById('materia').value = res.data.data[0].queja_materia;
        document.getElementById('carrera').value = res.data.data[0].queja_carrera;
    }).catch(error=>{
        console.error(error);
    });
}
