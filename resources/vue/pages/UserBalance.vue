<template>
    <div>
        <section class="page-heading">
            <div class="container flex justify-between">

                <div class="page-title flex items-center">
                    <h1 class="px-1 mr-3 py-3 tracking-wide font-semibold text-2xl">Your Balance</h1>

                    <AddEntry @entryAdded="pageChange(1)"></AddEntry>

                    <button @click="importCsv" class="btn flex items-center">
                        <i class="icon import"></i> Import CSV
                    </button>

                </div>

                <div class="total-balance mr-5 mt-1 text-right">
                    <h3 class="uppercase text-white text-opacity-50 text-sm font-semibold ">Total Balance</h3>

                    <MoneyFormatter total="true" :value="total.toString()"></MoneyFormatter>
                </div>

            </div>
        </section>

        <section class="balance-list container" v-for="(dayGroup, groupKey) in groupedEntries" :key="groupKey">
            <BalanceHeading :day="dayGroup.day" :sum="dayGroup.sum.toString()"></BalanceHeading>
            <div v-for="entry in dayGroup.entries">
                <BalanceItem
                    :data="entry"
                    :key="entry.id"
                    :editing="editing"
                    @deleteEntry="deleteEntry"
                    @updateEntry="updateEntry"
                ></BalanceItem>
            </div>
        </section>

        <section class="container">
            <paginate
                v-model="page"
                :page-count="pages"
                :margin-pages="1"
                :click-handler="pageChange"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination'"
                :page-class="'page-item'">
            </paginate>
        </section>

    </div>
</template>

<script>
    import BalanceHeading from '../components/BalanceHeading'
    import BalanceItem from '../components/BalanceItem'
    import MoneyFormatter from "../components/MoneyFormatter"
    import AddEntry from "../components/AddEntry";


    export default {
        components: {
            BalanceHeading,
            BalanceItem,
            MoneyFormatter,
            AddEntry
        },
        props: [
            'data',
            'spendings'
        ],

        data() {
            return {
                total: this.spendings.total_balance,
                page: this.spendings.current_page,
                entries: this.spendings.data,
                pages: this.spendings.last_page,
                editing: false
            }
        },

        computed: {
            prettyTotal() {
                return Math.floor(this.value/100 )
            },
            totalCents() {
                return this.value.toString().slice(-2)
            },
            groupedEntries() {
                let grouped = {}
                let entries = this.entries
                entries.sort(this.compareValues('date', 'desc'));

                for(let i=0; i < entries.length; i++) {
                    let entry = entries[i]

                    let now = new Date()

                    let yesterday = new Date()
                    yesterday.setDate(yesterday.getDate() - 1)

                    let spent_day = new Date(entry.date)
                    entry.date = spent_day.toISOString()

                    let day = ''

                    if(spent_day.toDateString() === now.toDateString()) {
                        day = 'Today'
                    } else if (spent_day.toDateString() === yesterday.toDateString()) {
                        day = 'Yesterday'
                    } else {
                        day = spent_day.toLocaleDateString("en-US",  { year: 'numeric', weekday: 'short', month: 'long', day: 'numeric' })
                    }

                    if( !Array.isArray(grouped[day]) ) {
                        grouped[day] = []
                    }
                    grouped[day].push(entry)
                }
                let arr = []
                for (const [key, value] of Object.entries(grouped)) {
                    let sum = 0
                    value.forEach((entry)=>{
                        let amount = parseInt(entry.amount,10)
                        sum += amount
                    })
                    arr.push({
                        day: key,
                        sum: sum,
                        entries: value
                    })
                }
                return arr
            }
        },
        methods: {
            addEntry: () => {
                console.log('Add Entry')
            },
            importCsv: () => {
                console.log('ImportCsv')
            },
            pageChange(pageNum) {
                this.page = pageNum

                axios
                    .get('/', {
                        params: {
                            page: pageNum
                        }
                    })
                    .then((resp)=>{
                        this.entries = resp.data.data
                        this.total = resp.data.total_balance
                    })

            },
            updateEntry(data){
                axios
                    .put('/', data)
                    .then((resp)=>{
                        console.log(resp)
                        this.pageChange(this.page)
                    })
            },
            deleteEntry(id) {
                axios
                    .delete('/'+id)
                    .then((resp)=>{
                        this.pageChange(this.page)
                    })
            },
            compareValues: (key, order = 'asc') => {
                return function innerSort(a, b) {
                    if (!a.hasOwnProperty(key) || !b.hasOwnProperty(key)) {
                        // property doesn't exist on either object
                        return 0;
                    }

                    const varA = (typeof a[key] === 'string')
                        ? a[key].toUpperCase() : a[key];
                    const varB = (typeof b[key] === 'string')
                        ? b[key].toUpperCase() : b[key];

                    let comparison = 0;
                    if (varA > varB) {
                        comparison = 1;
                    } else if (varA < varB) {
                        comparison = -1;
                    }
                    return (
                        (order === 'desc') ? (comparison * -1) : comparison
                    );
                };
            }
        }
    }
</script>

<style>
    .pagination {
        @apply flex justify-center mt-16;
    }
    .pagination li {
        @apply px-1;
    }
    .pagination a {
        @apply px-4 py-2 rounded block border border-gray-300;
    }
    .pagination a:hover {
        @apply bg-gray-200;
    }
    .pagination .active a {
        @apply bg-blue-500 text-white;
    }
    .pagination .disabled a {
        @apply border-0 cursor-not-allowed;
    }

</style>
