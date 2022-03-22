function Validator(options) {

    // thuc hien validate du lieu nhap vao

    function validate(inputElement, rule) {
        // test function here
        var errorElement = inputElement.parentElement.querySelector('.form-message');
        var errorMessage = rule.test(inputElement.value);

        if (errorMessage) {
            errorElement.innerText = errorMessage;
        } else {
            errorElement.innerText = '';
        }
    }

    // lay form can validate
    var formElement = document.querySelector(options.form);

    if (formElement) {
        options.rules.forEach(function(rule) {

            var inputElement = formElement.querySelector(rule.selector);

            if (inputElement) {
                // blur khoi input
                inputElement.onblur = function() {
                    validate(inputElement, rule);
                }

                // nhap vao input
                var errorElement = inputElement.parentElement.querySelector('.form-message');
                inputElement.oninput = function() {
                    errorElement.innerText = '';
                }
            }
        });
    }

}

// Dinh nghia rule
// co loi: tra message loi
// khong hop le: khong tra ra gi ca
Validator.isRequired = function(selector) {
    return {
        selector: selector,
        test: function(value) {
            return value.trim() ? undefined : "Please enter this information."
        }
    };
}

Validator.isEmail = function(selector) {
    return {
        selector: selector,
        test: function(value) {
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined : "Please enter an email."
        }
    };
}

Validator.isPassword = function(selector, min) {
    return {
        selector: selector,
        test: function(value) {
            return value.length >= min ? undefined : `Please enter at least ${min} characters.`
        }
    };
}

Validator.isConfirmed = function(selector, getConfirmValue) {
    return {
        selector: selector,
        test: function(value) {
            return value === getConfirmValue() ? undefined : "Incorrect input."
        }
    };
}