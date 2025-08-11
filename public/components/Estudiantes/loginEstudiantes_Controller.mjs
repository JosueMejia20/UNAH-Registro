const BASE_URL = '/api/estudiantes';

export const validarCredenciales = async (cuenta, contrasena) => {
    try {
        const res = await fetch(`${BASE_URL}/post/loginEstudiante/index.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                userName: cuenta,
                password: contrasena
            }),
        });

        if (!res.ok) throw new Error('Error de red');

        const data = await res.json();
        return data;
    } catch (error) {
        console.error('Error en login:', error);
        return { success: false, message: 'Error de conexión' };
    }
};