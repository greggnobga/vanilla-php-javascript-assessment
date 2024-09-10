class Validator {
  constructor(inputs) {
    this.inputs = inputs;
    this.errors = {};
  }

  validateRequired(inputElement) {
    if (!inputElement.value.trim()) {
      this.errors[inputElement.id] = "This field is required from javascript.";
    }
  }

  validatePattern(inputElement, pattern, errorMessage) {
    const regex = new RegExp(pattern);
    if (!regex.test(inputElement.value)) {
      this.errors[inputElement.id] = errorMessage;
    }
  }

  clearErrors() {
    this.errors = {};
    this.inputs.forEach((input) => {
      const errorElement = document.querySelector(`#${input.id} + .form-error`);
      if (errorElement) {
        errorElement.textContent = "";
      }
    });
  }

  displayErrors() {
    this.inputs.forEach((input) => {
      const errorElement = document.querySelector(`#${input.id} + .form-error`);

      if (errorElement && this.errors[input.id]) {
        errorElement.textContent = this.errors[input.id];
      }
    });
  }

  validate() {
    this.clearErrors();
    this.inputs.forEach((input) => {
      this.validateRequired(input);
      if (input.id === "fullname") {
        this.validatePattern(
          input,
          "^[a-zA-Z.,\\s]+$",
          "Please enter a valid name from javascript."
        );
      } else if (input.id === "email") {
        this.validatePattern(
          input,
          "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$",
          "Please enter a valid email address from javascript."
        );
      } else if (input.id === "mobile") {
        this.validatePattern(
          input,
          "^(?:\\+63|0)9\\d{9}$",
          "Please enter a valid mobile phone number from javascript."
        );
      } else if (input.id === "gender") {
        this.validatePattern(
          input,
          "^[a-zA-Z.,\\s]+$",
          "Please enter a valid name from javascript."
        );
      }
    });
    return Object.keys(this.errors).length === 0;
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const inputs = Array.from(document.querySelectorAll("input[data-validate]"));
  const validator = new Validator(inputs);

  const form = document.querySelector("#userForm");

  form.addEventListener("submit", async (event) => {
    event.preventDefault();

    const isValid = validator.validate();

    if (!isValid) {
      event.preventDefault();
      validator.displayErrors();
    } else {
      const fullnameInput = document.querySelector("#fullname");
      const emailInput = document.querySelector("#email");
      const mobileInput = document.querySelector("#mobile");
      const dateofbirthInput = document.querySelector("#dateofbirth");
      const genderInput = document.querySelector("#gender");
      const fullnameError = document.querySelector("#fullname-error");
      const emailError = document.querySelector("#email-error");
      const mobileError = document.querySelector("#mobile-error");
      const dateofbirthError = document.querySelector("#dateofbirth-error");

      const formData = new FormData(form);

      try {
        const response = await fetch("submit-form.php", {
          method: "POST",
          body: formData,
        });

        const result = await response.json();

        console.log(result);

        fullnameError.textContent = "";
        emailError.textContent = "";
        mobileError.textContent = "";
        dateofbirthError.textContent = "";

        if (result.errors) {
          if (result.errors.fullname)
            fullnameError.textContent = result.errors.fullname;
          if (result.errors.email) emailError.textContent = result.errors.email;
          if (result.errors.mobile)
            mobileError.textContent = result.errors.mobile;
          if (result.errors.dateofbirth)
            dateofbirthError.textContent = result.errors.dateofbirth;
        } else {
          alert("Form submitted successfully!");
          form.reset();
        }
      } catch (error) {
        console.error("Error:", error);
      }
    }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const dobInput = document.querySelector("#dateofbirth");
  const ageInput = document.querySelector("#age");

  function calculateAge(dob) {
    const today = new Date();
    const birthDate = new Date(dob);
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();

    if (
      monthDiff < 0 ||
      (monthDiff === 0 && today.getDate() < birthDate.getDate())
    ) {
      age--;
    }

    return age;
  }

  dobInput.addEventListener("change", () => {
    const dob = dobInput.value;
    if (dob) {
      const age = calculateAge(dob);
      ageInput.value = age;
    } else {
      ageInput.value = "";
    }
  });
});
