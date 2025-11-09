const { createApp } = Vue
const app = createApp({
    data() {
        let selectMonth = '2025';
        let selectYear = '2025';
        let selectQuartly = '2025';
        let monthDataList = [];
        let quartlyList = [];
        return {
            selectMonth,
            selectYear,
            selectQuartly,
            monthDataList,
            quartlyList
        }
    },
    mounted() {
        let _this = this;
        $.getJSON(`/investor/finance/get/${this.selectMonth}`, function (res) {
            _this.monthDataList = res;
        });
        $.getJSON(`/investor/finance/get/quarterly/${this.selectQuartly}`, function (res) {
            _this.quartlyList = res;
        });
    },
    created() {
    },
    methods: {
        onChangeMonth() {
            let _this = this;
            $.getJSON(`/investor/finance/get/${this.selectMonth}`, function (res) {
                _this.monthDataList = res;
            });

        },
        onChangeQuartly() {
            let _this = this;
            $.getJSON(`/investor/finance/get/quarterly/${this.selectQuartly}`, function (res) {
                _this.quartlyList = res;
            });

        }
    }

}).mount('#vue-app-finance-id');
