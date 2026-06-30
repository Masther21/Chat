const frm_LogUsuario = document.getElementById('frm_Login');
frm_LogUsuario.addEventListener('submit', (e)=>{
    e.preventDefault();
    frm_login_User();
});

async function frm_login_User() {
    let usuario = {};
    usuario.email = document.getElementById('frm_Inp_mail').value;
    usuario.pass = document.getElementById('frm_Inp_pass').value;
    
    let respUser = await fetch(URL_PATH + '/page/OptenerUser', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(usuario),
    });

    let respUserData = await respUser.json();

    window.location.href = URL_PATH + "/page/chat";
}
