import {helpers, maxLength, numeric, required, requiredIf, alpha, email} from "@vuelidate/validators";



const rules = {
    name: {required, maxLength: maxLength(60)},
    description: {required, maxLength: maxLength(255)},
}




export {rules}
