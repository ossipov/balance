<template>
    <div>
        <button @click="addEntry" class="btn flex items-center mr-4">
            <i class="icon add"></i> Add Entry
        </button>

        <!--Modal-->
        <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center"
             :class="{'opacity-0 pointer-events-none': modal }">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

            <div class="modal-container bg-white w-11/12 mx-auto rounded shadow-lg z-50 overflow-y-auto"
                 style="max-width: 720px">

                <EntryForm :data="form" @submitted="saveEntry" @canceled="modal=!modal"></EntryForm>

            </div>
        </div>

    </div>
</template>

<script>
    import EntryForm from './EntryForm'

    export default {
        data() {
            return {
                modal: true,
                form: {
                    label: '',
                    // date: '',
                    amount: 0,
                },
            }
        },
        components: {
            EntryForm
        },
        props: [],

        methods: {

            addEntry() {
                let now = new Date()
                this.form.label = ''
                this.form.date = now.toISOString()
                this.form.amount = '$0.00'
                this.modal = !this.modal
            },
            saveEntry(data) {
                axios.post('/',{
                    label: data.label,
                    date: data.date,
                    amount: data.amount,
                }).then((resp)=>{
                    this.modal = !this.modal
                    this.$emit('entryAdded')
                })
            },
        }

    }
</script>
