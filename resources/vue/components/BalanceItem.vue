<template>
    <div class="balance-list__item bg-white shadow-md rounded mb-4 hover:shadow-lg">
        <div class="line flex justify-between items-center px-5 pt-2 pb-2">
            <div class="item">
                <div class="title font-bold text-lg">{{data.label}}</div>
                <div class="date tracking-tight text-gray-400 text-xs">{{formattedDay}}</div>
            </div>
            <div class="actions ml-auto mr-8 ">
                <button @click="editPanel" v-if="!edit" class="px-2 mx-1 text-blue-500 tracking-wide underline uppercase text-xs hover:text-blue-400 ">
                    Edit
                </button>
                <button @click="deleteEntry" class="px-2 mx-1 text-blue-500 underline uppercase text-xs hover:text-blue-400 ">
                    Delete
                </button></div>
            <MoneyFormatter :value="data.amount"></MoneyFormatter>
        </div>

        <div class="edit-panel border-t overflow-hidden opacity-0" :class="{ 'max-h-screen opacity-100': edit }">
            <EntryForm :data="data" @submitted="updateEntry" @canceled="edit=!edit"></EntryForm>
        </div>

    </div>
</template>

<script>
    import EntryForm from "./EntryForm";
    import MoneyFormatter from "./MoneyFormatter";

    export default {
        components: {
            MoneyFormatter,
            EntryForm
        },
        data() {
            return {
                edit: false,
                form: {
                    id: this.data.id,
                    label: this.data.label,
                    date: this.data.date,
                    amount: this.data.amount,
                },
                errors : {
                    label: false,
                    date: false,
                    amount: false,
                }
            }
        },
        props: {
            data: Object
        },
        computed: {
            formattedDay() {
                let dtf = new Intl.DateTimeFormat('en', {
                    year: 'numeric', month: 'short', day: '2-digit', hour: 'numeric',  minute: 'numeric',  second: 'numeric',  hour12: true
                })

                let [
                    { value: month },,
                    { value: day },,
                    { value: year },,
                    { value: hour },,
                    { value: min },,
                    { value: sec },,
                    { value: dt }]  = dtf.formatToParts(new Date(this.data.date))

                return `${day} ${month}, ${year} at ${hour}:${min} ${dt}`
            }
        },
        methods: {
            deleteEntry(){
                this.$emit('deleteEntry', this.id)
            },
            editPanel(){
                let active = this.$parent.$children.filter(function (el) {
                    if(el.edit === true) {
                        return el.edit = false
                    }
                });
                this.edit = true
            },
            updateEntry(data){
                this.edit=!this.edit
                this.$emit('updateEntry', data)
            }
        }
    }
</script>
<style>
    .balance-list__item {
        transition: box-shadow 0.3s;
    }
    .balance-list__item .line .actions {
        display: none;
    }
    .balance-list__item .line:hover .actions {
        display:flex;
    }

    .edit-panel {
        transition: all 0.7s;
        max-height: 0;
    }
</style>
