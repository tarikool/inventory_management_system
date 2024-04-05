<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


</script>

<template>
    <Head title="Inventory" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Item</h2>
        </template>


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-3">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Add Item</h2>

                        <p class="mt-1 text-sm text-gray-600">
                            Insert Item Information
                        </p>
                    </header>

                    <form @submit.prevent="updateItem" class="mt-6 space-y-6" id="itemForm" ref="itemForm">
                        <input type="hidden" name="_method" value="PUT">

                        <div class="grid grid-cols-3 gap-4">
                            <div class="sm:max-w-md">
                                <InputLabel for="name" value="Name" />

                                <TextInput name="name" id="name" type="text" class="mt-1 block w-full" autocomplete="off"
                                           v-model="name" @blur="vx.name.$touch"/>
                                <InputError class="mt-2" v-if="vx.name.$error" :message="errorMsg(vx.name)" />
                            </div>

                            <div class="sm:max-w-md">
                                <InputLabel for="quantity" value="Quantity" />

                                <TextInput name="quantity" id="quantity" type="text" class="mt-1 block w-full" autocomplete="off"
                                           v-model="quantity" @blur="vx.quantity.$touch"/>
                                <InputError class="mt-2" v-if="vx.quantity.$error" :message="errorMsg(vx.quantity)" />
                            </div>

                        </div>


                        <div class="grid grid-cols-3 gap-4">
                            <div class="mb-4">
                                <InputLabel for="description" value="Description" />

                                <textarea
                                    name="description"
                                    id="description"
                                    class="border border-gray-300 rounded px-3 py-2 w-full h-32 focus:outline-none focus:ring focus:border-blue-300"
                                    placeholder="Enter description here"
                                    v-model="description"
                                    @blur="vx.description.$touch"
                                ></textarea>
                                <InputError class="mt-2" v-if="vx.description.$error" :message="errorMsg(vx.description)" />
                            </div>

                            <div class="sm:max-w-md">
                                <InputLabel for="image" value="Image" />

                                <TextInput name="image" id="image" type="file" class="mt-1 block w-full" autocomplete="off"
                                           v-model="image" @blur="vx.name.$touch"/>
                                <InputError class="mt-2" v-if="vx.image.$error" :message="errorMsg(vx.image)" />
                            </div>
                        </div>





                        <div class="flex items-center gap-4">
                            <Link class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                  :href="route('items.index', inventory.id)"> Back
                            </Link>

                            <PrimaryButton >Save</PrimaryButton>
                        </div>
                    </form>
                </section>

            </div>
        </div>



    </AuthenticatedLayout>

</template>

<script>
import useVuelidate from "@vuelidate/core";
import {rules} from './Validations/itemUpdateRules.js'

export default {
    name: "Create",

    props: ['inventory', 'item'],

    data() {
        return {
            name: this.item.name,
            description: this.item.description,
            image: '',
            quantity: this.item.quantity,
            vx: useVuelidate()
        }
    },


    methods: {
        async validate() {
            const validate = await this.vx.$validate()
            return this.vx.$errors.length;
        },

        async updateItem() {
            const errors = await this.validate();

            axios.post(this.inventory.id + '/items/' + this.item.id , new FormData(this.$refs['itemForm']))
                .then(response => {
                    console.log(response.data)

                    swal({
                        title: "Success!",
                        text: response?.data?.message || "Operation Successful",
                        icon: "success",
                    }).then(res => {
                        this.$inertia.visit('/' + this.inventory.id + '/items');
                    });

                })
                .catch(error => {
                    console.log(error.response.data)

                    swal({
                        title: "Error!",
                        text: error?.response?.data?.message || "Something went wrong",
                        icon: "error",
                    });
                })
        },



        errorMsg(input) {
            return input.$errors.length ? input.$errors[0].$message : false;
        },




    },


    validations() {
        return {...rules}
    },
}
</script>

<style scoped>

</style>
