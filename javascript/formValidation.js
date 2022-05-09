function addFormValidate(AddForm){
    var isFormValid = false;
    if(!AddForm.name.value.match(/^[a-zA-Z][-]*[a-zA-Z\s-]*$/)){
      AddForm.name.className = "wrong-input"
      AddForm.name.value = ""
      AddForm.name.placeholder = "Enter only letters and spaces in name"
      isFormValid = false;
    }
    else {
      AddForm.name.className = "input"
      isFormValid = true;
    }
    if(!AddForm.price.value.match(/[0-9]+["."]*[0-9]*/)){
      AddForm.price.className = "wrong-input"
      AddForm.price.value = ""
      AddForm.price.placeholder = "Enter only numbers and decimal point in price"
      isFormValid = false;
    }
    else {
      AddForm.price.className = "input"
      isFormValid = true;
    }
    if(!AddForm.quantity.value.match(/[0-9]+["."]*[0-9]*/)){
      AddForm.quantity.className = "wrong-input"
      AddForm.quantity.value = ""
      AddForm.quantity.placeholder = "Enter only numbers and decimal point in quantity"
      isFormValid = false;
    }
    else {
      AddForm.quantity.className = "input"
      isFormValid = true;
    }

    if(!isFormValid){
      return false;
    }
    // if(AddForm.image.value == ""){
    //   alert("no image")
    //   return false;
    // }
    return true;

  }

  function reset(){
    document.AddForm.name.className = "input"
    document.AddForm.price.className = "input"
    document.AddForm.quantity.className = "input"
  }