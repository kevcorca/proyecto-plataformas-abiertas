// articulos.js

document.addEventListener('DOMContentLoaded', () => {
    loadArticulos();
    loadMarcas();

    const addArticuloForm = document.getElementById('add-articulo-form');
    addArticuloForm.addEventListener('submit', addArticulo);

    const updateArticuloForm = document.getElementById('update-articulo-form');
    updateArticuloForm.addEventListener('submit', updateArticulo);
});

function loadArticulos() {
    fetch('API/src/controllers/articuloController.php')
        .then(response => response.json())
        .then(articulos => {
            const articulosTableBody = document.querySelector('#articulos-table tbody');
            articulosTableBody.innerHTML = '';

            articulos.forEach(articulo => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${articulo.nombre_articulo}</td>
                    <td>${articulo.nombre_marca}</td>
                    <td>${articulo.precio_articulo}</td>
                    <td>${articulo.cantidad_articulo}</td>
                    <td>
                        <button onclick="editArticulo(${articulo.id_articulo})">Editar</button>
                        <button onclick="deleteArticulo(${articulo.id_articulo})">Eliminar</button>
                    </td>
                `;
                articulosTableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los artículos:', error));
}

function loadMarcas() {
    fetch('API/src/controllers/marcaController.php')
        .then(response => response.json())
        .then(marcas => {
            const marcaSelect = document.getElementById('marca_id');
            marcaSelect.innerHTML = '';

            marcas.forEach(marca => {
                const option = document.createElement('option');
                option.value = marca.id_marca;
                option.text = `${marca.nombre_marca}`;
                marcaSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar las marcas:', error));
}

function addArticulo(event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    const data = {
        nombre_articulo: formData.get('nombre'),
        marca_id: formData.get('marca_id'),
        precio_articulo: formData.get('precio'),
        cantidad_articulo: formData.get('cantidad_stock')
    };

    fetch('API/src/controllers/articuloController.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(() => loadArticulos())
    .catch(error => console.error('Error al agregar artículo:', error));
}

function editArticulo(id_articulo) {
    fetch(`API/src/controllers/articuloController.php?id_articulo=${id_articulo}`)
        .then(response => response.json())
        .then(articulo => {
            document.getElementById('update-id_articulo').value = articulo.id_articulo;
            document.getElementById('update-nombre').value = articulo.nombre_articulo;
            document.getElementById('update-marca_id').value = articulo.marca_id;
            document.getElementById('update-precio').value = articulo.precio_articulo;
            document.getElementById('update-cantidad_stock').value = articulo.cantidad_articulo;

            document.getElementById('update-articulo-form').style.display = 'block';
        })
        .catch(error => console.error('Error al cargar artículo para editar:', error));
}

function updateArticulo(event) {
    event.preventDefault();

    const id_articulo = document.getElementById('update-id_articulo').value;
    const formData = new FormData(event.target);
    const data = {
        nombre_articulo: formData.get('nombre'),
        marca_id: formData.get('marca_id'),
        precio_articulo: formData.get('precio'),
        cantidad_articulo: formData.get('cantidad_stock')
    };

    fetch(`API/src/controllers/articuloController.php?id_articulo=${id_articulo}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(() => {
        loadArticulos();
        document.getElementById('update-articulo-form').style.display = 'none';
    })
    .catch(error => console.error('Error al actualizar artículo:', error));
}

function deleteArticulo(id_articulo) {
    fetch(`API/src/controllers/articuloController.php?id_articulo=${id_articulo}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(() => loadArticulos())
    .catch(error => console.error('Error al eliminar artículo:', error));
}