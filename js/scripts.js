// scripts.js

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('link-articulos').addEventListener('click', () => showSection('articulos-section'));
    document.getElementById('link-transacciones').addEventListener('click', () => showSection('transacciones-section'));
    document.getElementById('link-marcas').addEventListener('click', () => showSection('marcas-section'));

    // Cargar la sección de Artículos por defecto
    showSection('articulos-section');
});

function showSection(sectionId) {
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
        section.style.display = section.id === sectionId ? 'block' : 'none';
    });
}