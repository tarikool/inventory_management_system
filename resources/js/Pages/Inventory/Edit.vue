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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Inventory</h2>
        </template>


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-3">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Edit Inventory</h2>

                        <p class="mt-1 text-sm text-gray-600">
                            Update Inventory Information
                        </p>
                    </header>

                    <form @submit.prevent="updateInventory" class="mt-6 space-y-6" id="inventoryForm" ref="inventoryForm">
                        <input type="hidden" name="_method" value="PUT">

                        <div class="sm:max-w-md">
                            <InputLabel for="name" value="Name" />
                            <TextInput name="name" id="name" type="text" class="mt-1 block w-full" autocomplete="off"
                                       v-model="name" @blur="vx.name.$touch" placeholder="Enter name"/>
                            <InputError class="mt-2" v-if="vx.name.$error"
                                        :message="errorMsg(vx.name)" />
                        </div>



                        <div class="sm:max-w-md">
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



                        <div class="flex items-center gap-4">
                            <PrimaryButton >Update</PrimaryButton>
                        </div>
                    </form>
                </section>

            </div>
        </div>



    </AuthenticatedLayout>

</template>

<script>
    import useVuelidate from "@vuelidate/core";
    import {rules} from './Validations/createRules'

    export default {
        name: "Create",
        props: ['inventory'],

        data() {
            return {
                name: this.inventory.name,
                description: this.inventory.description,
                vx: useVuelidate()
            }
        },


        methods: {
            async validate() {
                const validate = await this.vx.$validate()
                return this.vx.$errors.length;
            },

            async updateInventory() {
                const errors = await this.validate();

                axios.post('/inventories/' + this.inventory.id, new FormData(this.$refs['inventoryForm']))
                    .then(response => {
                        console.log(response.data)

                        swal({
                            title: "Success!",
                            text: response?.data?.message || "Operation Successful",
                            icon: "success",
                        }).then(res => {
                            this.$inertia.visit('/inventories');
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
