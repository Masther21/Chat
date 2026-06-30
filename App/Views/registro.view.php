
<div class="register-container">
  <h2>Registro</h2>
  <!-- Imagen de previsualización -->
  <img id="previewImage" class="preview" alt="Previsualización">
  
  <form id="frm_Registro">
    <!-- Botón que dispara el input file -->
    <button type="button" id="callInput">Imagen de perfil</button>
    <input type="file" id="fileInput" name="frm_Input_img" accept="image/*" onchange="previewFile()">
    
    <input id="frm_Input_nom"      name="frm_Input_nom"      type="text" placeholder="Nombre" required>
    <input id="frm_Input_mail"     name="frm_Input_mail"     type="email" placeholder="Correo" required>
    <input id="frm_Input_pass"     name="frm_Input_pass"     type="password" placeholder="Contraseña" required>
    <input id="frm_Input_confPass" name="frm_Input_confPass" type="password" placeholder="Confirmar Contraseña" required>
    <button type="submit">Registrarse</button>
  </form>
</div>
