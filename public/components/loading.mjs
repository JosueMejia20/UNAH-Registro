/* Pantalla de carga  */

class Cargando extends HTMLElement{
    connectedCallback(){
        this.innerHTML = ` 
        <div id="loading-screen">
            <img src="https://biologia.unah.edu.hn/dmsdocument/1433-unah-logo-texto" alt="Logo UNAH" class="loading-logo">
            <div class="loading-spinner"></div>
            <div class="loading-text">Cargando pantalla pumita...</div>
        </div>
        `;
    }
}
const loadingEvent = ()=>{
    window.addEventListener('load', function() {
        setTimeout(function() {
            document.getElementById('loading-screen').classList.add('hidden');
        }, 1500);
    });
    
};

export{
    Cargando,
    loadingEvent
}