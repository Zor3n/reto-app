function updateReservation(id, cc, name, last_name, tel_user, pet_name, date, status, url) {
    document.getElementById("updateUserDNI").value = cc;
    document.getElementById("updateUserName").value = name;
    document.getElementById("updateUserLastName").value = last_name;
    document.getElementById("updateUserCelNumber").value = tel_user;
    document.getElementById("updateUserPetName").value = pet_name;
    document.getElementById("updateReservationDate").value = date;
    document.getElementById("updateReservationDate").min = date;

    if (status == 0) {
      document.getElementById("updateReservationStatus").value = 0;
    } else if(status == 1) {
      document.getElementById("updateReservationStatus").value = 1;
    } else {
      document.getElementById("updateReservationStatus").value = 2;
    }

    document.getElementById("updateForm").action = url+"/"+id;
}

function deleteReservation(id, cc, name, last_name, tel, date, url) {
  document.getElementById("deleteUserDNI").value = cc;
  document.getElementById("deleteUserCelNumber").value = tel;
  document.getElementById("deleteUserName").value = name;
  document.getElementById("deleteUserLastName").value = last_name;
  document.getElementById("deleteReservationDate").value = date;
  document.getElementById("deleteForm").action = url+"/"+id;
}

function updateReservationDataCheck(params) {
    
}

function saveAppointmentDataCheck(params) {

}