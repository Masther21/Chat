<div class="app-container">
  <div class="sidebar">
    <!-- AREA DE PERFIL -->
    <div class="user-profile" id="User_perfil">
      <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Usuario" id="perfilUsuario" title="Usuario Logueado!">
      <div>
        <div>Usuario Logueado</div>
        <small>En línea</small>
      </div>
    </div>

    <div class="contacts-header">Contactos</div>
      <!--AREA DE CONTACTOS  -->
    <div class="user_chat" id="User_chat">
      
      <button class="contact" id="button" type="button">
        <!-- <div class="contact" onclick="openChat(this, 'Juan')"> -->
        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Juan">
        <div class="contact-info">
          <span class="contact-name">Juan Pérez</span>
          <span class="contact-status">Activo</span>
        </div>
        <div class="badge">3</div>
        <!-- <div class="contact"></div> -->
      </button>
    
      <button class="contact" id="button" type="button">
        <!-- <div class="contact" onclick="openChat(this, 'Juan')"> -->
        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Juan">
        <div class="contact-info">
          <span class="contact-name">Juan Pérez</span>
          <span class="contact-status">Activo</span>
        </div>          
        <div class="badge">3</div>
        <!-- </div> -->
     </button>

    </div>
  </div>
    
  <!-- AREA DE CHAT -->
  <div class="chat-container">
    <div class="chat-header" id="chatHeader">
      <span>Selecciona un contacto</span>
      <!-- <button class="logout-btn" onclick="logout()">X</button> -->


      <button class="logout-btn" id="logout" alt="Cerrar Sessión" title="Cerrar Sessión">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 24 24">
          <path d="M16 13v-2H7V8l-5 4 5 4v-3h9zm3-10H5c-1.1 0-2 .9-2 2v4h2V5h14v14H5v-4H3v4c0 1.1.9 2 2 
          2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
        </svg>
      </button>
    </div>
      
    <div class="chat-messages" id="chatMessages"></div>
      
    <div id="previewContainer"></div>
      
    <form class="chat-input" id="newChating">
      <!-- <input type="hidden" id="idSender" value="<?php echo $_SESSION['unique_id']; ?>"> -->
      <!-- <input type="hidden" id="idReceiver" value=""> -->
      <input type="hidden" id="idSender" value="<?php echo $_SESSION['unique_id']; ?>">
      <input type="hidden" id="idReceiver" value="">
      <input type="text" id="chatInput" placeholder="Escribe un mensaje...">
        
      <div class="inputs-send-add">
        <label for="fileInput" class="attach-btn" alt="Adjuntar Imagen" title="Adjuntar Imagen">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21.44 11.05l-9.19 9.19a5 5 0 01-7.07-7.07l9.19-9.19a3 3 0 014.24 4.24l-9.19 9.19a1 1 0 01-1.41-1.41l9.19-9.19"/>
          </svg>
        </label>
        <!-- <label for="fileInput">📎</label> -->
          
        <input type="file" id="fileInput" accept="image/*">
        <!-- <button onclick="sendMessage()" alt="Enviar Mensajes" title="Enviar Mensajes"> -->
        <button type="submit" alt="Enviar Mensajes" title="Enviar Mensajes">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M2 21l21-9L2 3v7l15 2-15 2v7z"/>            
          </svg>
        </button>
      </div>
      
    </form>
    </div>
  </div>


  <!-- Script Login -->
        <script src="<?= URL_PATH ?>/Assets/JS/chatingUser.js"></script>
