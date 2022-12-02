
const btn_filtrar = document.querySelector("#filtrar");
const tbody = document.querySelector("#tbody");

btn_filtrar.addEventListener("click",consultarAPI);

async function consultarAPI(e){
    e.preventDefault();

    const buscador = document.querySelector("#buscar_venta").value;
    const filtro_venta = document.querySelector("#select").value;
    const ordenar = document.querySelector("#ordenar").value;
    
    let data = new FormData();

    data.append("buscador",buscador);
    data.append("filtro_venta",filtro_venta);
    data.append("ordenar",ordenar);

    let datos = await fetch("./api-usuarioventa.php",{
        method:"POST",
        body:data
    });

    let json = await datos.json();

    mostrarTBody(json);
}

function mostrarTBody(json){

    while(tbody.firstChild){
        tbody.removeChild(tbody.firstChild);
    }

    json.forEach((obj) => {
        let {idVenta,montototal,fecha} = obj;

        const tr = document.createElement("tr");

        const td1 = document.createElement("td");
        const td2 = document.createElement("td");
        const td3 = document.createElement("td");

        td1.textContent = idVenta;
        td2.textContent = montototal;
        td3.textContent = fecha;

        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);

        tbody.appendChild(tr);
    });

}
