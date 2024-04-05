import {helpers, maxLength, numeric, required, requiredIf, alpha, email} from "@vuelidate/validators";

const imageTypes = [
    'image/jpeg',
    'image/png',
    'image/jpg',
]
const image = file => imageTypes.find(type => file.type === type) ? true : false

const rules = {
    name: {required, maxLength: maxLength(60)},
    quantity: {required, numeric},
    description: {required, maxLength: maxLength(255)},
    image: {},
}




export {rules}
