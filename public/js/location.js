$(document).ready(function() {

  $('#check_box').change(function() {
    if(this.checked) {
      $('#list_address').css("display",'block');
      document.getElementById("select_list_address").required = true;
      document.getElementById("first").required = false;
      document.getElementById("last").required = false;
      document.getElementById("phone_number").required = false;
      document.getElementById("email").required = false;
      document.getElementById("province").required = false;
      document.getElementById("district").required = false;
      document.getElementById("ward").required = false;
      document.getElementById("address").required = false;

      document.getElementById("first").disabled = true;
      document.getElementById("last").disabled = true;
      document.getElementById("phone_number").disabled = true;
      document.getElementById("email").disabled = true;
      $('.province .nice-select').addClass("disabled");
      $('.district .nice-select').addClass("disabled");
      $('.ward .nice-select').addClass("disabled");
      document.getElementById("address").disabled = true;
    }else{
      $('#list_address').css("display",'none');
      document.getElementById("select_list_address").required = false;
      document.getElementById("first").required = true;
      document.getElementById("last").required = true;
      document.getElementById("phone_number").required = true;
      document.getElementById("email").required = true;
      document.getElementById("province").required = true;
      document.getElementById("district").required = true;
      document.getElementById("ward").required = true;
      document.getElementById("address").required = true;

      document.getElementById("first").disabled = false;
      document.getElementById("last").disabled = false;
      document.getElementById("phone_number").disabled = false;
      document.getElementById("email").disabled = false;
      $('.province .nice-select').removeClass("disabled");
      document.getElementById("address").disabled = false;
    }
  });

  $('#province').change(function () {
    var id = $( "select#province" ).val();
    $('.district .nice-select').removeClass("disabled");
    if(id != 'Tỉnh/Thành Phố'){
      $.ajax({
        type:'GET',
        url :'/district/'+ id,
      }).done(function(res){
        renderDistrict(res.data,'Quận/Huyện')
      })
    }else{
      $( ".district .nice-select .current").html('Quận/Huyện')
      $('.district .nice-select').addClass("disabled");
      $( ".ward .nice-select .current").html('Phường/Xã')
      $('.ward .nice-select').addClass("disabled");
    }
  })
  $('#district').change(function () {
    var id = $( "select#district" ).val();
    document.getElementById("input_district").value = id ;
    $('.ward .nice-select').removeClass("disabled");
    if(id != 'Quận/Huyện'){
      $.ajax({
        type:'GET',
        url :'/ward/'+ id,
      }).done(function(res){
        renderWard(res.data,'Phường/Xã')
      })
    }else{
      $( ".ward .nice-select .current").html('Phường/Xã')
      $('.ward .nice-select').addClass("disabled");
    }
  })
});
$('#ward').change(function () {
  var id = $( "select#ward" ).val();
  document.getElementById("input_ward").value = id ;
});
function renderDistrict(list,title){
  let seletcontent = `<option>${title}</option>`;
  let content = `<span class="current">${title}</span><ul class="list"><li data-value="Quận/Huyện" class="option selected focus">Quận/Huyện</li>`;
  list.map((item, index) => {
    content += `<li data-value="${item.id}" class="option">${item.name}</li>`
    seletcontent += `<option value="${item.id}">${item.name}</option>`
  });
  content +=`</ul>`
  $("#district").html(seletcontent);
  $(".district .nice-select").html(content)
}
function renderWard(list,title){
  let seletcontent = `<option>${title}</option>`;
  let content = `<span class="current">${title}</span><ul class="list"><li data-value="Quận/Huyện" class="option selected focus">Quận/Huyện</li>`;
  list.map((item, index) => {
    content += `<li data-value="${item.id}" class="option">${item.name}</li>`
    seletcontent += `<option value="${item.id}">${item.name}</option>`
  });
  content +=`</ul>`
  $("#ward").html(seletcontent);
  $(".ward .nice-select").html(content)
}