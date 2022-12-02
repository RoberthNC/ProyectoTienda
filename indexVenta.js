const botonBuscar = document.querySelector("#submit");
const tbody = document.querySelector("#tbody");
const tbody_secundario = document.querySelector("#tbody-secundario");
const botonConfirmarVenta = document.querySelector("#confirmarventa");

botonBuscar.addEventListener("click", filtradoProductos);

const productosVenta = [];

function ProductosVenta(id,nombre,precio,cantidad){
    this.id = id; //Necesario
    this.nombre = nombre;
    this.precio = precio; //Necesario
    this.cantidad = cantidad; //Necesario
    let fechita = new Date();
    let fecha = `${fechita.getFullYear()}-${fechita.getMonth()+1}-${fechita.getDate()}`;
    this.fecha = fecha; //Necesario
}

async function filtradoProductos(e){
    e.preventDefault();

    const buscar = document.querySelector("#buscador").value;
    const filtro = document.querySelector("#filtro").value;

    const datos = new FormData();

    datos.append("buscar",buscar);
    datos.append("filtro",filtro);

    let data = await fetch("./api-venta.php",{
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
        const {idProducto,nombre,precio} = obj;

        const tr = document.createElement("tr");

        const tdId = document.createElement("td");
        const tdNombre = document.createElement("td");
        const tdPrecio = document.createElement("td");
        const tdCantidad = document.createElement("td");
        const tdGuardar = document.createElement("td");

        const tdButtonAgregar = document.createElement("button");
        tdButtonAgregar.type = "button";
        
        tdGuardar.appendChild(tdButtonAgregar);
        
        const inputCantidad = document.createElement("input");
        
        tdId.textContent = idProducto;
        tdNombre.textContent = nombre;
        tdCantidad.appendChild(inputCantidad);
        tdPrecio.textContent = precio;
        tdButtonAgregar.textContent = "Agregar";
        
        tr.appendChild(tdId);
        tr.appendChild(tdNombre);
        tr.appendChild(tdPrecio);
        tr.appendChild(tdCantidad);
        tr.appendChild(tdButtonAgregar);
        
        tbody.appendChild(tr);
        
        tdButtonAgregar.addEventListener("click",function(){mostrarTBodySecundario(idProducto,nombre,precio,inputCantidad.value)});
    });
}

async function mostrarTBodySecundario(id,nombre,precio,cantidad){
    const trSec = document.createElement("tr");
    
    const tdNombreSec = document.createElement("td");
    const tdCantidadSec = document.createElement("td");
    
    tdNombreSec.textContent = nombre;
    tdCantidadSec.textContent = cantidad;
    
    productosVenta.push(new ProductosVenta(id,nombre,precio,cantidad));

    trSec.appendChild(tdNombreSec);
    trSec.appendChild(tdCantidadSec);
    
    tbody_secundario.appendChild(trSec);
}

botonConfirmarVenta.addEventListener("click",confirmarVenta);

async function confirmarVenta(e){
    e.preventDefault();
    console.log(productosVenta); 

    let dataCompra = new FormData();

    dataCompra.append("arregloVenta",JSON.stringify(productosVenta));

    let datos = await fetch("./api-productoVentas.php",{
        method:"POST",
        body:dataCompra
    });

    window.location.href = "./ventas.php";
}