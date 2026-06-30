// ==========================================
// VARIABLES GLOBALES
// ==========================================

let currentReceiver = null;
// let lastMessageCount = 0;

// ==========================================
// INICIALIZACIÓN
// ==========================================

document.addEventListener("DOMContentLoaded", async () => {
  // Perfil usuario
  await Userlogued();

  // Lista de contactos
  await ListUserChat();

  // Enviar mensaje
  document.getElementById("newChating").addEventListener("submit", async (e) => {
    e.preventDefault();
    await sendMessage();
  });

  setInterval(async () => {
    if (currentReceiver) {
      await loadChatMessages(currentReceiver);
    }
    await updateBadges();
    await ListUserChat();
  }, 1000);

  const logoutBtn = document.getElementById("logout"); 
  logoutBtn.addEventListener("click", async () => {
    try {
      const response = await fetch(URL_PATH + "/page/logout", {
        method: "POST"
      });

      const result = await response.json();

      if (result.success) {
        // Redirigir a la ruta principal
        window.location.href = URL_PATH + "/";
      } else {
        alert("Error al cerrar sesión: " + result.message);
      }
    } catch (error) {
      console.error("Error cerrando sesión:", error);
    }
  });
});

// ==========================================
// PERFIL USUARIO
// ==========================================

async function Userlogued() {
  try {
    const response = await fetch(URL_PATH + "/page/dataLogued");
    const data = await response.json();
    
    if (!data.success) return;
    
    document.getElementById("User_perfil").innerHTML = `
      <img src="${data.result.img_u}" alt="${data.result.name_u}">
      <div>
        <div>${data.result.name_u}</div>
        <small>${data.result.estado_u === 1 ? "Activo" : "Inactivo"}</small>
        
      </div>
    `;
  } catch (error) {
    console.error(error);
  }
}

// ==========================================
// LISTAR CONTACTOS
// ==========================================

async function ListUserChat() {
  try {
    const response = await fetch(URL_PATH + "/page/dataLogued");
    const data = await response.json();
    
    if (!data.success) return;
    
    const container = document.getElementById("User_chat");
    container.innerHTML = "";
    console.log(data.answer);
    data.answer.forEach(user => {
      container.insertAdjacentHTML("beforeend", `
        <button class="contact" data-id="${user.id_u}" type="button">
          <img src="${user.img_u}" alt="${user.name_u}">
          <div class="contact-info">
            <span class="contact-name">
              ${user.name_u}
            </span>
            
            <span class="contact-status">
              ${user.estado_u === 1 ? "Activo" : "Inactivo"}
            </span>
          </div>
          ${user.unread_count > 0 ? `<div class="badge">${user.unread_count}</div>` : ""}
        </button>
      `);
    });
  
    // Eventos click
    document.querySelectorAll(".contact").forEach(btn => {
      btn.onclick = async () => {
        currentReceiver = btn.dataset.id;
        document.getElementById("idReceiver").value = currentReceiver;
        await loadChatMessages(currentReceiver);
        
        // Eliminar badge inmediatamente
        const badge = btn.querySelector(".badge");
        
        if (badge) {
          badge.remove();
        }
      };
    });
  } catch (error) {
    console.error(error);
  }
}

// ==========================================
// CARGAR MENSAJES
// ==========================================

async function loadChatMessages(userId) {
  try {
    const response = await fetch(URL_PATH + "/page/OptMsnUser", {
      method: "POST",
      headers: {"Content-Type":"application/x-www-form-urlencoded"},
      body: "id_u=" + encodeURIComponent(userId)
    });
    
    const data = await response.json();
    renderChatMessages(data);
  } catch (error) {
    console.error(error);
  }
}

// ==========================================
// MOSTRAR MENSAJES
// ==========================================

function renderChatMessages(data) {
  const chat = document.getElementById("chatMessages");
  chat.innerHTML = "";
  const chatHeader = document.getElementById("chatHeader");

  if (data.answer) {
    chatHeader.innerHTML = `
      <img src="${data.answer.img_u}" alt="${data.answer.name_u}">
      <span>
        ${data.answer.name_u}
      </span>
      
      <button class="logout-btn" title="Salir" id="logout">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 24 24">
          <path d="M16 13v-2H7V8l-5 4 5 4v-3h9zm3-10H5c-1.1 0-2 .9-2 2v4h2V5h14v14H5v-4H3v4c0 1.1.9 2 2 
          2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
        </svg>
      </button>        
    `;
  }
  
  if (!data.success) {
    chat.innerHTML = "<p>No existen mensajes.</p>";
    return;
  }
  
  data.result.forEach(msg => {
    chat.insertAdjacentHTML("beforeend", `
      <div class="message ${msg.tipo === "enviado" ? "sent" : "received"}">
      <!--<div class="message ${msg.tipo}">-->
        <img src="${msg.img_u}"> 
        <div>
          <span>  
            ${msg.msj_m}
          </span>
          
          <small>
            ${msg.fecha}
          </small>
        </div>  
      </div>
    `);
  });
  
  chat.scrollTop = chat.scrollHeight;

}

// ==========================================
// ENVIAR MENSAJE
// ==========================================

async function sendMessage() {
  if (!currentReceiver) return;
  
  const formData = new FormData();
  
  formData.append("id_sender", document.getElementById("idSender").value);
  formData.append("id_receiver", currentReceiver);
  formData.append("mensaje",document.getElementById("chatInput").value);
  
  const file = document.getElementById("fileInput").files[0];
  
  if (file) {
    formData.append("archivo", file);
  }

  try {
    const response = await fetch(URL_PATH + "/page/SendMessage", {
      method: "POST",
      body: formData
    });
    
    const result = await response.json();
    
    if (result.success) {
      document.getElementById("chatInput").value = "";
      document.getElementById("fileInput").value = "";
      document.getElementById("previewContainer").innerHTML = "";
      
      await loadChatMessages(currentReceiver);
    }
  } catch (error) {
    console.error(error);
  }
}

// ==========================================
// VERIFICACION DE CONTEO DE MENSAJES
// ==========================================

async function updateBadges() {
  try {
    const response = await fetch(URL_PATH + "/page/UnreadMessages");
    const users = await response.json();
    
    users.forEach(user => {
      const button = document.querySelector(`.contact[data-id="${user.id_u}"]`);
      if(!button) return;

      const badge = button.querySelector(".badge");
      
      if(user.unread_count > 0) {
        if(badge) {
          badge.textContent = user.unread_count;
        } else {
          const div = document.createElement("div");
          div.className = "badge";
          div.textContent = user.unread_count;
          button.appendChild(div);
        }
      } else {
        if(badge) {
          badge.remove();
        }
      }

    });

  } catch(error) {
    console.error(error);
  }
}

