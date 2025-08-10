import { UnahNavbar } from "../../components/navbar.mjs";
customElements.define("unah-navbar",UnahNavbar);

import { Cargando, loadingEvent } from "../../components/loading.mjs";
customElements.define("pantalla-de-carga", Cargando);
loadingEvent();

import { UnahFooter } from "../../components/footer.mjs";
customElements.define("unah-footer", UnahFooter);

import { UnahSidebar } from "../../components/sidebar.mjs";
customElements.define("unah-sidebar", UnahSidebar);


// import { LoginForm } from "../../components/login-form.mjs";
// customElements.define(LoginForm);
// loginevent()

