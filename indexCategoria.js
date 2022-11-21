const boton = document.querySelector("#submit");
const tbody = document.querySelector("#tbody");

boton.addEventListener("click",consultarAPI);

async function consultarAPI(e){
    const buscador = document.querySelector("#buscador").value;
    const filtro_categoria = document.querySelector("#filtro").value;
    const orden = document.querySelector("#orden").value;

    e.preventDefault();

    let datos = new FormData();

    datos.append("buscador",buscador);
    datos.append("filtro_categoria",filtro_categoria);
    datos.append("orden",orden);

    let data = await fetch("./api-categorias.php",{
        method:"POST",
        body:datos
    });

    let json = await data.json();

    mostrarDatosTabla(json);
}

function mostrarDatosTabla(json){

    while(tbody.firstChild){
        tbody.removeChild(tbody.firstChild);
    }

    json.forEach((obj)=>{
        const {idCategoria,nombre,descripcion} = obj;

        const tr = document.createElement("tr");

        const tdId = document.createElement("td");
        const tdNombre = document.createElement("td");
        const tdDescripcion = document.createElement("td");
        const tdActualizarCategoria = document.createElement("td");
        const tdEliminarCategoria = document.createElement("td");

        const enlaceActualizarCategoria = document.createElement("a");
        const enlaceEliminarCategoria = document.createElement("a");

        tdId.textContent = idCategoria;
        tdNombre.textContent = nombre;
        tdDescripcion.textContent = descripcion;

        enlaceActualizarCategoria.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#0000FF" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
        <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
        </svg>`;
        enlaceEliminarCategoria.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <line x1="4" y1="7" x2="20" y2="7" />
        <line x1="10" y1="11" x2="10" y2="17" />
        <line x1="14" y1="11" x2="14" y2="17" />
        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
        </svg>`;

        enlaceActualizarCategoria.href = `./actualizarcategorias.php?id=${idCategoria}`;
        enlaceEliminarCategoria.href = `./eliminarcategorias.php?id=${idCategoria}`;

        console.log(enlaceActualizarCategoria);

        tr.appendChild(tdId);
        tr.appendChild(tdNombre);
        tr.appendChild(tdDescripcion);
        tdActualizarCategoria.appendChild(enlaceActualizarCategoria);
        tdEliminarCategoria.appendChild(enlaceEliminarCategoria);
        tr.appendChild(tdActualizarCategoria);
        tr.appendChild(tdEliminarCategoria);

        tbody.appendChild(tr);

    });

}