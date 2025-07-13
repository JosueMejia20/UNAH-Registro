document.addEventListener('DOMContentLoaded', () => {
    const mainContent = document.querySelector('.main-content');

    // Escuchamos eventos en toda la página
    document.body.addEventListener('click', async (e) => {
        const link = e.target.closest('.nav-link');
        if (link && link.dataset.view) {
            e.preventDefault();

            // Quitar clase 'active' de todos
            document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));

            // Agregar clase 'active' al seleccionado
            link.classList.add('active');

            // Cargar vista
            const vista = link.dataset.view;
            try {
                const res = await fetch(`${vista}.php`);
                const html = await res.text();
                mainContent.innerHTML = html;
            } catch (err) {
                mainContent.innerHTML = `<div class="alert alert-danger">Error al cargar la vista ${vista}</div>`;
            }
        }
    });

    // Cargar vista inicial
    const defaultLink = document.querySelector('.nav-link[data-view="perfil"]');
    if (defaultLink) defaultLink.click();
});
