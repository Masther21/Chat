const frm_nuevo_Usuario = document.getElementById('frm_Registro');
frm_nuevo_Usuario.addEventListener('submit', (e)=>{
    e.preventDefault();
    frm_add_NewUser();
});

async function frm_add_NewUser() {
    const formData = new FormData();
    formData.append("nombre", document.getElementById("frm_Input_nom").value);
    formData.append("email", document.getElementById("frm_Input_mail").value);
    formData.append("pass", document.getElementById("frm_Input_pass").value);
    formData.append("conPass", document.getElementById("frm_Input_confPass").value);

    // Imagen
    const file = document.getElementById("fileInput").files[0];
    if (file) {
        formData.append("img", file);
    }

    let respUser = await fetch(URL_PATH + "/page/create", {
        method: "POST",
        body: formData
    });

    let respUserData = await respUser.json();
    alert(respUserData.message);

    // Redirigir al enlace principal
    window.location.href = URL_PATH;
}
