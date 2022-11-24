const botonBuscar = document.querySelector("#submit");
const tbody = document.querySelector("#tbody");

botonBuscar.addEventListener("click", filtradoProductos);

async function filtradoProductos(e){
    e.preventDefault();

    const buscar = document.querySelector("#buscador").value;
    const filtro = document.querySelector("#filtro").value;

    const datos = new FormData();

    datos.append("buscar",buscar);
    datos.append("filtro",filtro);

    let data = await fetch("./api-comprar.php",{
        method:"POST",
        body:datos
    });

    let json = await data.json();

    mostrarTBody(json);
}

function mostrarTBody(json){

    while(tbody.firstChild){
        tbody.removeChild(tbody.firstChild);
    }

    json.forEach((obj)=>{
        const {idProducto,nombre,cantidad,precio} = obj;

        const tr = document.createElement("tr");

        const tdId = document.createElement("td");
        const tdNombre = document.createElement("td");
        const tdPrecio = document.createElement("td");
        const tdCantidad = document.createElement("td");
        const tdGuardar = document.createElement("td");
        const tdEliminar = document.createElement("td");

        const tdButtonAgregar = document.createElement("button");
        const tdButtonEliminar = document.createElement("button");

        tdGuardar.appendChild(tdButtonAgregar);
        tdEliminar.appendChild(tdButtonEliminar);
        
        const inputCantidad = document.createElement("input");

        tdId.textContent = idProducto;
        tdNombre.textContent = nombre;
        // tdCantidad.textContent = cantidad;
        // inputCantidad.value = cantidad;
        tdPrecio.textContent = precio;
        tdButtonAgregar.textContent = "Agregar";
        tdButtonEliminar.textContent = "Eliminar";

        tdCantidad.appendChild(inputCantidad);

        tr.appendChild(tdId);
        tr.appendChild(tdNombre);
        tr.appendChild(tdPrecio);
        tr.appendChild(tdCantidad);
        tr.appendChild(tdButtonAgregar);
        tr.appendChild(tdButtonEliminar);

        tbody.appendChild(tr);

    });
}