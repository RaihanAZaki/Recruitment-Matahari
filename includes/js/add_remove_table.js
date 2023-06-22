$(function(){
    $('#org_add').on('click', function() {
              var data = $("#tb_org tr:eq(1)").clone(true).show().appendTo("#tb_org");
              data.find("input").val('');
     });
     $(document).on('click', '.org_rem', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>2) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
});


$(function(){
    $('#skills_add').on('click', function() {
              var data = $("#tb_skills tr:eq(1)").clone(true).show().appendTo("#tb_skills");
              data.find("input").val('');
     });
     $(document).on('click', '.skills_rem', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>2) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
});

$(function(){
    $('#lang_add').on('click', function() {
              var data = $("#tb_lang tr:eq(1)").clone(true).show().appendTo("#tb_lang");
              data.find("input").val('');
     });
     $(document).on('click', '.lang_rem', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>2) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
});

$(function(){
    $('#fam_add').on('click', function() {
              var data = $("#tb_fam tr:eq(1)").clone(true).show().appendTo("#tb_fam");
              data.find("input").val('');
     });
     $(document).on('click', '.fam_rem', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>2) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
});
