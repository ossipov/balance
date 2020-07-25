<template>
    <div class="modal-content text-left text-black">
        <!--Title-->
        <p v-if="!data.id" class="text-2xl px-10 pt-8 pb-6 font-semibold w-full border-b">Add Balance Entry</p>

        <div class="flex p-10 items-stretch justify-between space-x-2">
            <div class="field">
                <label :for="'label'+data.id" class="uppercase font-semibold tracking-wide text-gray-600 text-sm">
                    Label
                </label>
                <input
                    :id="'label'+data.id"
                    type="text"
                    @click="errors.label=false"
                    v-model="form.label"
                    class="w-full mt-2 p-3 rounded text-sm border"
                    :class="{'border-red-800': errors.label}"
                />
            </div>
            <div class="field">
                <label  class="uppercase font-semibold tracking-wide text-gray-600 text-sm">
                    Date
                </label>
                <datetime
                    type="datetime"
                    :minute-step="5"
                    :max-datetime="maxDateTime"
                    class="mt-2 p-3 w-full rounded text-sm border"
                    v-model="date"
                />
            </div>
            <div class="field w-2/12">
                <label :for="'amount'+data.id" class="uppercase font-semibold tracking-wide text-gray-600 text-sm">
                    Amount
                </label>

                <input
                    @click="errors.amount=false"
                    v-currency="currencyOptions"
                    type="text"
                    v-model="amount"
                    :id="'amount'+data.id"
                    class="mt-2 w-full p-3 rounded text-sm border"
                    :class="{'border-red-800': errors.amount}"
                />
            </div>
        </div>

        <!--Footer-->
        <div class="flex mt-2 justify-end pt-8 pb-6 px-10 border-t">
            <button
                @click="$emit('canceled')"
                class="text-sm tracking-wide modal-close uppercase px-8 bg-indigo-100 font-semibold text-gray-600 mr-6 rounded-md text-white py-3"
            >
                Cancel
            </button>
            <button
                @click="submit"
                class="text-sm tracking-wide modal-close uppercase  px-8 bg-blue-500 font-semibold rounded-md text-white py-3"
            >
                Save Entry
            </button>
        </div>

    </div>
</template>

<script>
    import { CurrencyDirective, parseCurrency } from 'vue-currency-input'
    export default {
        data() {
            return {
                modal: true,
                form: this.data,
                amount: this.data.amount / 100,
                date: this.data.date,
                errors : {
                    label: false,
                    date: false,
                    amount: false,
                }
            }
        },
        directives: {
            currency: CurrencyDirective
        },
        mounted() {
            if(!this.form.id){
                let now = new Date()
                this.date = now.toISOString()
            }
        },

        props: [
            'data',
            'id'
        ],
        computed: {
            maxDateTime() {
                let now = new Date()
                return now.toISOString()
            },
            currencyOptions() {
                return {
                    currency: 'USD',
                    valueAsInteger: false,
                    distractionFree: false
                }
            },
        },
        methods: {

            addEntry() {
                let now = new Date()
                this.form.label = ''
                this.form.date = now.toISOString()
                this.form.amount = '$0.00'
                this.modal = !this.modal
            },
            submit() {
                let amount = parseCurrency(this.amount, this.currencyOptions)
                if (!this.form.label) {
                    this.errors.label = true
                    return false
                }
                if (!amount) {
                    this.errors.amount = true
                    return false
                }

                let data = {
                    label: this.form.label,
                    date: this.form.date,
                    amount: amount * 100,
                }
                if (this.data.id) {
                    data.id = this.data.id
                }

                this.$emit('submitted', data)
            },
        }

    }
</script>
