
<template>
    <div>
       <line-chart
                :labels="labels"
                :datasets="datasets"></line-chart>
    </div>
</template>


<script>

import LineChart from './OptionsCharts/LineChart'

export default{
    created(){
        this.loadData()
    },
    data() {
        return {
            labels: '[]',
             datasets: [
                {
                    label: 'Relatório anual de vendas',
                    data: [],
                    backgroundColor: 'transparent',
                    borderColor: 'black'
                }
            ]
        }
    },
    methods: {
        loadData (){
            axios.get('/api/reports/months')
                .then(response => {
                    this.labels = response.data.labels
                    this.datasets[0].data = response.data.values
                })
                .catch(error => console.log(error))
        }
    },
    components: {
        LineChart
    }
}
</script>
