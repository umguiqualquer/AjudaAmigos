import './bootstrap';

//Apresentar e ocultar a senha e substituir o ícone
window.togglePassword = function(fieldId, toggleIcon){
  const field = document.getElementById(fieldId);
  const icon = toggleIcon.querySelector('i');

  if(field.type === "password"){
      field.type = "text";
      icon.classList.remove('bi', 'bi-eye');
      icon.classList.add('bi', 'bi-eye-slash')
  } else {
      field.type = "password";
      icon.classList.remove('bi', 'bi-eye-slash');
      icon.classList.add('bi', 'bi-eye')
  }
}

window.confirmDelete = function (id) {
  Swal.fire({
      title: "Tem certeza?",
      text: "Essa ação não pode ser desfeita!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Sim, excluir!",
      cancelButtonText: "Cancelar"
  }).then((result) => {
      if (result.isConfirmed) {
          document.getElementById('delete-form-' + id).submit();
      }
  })
}