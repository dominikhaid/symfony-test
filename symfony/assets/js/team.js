
document.addEventListener('DOMContentLoaded', function() {
  let deleteMember = document.getElementsByClassName('delteMember')

  if(deleteMember) {
    for (let index = 0; index < deleteMember.length; index++) {
      const btn = deleteMember[index];
        btn.addEventListener('click',(e)=>{
      e.preventDefault();
       $.ajax({
        type: "DELETE",
        url: `/api/team?id=${e.target.getAttribute('data-id')}`,
        dataType: "json",
        success: function() {
            window.location = "/admin/team"
        }
    });
  })
    }

}

});