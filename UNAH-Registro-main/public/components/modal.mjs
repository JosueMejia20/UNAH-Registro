class UnahModal extends HTMLElement {
    constructor() {
        super();

        // Crear Shadow DOM
        this.attachShadow({ mode: 'open' });

        // Estructura del modal
        this.shadowRoot.innerHTML = `
            <style>
                .modal-backdrop {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    display: none;
                    justify-content: center;
                    align-items: center;
                    z-index: 1050;
                }
                .modal {
                    background-color: white;
                    border-radius: 8px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                    width: 300px;
                    max-width: 90%;
                    padding: 20px;
                    text-align: center;
                }
                .modal-title {
                    font-size: 18px;
                    font-weight: bold;
                    margin-bottom: 15px;
                    color: #333;
                }
                .modal-message {
                    margin-bottom: 20px;
                    color: #555;
                    line-height: 1.4;
                }
                .modal-footer {
                    display: flex;
                    justify-content: center;
                    gap: 10px;
                }
                .modal-button {
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    padding: 8px 20px;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 14px;
                    transition: background-color 0.3s;
                }
                .modal-button:hover {
                    background-color: #45a049;
                }
                .btn-cancel {
                    background-color: #ccc;
                    color: #333;
                }
                .btn-cancel:hover {
                    background-color: #aaa;
                }
            </style>
            <div class="modal-backdrop">
                <div class="modal">
                    <div class="modal-title">Notificación</div>
                    <div class="modal-message"></div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        `;

        // Referencias internas
        this.backdrop = this.shadowRoot.querySelector('.modal-backdrop');
        this.messageEl = this.shadowRoot.querySelector('.modal-message');
        this.footer = this.shadowRoot.querySelector('.modal-footer');

        this.callback = null;
    }

    // Modal normal (Aceptar)
    show(message, callback = null) {
        this.messageEl.textContent = message;
        this.callback = callback;

        // Render solo botón aceptar
        this.footer.innerHTML = `
            <button class="modal-button btn-accept">Aceptar</button>
        `;

        this.footer.querySelector('.btn-accept').addEventListener('click', () => this._cerrar(true));
        this.backdrop.style.display = 'flex';
    }

    // Modal confirmación (Aceptar / Cancelar)
    confirm(message, callback = null) {
        this.messageEl.textContent = message;
        this.callback = callback;

        // Render botones Aceptar y Cancelar
        this.footer.innerHTML = `
            <button class="modal-button btn-cancel">Cancelar</button>
            <button class="modal-button btn-accept">Aceptar</button>
        `;

        // Botón cancelar (solo cerrar)
        this.footer.querySelector('.btn-cancel').addEventListener('click', () => this._cerrar(false));

        // Botón aceptar
        this.footer.querySelector('.btn-accept').addEventListener('click', () => this._cerrar(true));

        this.backdrop.style.display = 'flex';
    }

    // Cerrar modal
    _cerrar(confirmado) {
        this.backdrop.style.display = 'none';

        if (confirmado && typeof this.callback === 'function') {
            this.callback();
        }

        this.callback = null;
    }
}

export {
    UnahModal
};
