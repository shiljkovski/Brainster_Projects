const nameEl = document.querySelector("#name");
const companyEl = document.querySelector("#company");
const emailEl = document.querySelector("#email");
const phoneEl = document.querySelector("#phone");
const studentEl = document.querySelector("#academy-type");
const errorEmailEl = document.querySelector("#email-error");
const errorNameEl = document.querySelector("#name-error");
const errorCompanyEl = document.querySelector("#company-error");
const errorPhoneEl = document.querySelector("#phone-error");
const errorStudentEl = document.querySelector("#student-error");

const formEl = document.querySelector("#form");
formEl.addEventListener("submit", onFormSubmit);
function onFormSubmit(event) {
  event.preventDefault();

  if (nameEl.value.trim() == "" || !validateName(nameEl.value)) {
    nameEl.classList.remove("success");
    nameEl.classList.add("error");
    errorNameEl.classList.add("visible");
  } else {
    nameEl.classList.remove("error");
    nameEl.classList.add("success");
    errorNameEl.classList.remove("visible");
  }

  if (companyEl.value.trim() == "") {
    companyEl.classList.remove("success");
    companyEl.classList.add("error");
    errorCompanyEl.classList.add("visible");
  } else {
    companyEl.classList.remove("error");
    companyEl.classList.add("success");
    errorCompanyEl.classList.remove("visible");
  }

  if (emailEl.value == "" || !validateEmail(emailEl.value)) {
    emailEl.classList.remove("success");
    emailEl.classList.add("error");
    errorEmailEl.classList.add("visible");
  } else {
    emailEl.classList.remove("error");
    errorEmailEl.classList.remove("visible");
    emailEl.classList.add("success");
  }

  if (phoneEl.value == "" || !validatePhone(phoneEl.value)) {
    phoneEl.classList.remove("success");
    phoneEl.classList.add("error");
    errorPhoneEl.classList.add("visible");
  } else {
    phoneEl.classList.remove("error");
    phoneEl.classList.add("success");
    errorPhoneEl.classList.remove("visible");
  }

  if (studentEl.value == "default") {
    studentEl.classList.remove("success");
    studentEl.classList.add("error");
    errorStudentEl.classList.add("visible");
  } else {
    studentEl.classList.remove("error");
    studentEl.classList.add("success");
    errorStudentEl.classList.remove("visible");
  }
  if (
    nameEl.classList.contains("error") ||
    companyEl.classList.contains("error") ||
    emailEl.classList.contains("error") ||
    phoneEl.classList.contains("error") ||
    studentEl.classList.contains("error")
  ) {
    return;
  }

  formEl.submit();
}
function validateEmail(email) {
  const regex =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  const isValid = regex.test(String(email).toLowerCase());
  return isValid;
}
function validatePhone(phone) {
  const regex =
    /^(0{0,2}\+?389[\s./-]?)(\(?[0]?[7-7][0-9]\)?[\s./-]?)([2-9]\d{2}[\s./-]?\d{3})$/;
  const isValid = regex.test(String(phone));
  return isValid;
}
function validateName(name) {
  const nameSplit = name
    .trim()
    .split(" ")
    .filter((x) => x);
  if (nameSplit.length >= 2) {
    return true;
  } else {
    return false;
  }
}
function toggleMobileMenu(menu) {
  const mobileMenuUl = document.getElementById("mobile-menu");
  menu.classList.toggle("open");
  mobileMenuUl.classList.toggle("open");
}
